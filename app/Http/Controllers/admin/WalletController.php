<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Display all wallets (teachers only)
     */
    public function index()
    {
        $teachers = User::where('role', 'teacher')->with('wallet')->orderBy('created_at', 'desc')->get();
        
        // Calculate total revenue from all enrollments
        $totalRevenue = Enrollments::where('enrolled', 'yes')
            ->where(function($query) {
                $query->where('transaction_status', 'success')
                      ->orWhere('transaction_type', 'cash')
                      ->orWhere('transaction_type', 'api');
            })
            ->sum('price');
        
        // Calculate total teacher earnings (from teacher_price)
        $totalTeacherEarnings = DB::table('enrollments')
            ->join('courses', 'enrollments.courses_id', '=', 'courses.id')
            ->where('enrollments.enrolled', 'yes')
            ->where(function($query) {
                $query->where('enrollments.transaction_status', 'success')
                      ->orWhere('enrollments.transaction_type', 'cash')
                      ->orWhere('enrollments.transaction_type', 'api');
            })
            ->sum('courses.price');
        
        $pendingWithdrawals = WithdrawalRequest::pending()->with('user')->orderBy('created_at', 'desc')->get();
        
        return view('admin.wallets.index', compact('teachers', 'totalRevenue', 'totalTeacherEarnings', 'pendingWithdrawals'));
    }

    /**
     * Show wallet details for a specific teacher
     */
    public function show($userId)
    {
        $teacher = User::with('wallet', 'withdrawalRequests')->findOrFail($userId);
        
        if (!$teacher->wallet) {
            Wallet::create(['user_id' => $teacher->id]);
            $teacher->refresh();
        }
        
        $transactions = WalletTransaction::where('wallet_id', $teacher->wallet->id)
            ->with('createdBy')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Get teacher's courses sales
        $coursesSales = DB::table('enrollments')
            ->join('courses', 'enrollments.courses_id', '=', 'courses.id')
            ->where('courses.user_id', $teacher->id)
            ->where('enrollments.enrolled', 'yes')
            ->where(function($query) {
                $query->where('enrollments.transaction_status', 'success')
                      ->orWhere('enrollments.transaction_type', 'cash')
                      ->orWhere('enrollments.transaction_type', 'api');
            })
            ->select('courses.id', 'courses.title', 'courses.slug', 'courses.price as teacher_price', DB::raw('COUNT(*) as sales_count'), DB::raw('SUM(courses.price) as total_earned'))
            ->groupBy('courses.id', 'courses.title', 'courses.slug', 'courses.price')
            ->orderBy('sales_count', 'desc')
            ->get();
        
        return view('admin.wallets.show', compact('teacher', 'transactions', 'coursesSales'));
    }

    /**
     * Add balance to teacher wallet
     */
    public function addBalance(Request $request, $userId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        $teacher = User::findOrFail($userId);
        
        if (!$teacher->wallet) {
            Wallet::create(['user_id' => $teacher->id]);
            $teacher->refresh();
        }

        $teacher->wallet->addBalance(
            $request->amount,
            $request->description ?? 'إضافة رصيد يدوي',
            'manual',
            null,
            Auth::id()
        );

        return redirect()->back()->with('success', 'تم إضافة الرصيد بنجاح');
    }

    /**
     * Deduct balance from teacher wallet
     */
    public function deductBalance(Request $request, $userId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        $teacher = User::findOrFail($userId);
        
        if (!$teacher->wallet) {
            return redirect()->back()->with('error', 'المحفظة غير موجودة');
        }

        if ($teacher->wallet->balance < $request->amount) {
            return redirect()->back()->with('error', 'الرصيد غير كافي');
        }

        $teacher->wallet->deductBalance(
            $request->amount,
            $request->description ?? 'خصم رصيد يدوي',
            'manual',
            null,
            Auth::id()
        );

        return redirect()->back()->with('success', 'تم خصم الرصيد بنجاح');
    }

    /**
     * Process withdrawal request
     */
    public function processWithdrawal(Request $request, $withdrawalId)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'notes' => 'nullable|string|max:500',
        ]);

        $withdrawal = WithdrawalRequest::findOrFail($withdrawalId);
        
        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'تم معالجة هذا الطلب مسبقاً');
        }

        if ($request->action === 'approve') {
            $teacher = $withdrawal->user;
            
            if (!$teacher->wallet || $teacher->wallet->balance < $withdrawal->amount) {
                return redirect()->back()->with('error', 'الرصيد غير كافي');
            }

            $teacher->wallet->deductBalance(
                $withdrawal->amount,
                'سحب رصيد - ' . ($request->notes ?? ''),
                'withdrawal',
                $withdrawal->id,
                Auth::id()
            );

            $withdrawal->update([
                'status' => 'approved',
                'processed_by' => Auth::id(),
                'processed_at' => now(),
                'notes' => $request->notes,
            ]);

            // Create notification
            \App\Models\notification::create([
                'sender_id' => Auth::id(),
                'reciever_id' => $teacher->id,
                'title' => 'تمت الموافقة على طلب السحب',
                'message' => 'تمت الموافقة على طلب سحب مبلغ ' . number_format($withdrawal->amount, 2) . ' ريال',
                'status' => 'unread',
            ]);

            return redirect()->back()->with('success', 'تمت الموافقة على طلب السحب');
        } else {
            $withdrawal->update([
                'status' => 'rejected',
                'processed_by' => Auth::id(),
                'processed_at' => now(),
                'notes' => $request->notes,
            ]);

            // Create notification
            \App\Models\notification::create([
                'sender_id' => Auth::id(),
                'reciever_id' => $withdrawal->user_id,
                'title' => 'تم رفض طلب السحب',
                'message' => 'تم رفض طلب سحب مبلغ ' . number_format($withdrawal->amount, 2) . ' ريال. ' . ($request->notes ?? ''),
                'status' => 'unread',
            ]);

            return redirect()->back()->with('success', 'تم رفض طلب السحب');
        }
    }
}
