<?php

namespace App\Http\Controllers\admin\payment;

use App\Http\Controllers\Controller;
use App\Models\Enrollments;
use App\Models\visaenable;
use Illuminate\Http\Request;

class adminpaymentController extends Controller
{
    public function index()
    {
        $visa = visaenable::where('id', 1)->first();
        return view('admin.payment.index', compact('visa'));
    }

    public function edit()
    {
        $data = request()->except('_token');
        $vsa = visaenable::where('id', 1)->first();
        if ($data['type'] == 'visa') {
            $vsa->update(['visa_enable' => $data['status']]);
            return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully!');
        } else if ($data['type'] == 'cash') {
            $vsa->update(['cash_enable' => $data['status']]);
            return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully!');
        }
        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully!');
    }

    public function students()
    {
        $enrollments = Enrollments::with('user')->where('transaction_type', 'cash')->orderBy('created_at', 'desc')->get();
        return view('admin.payment.cash', compact('enrollments'));
    }

    public function success(Enrollments $enrollments)
    {
        $enrollments->update(['transaction_type' => 'done']);
        return redirect()->route('admin.payments.cash')->with('success', 'Payment updated successfully!');
    }
}