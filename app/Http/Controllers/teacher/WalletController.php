<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Display teacher wallet
     */
    public function index()
    {
        $teacher = Auth::user();
        
        // Create wallet if doesn't exist
        if (!$teacher->wallet) {
            Wallet::create(['user_id' => $teacher->id]);
            $teacher->refresh();
        }

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
            ->select(
                'courses.id',
                'courses.title',
                'courses.slug',
                'courses.price as teacher_price',
                DB::raw('COUNT(*) as sales_count'),
                DB::raw('SUM(courses.price) as total_earned')
            )
            ->groupBy('courses.id', 'courses.title', 'courses.slug', 'courses.price')
            ->get();

        // Calculate total earned
        $totalEarned = $coursesSales->sum('total_earned');

        // Get transactions
        $transactions = WalletTransaction::where('wallet_id', $teacher->wallet->id)
            ->with('createdBy')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Get withdrawal requests
        $withdrawalRequests = WithdrawalRequest::where('user_id', $teacher->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('teacherDashboard.wallet.index', compact(
            'teacher',
            'coursesSales',
            'totalEarned',
            'transactions',
            'withdrawalRequests'
        ));
    }

    /**
     * Store withdrawal request
     */
    public function requestWithdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $teacher = Auth::user();
        
        if (!$teacher->wallet) {
            Wallet::create(['user_id' => $teacher->id]);
            $teacher->refresh();
        }

        if ($teacher->wallet->balance < $request->amount) {
            return redirect()->back()->with('error', 'الرصيد غير كافي');
        }

        // Check if there's a pending request
        $pendingRequest = WithdrawalRequest::where('user_id', $teacher->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingRequest) {
            return redirect()->back()->with('error', 'لديك طلب سحب قيد الانتظار');
        }

        WithdrawalRequest::create([
            'user_id' => $teacher->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        // Create notification for all admins
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\notification::create([
                'sender_id' => $teacher->id,
                'reciever_id' => $admin->id,
                'title' => 'طلب سحب جديد',
                'message' => 'طلب سحب مبلغ ' . number_format($request->amount, 2) . ' ريال من ' . $teacher->name,
                'status' => 'unread',
            ]);
        }

        return redirect()->back()->with('success', 'تم إرسال طلب السحب بنجاح');
    }
}
