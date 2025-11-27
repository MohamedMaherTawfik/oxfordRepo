<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Diplomas;
use App\Models\RequestCertificate;
use App\Models\sendCertificates;
use Illuminate\Http\Request;

class diplomaRequestsController extends Controller
{
    public function requests(Diplomas $diploma)
    {
        $requests = $diploma->requests;
        $send = sendCertificates::where('diplomas_id', $diploma->id)->get();
        return view('admin.diplomas.requests', compact('requests', 'diploma', 'send'));
    }

    public function send(RequestCertificate $diploma, Request $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('certificate_file')) {
            $data['certificate_file'] = $request->file('certificate_file')->store('certificates', 'public');
        }
        sendCertificates::create([
            'diplomas_id' => $diploma->diplomas_id,
            'user_id' => $diploma->user_id,
            'file' => $data['certificate_file']
        ]);
        return redirect()->back()->with('success', 'تم ارسال طلبك بنجاح');
    }
}