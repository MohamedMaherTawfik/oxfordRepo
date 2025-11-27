<?php

namespace App\Http\Controllers\home;

use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\times;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClickPayController
{
    protected $profileId;
    protected $serverKey;
    protected $clientKey;
    protected $currency;
    protected $baseUrl;

    public function __construct()
    {
        $this->profileId = config('services.clickpay.profile_id');
        $this->serverKey = config('services.clickpay.server_key');
        $this->clientKey = config('services.clickpay.client_key');
        $this->currency = config('services.clickpay.currency');
        $this->baseUrl = rtrim(config('services.clickpay.base_url'), '/');
    }

    public function login(Courses $course)
    {
        $type = request('type');
        $data = request()->except('_token');
        return view('auth.pay.login', compact('course', 'data', 'type'));
    }

    public function redirect(Courses $course)
    {
        $data = request()->except('_token');

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            if ($data['type'] == 'visa') {
                return redirect()->route('pay.form', $course->id)->with('days', $data['days']);
            } else {
                return redirect()->route('pay.later', $course->id)->with('days', $data['days']);
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showPaymentForm(Courses $course)
    {
        $scheduleTimes = session('days', []);
        $selectedDays = array_keys($scheduleTimes);

        foreach ($selectedDays as $day) {
            if (isset($scheduleTimes[$day])) {
                $item = $scheduleTimes[$day];

                times::create([
                    'course_schedule_id' => $item['id'],
                    'user_id' => Auth::user()->id,
                    'time' => $item['start_time'] . ' - ' . $item['end_time'],
                    'day' => $day,
                ]);
            }
        }

        return view('payment.form', compact('course'));
    }
    public function showPaymentFormauth(Courses $course)
    {
        $scheduleTimes = request()->except('_token')['days'];
        $selectedDays = array_keys($scheduleTimes);

        foreach ($selectedDays as $day) {
            if (isset($scheduleTimes[$day])) {
                $item = $scheduleTimes[$day];

                times::create([
                    'course_schedule_id' => $item['id'],
                    'user_id' => Auth::user()->id,
                    'time' => $item['start_time'] . ' - ' . $item['end_time'],
                    'day' => $day,
                ]);
            }
        }

        return view('payment.form', compact('course'));
    }





    public function initiatePayment(Request $request, Courses $course)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.5',
            'email' => 'required|email',
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);

        $amount = $request->amount;
        $email = $request->email;
        $name = $request->name;

        $billingData = [
            'first_name' => explode(' ', $name)[0],
            'last_name' => explode(' ', $name)[1] ?? 'User',
            'email' => $email,
            'phone' => $request->phone,
            'address_line_1' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
        ];

        $payload = [
            "profile_id" => $this->profileId,
            "tran_type" => "sale",
            "tran_class" => "ecom",
            "cart_id" => uniqid('cart_'),
            "cart_description" => "Payment for products",
            "cart_currency" => $this->currency,
            "cart_amount" => $amount,
            "callback" => route('pay.callback', ['course' => $course]),
            "return" => route('pay.success', ['course' => $course, 'user_id' => Auth::id()]),
            "billing_details" => $billingData,
        ];

        $response = Http::withHeaders([
            'Authorization' => $this->serverKey,
            'Content-Type' => 'application/json'
        ])->post("{$this->baseUrl}/payment/request", $payload);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['redirect_url'])) {
                return redirect()->away($data['redirect_url']);
            }
        }

        Log::error('ClickPay Initiation Failed', $response->json());
        return redirect()->back()->withErrors('Payment initiation failed. Please try again.');
    }

    public function callback(Request $request, Courses $course)
    {
        $paypageId = $request->query('pay_page_id');
        $transactionId = $request->query('transaction_id');

        if (!$paypageId || !$transactionId) {
            return response("<script>window.opener.postMessage({error: 'Missing payment details'}, '*'); window.close();</script>");
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->serverKey,
            ])->get("{$this->baseUrl}/pay/connect/en/api/v1/verify", [
                        'pay_page_id' => $paypageId,
                        'transaction_id' => $transactionId,
                    ]);

            $result = $response->json();

            return response()->make("
                <script>
                    window.opener.postMessage(" . json_encode($result) . ", '*');
                    window.close();
                </script>
            ", 200, ['Content-Type' => 'text/html']);

        } catch (\Exception $e) {
            Log::error('ClickPay Verification Error', ['message' => $e->getMessage()]);
            return response("<script>window.opener.postMessage({error: 'Verification Error: {$e->getMessage()}'}, '*'); window.close();</script>");
        }
    }

    public function success(Courses $course, $user_id)
    {
        Enrollments::create([
            'user_id' => $user_id,
            'courses_id' => $course->id,
            'price' => $course->admin_price ?? $course->price,
            'enrolled' => 'yes',
        ]);
        return view('payment.success', compact('course'));
    }

    public function payLater(Courses $course)
    {
        $scheduleTimes = session('days', []);
        $selectedDays = array_keys($scheduleTimes);

        foreach ($selectedDays as $day) {
            if (isset($scheduleTimes[$day])) {
                $item = $scheduleTimes[$day];

                times::create([
                    'course_schedule_id' => $item['id'],
                    'user_id' => Auth::user()->id,
                    'time' => $item['start_time'] . ' - ' . $item['end_time'],
                    'day' => $day,
                ]);
            }
        }
        Enrollments::create([
            'user_id' => Auth::id(),
            'courses_id' => $course->id,
            'price' => $course->admin_price ?? $course->price,
            'enrolled' => 'yes',
            'transaction_type' => 'cash',
        ]);
        return view('payment.success', compact('course'));
    }
    public function payLaterauth(Courses $course)
    {
        $scheduleTimes = request()->except('_token')['days'];

        $selectedDays = array_keys($scheduleTimes);

        foreach ($selectedDays as $day) {
            if (isset($scheduleTimes[$day])) {
                $item = $scheduleTimes[$day];

                times::create([
                    'course_schedule_id' => $item['id'],
                    'user_id' => Auth::user()->id,
                    'time' => $item['start_time'] . ' - ' . $item['end_time'],
                    'day' => $day,
                ]);
            }
        }
        Enrollments::create([
            'user_id' => Auth::id(),
            'courses_id' => $course->id,
            'price' => $course->admin_price ?? $course->price,
            'enrolled' => 'yes',
            'transaction_type' => 'cash',
        ]);
        return view('payment.success', compact('course'));
    }
}
