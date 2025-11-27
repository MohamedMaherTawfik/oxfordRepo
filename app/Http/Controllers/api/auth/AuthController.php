<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Http\Requests\updateUserRequest;
use App\Http\Requests\userApiRequest;
use App\Mail\OtpMail;
use App\Mail\ResetPasswordMail;
use App\Models\applyTeacher;
use App\Models\fcmToken;
use App\Models\notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use apiResponse;

    public function register(userApiRequest $request)
    {
        $fields = $request->validated();
        $fields['password'] = bcrypt($fields['password']);
        $fields['photo'] = $request->file('photo')->store('photos', 'public');

        $otp = rand(1000, 9999);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => $fields['password'],
            'role' => $fields['role'],
            'photo' => $fields['photo'],
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
            'is_verified' => false
        ]);

        FcmToken::updateOrCreate([
            'token' => $request->fcm_token,
        ], [
            'user_id' => $user->id,
            'type' => $request->device_type ?? 'android',
            'active' => true,
        ]);

        if ($user->role === 'teacher') {
            $fields['cv'] = $request->file('cv')->store('CVs', 'public');
            $fields['certificate'] = $request->file('certificate')->store('certificatess', 'public');

            applyTeacher::create([
                'user_id' => $user->id,
                'cv' => $fields['cv'],
                'certificate' => $fields['certificate'],
                'topic' => $fields['topics'],
                'phone' => $fields['phone'],
            ]);
        }

        Mail::to($user->email)->send(new OtpMail($otp, $user));
        return response()->json([
            'message' => 'User registered. Please verify the OTP sent to your email.'
        ]);
    }

    public function verifyOtpAfterRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:4',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>=', now())
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid or expired OTP'], 422);
        }
        $user->is_verified = 1;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        $token = Auth::guard('api')->login($user);

        return response()->json([
            'message' => 'Account verified successfully.',
            'access_token' => $token,
            'token_type' => 'bearer',
            'refresh_token' => Auth::guard('api')->refresh(),
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'user' => $user->load('applyTeacher'),

        ]);
    }
    public function login()
    {
        $credentials = request(['email', 'password']);
        $fcm = request(['fcm']);
        $token = Auth::guard('api')->attempt($credentials);

        if (!$token) {
            return $this->unauthorized('these credintals does not match our record');
        }
        $success = $this->respondWithToken($token);

        $user = $success->original['user'];

        if (isset($fcm['fcm'])) {
            fcmToken::updateOrCreate(
                ['token' => $fcm['fcm']],
                [
                    'user_id' => $user['id'],
                    'type' => 'android',
                    'active' => true,
                ]
            );
        }


        return response()->json([
            'access_token' => $success->original['access_token'],
            'token_type' => $success->original['token_type'],
            'expires_in' => $success->original['expires_in'],
            'refresh_token' => Auth::guard('api')->refresh(),
            'user' => $user,
        ]);
    }

    public function profile()
    {
        $user = currentUser();
        $user->load('Enrolledcourse');
        return $this->success($user, 'User With Coursea fetched');
    }

    public function logout()
    {
        FcmToken::where('user_id', auth()->id())->update(['active' => false]);

        Auth::guard('api')->logout();

        return $this->success([], 'Logout Successfully');
    }

    public function refresh()
    {
        try {
            $token = $this->respondWithToken(Auth::guard('api')->refresh());
            return $this->success($token->original, 'Refresh Successfully');
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'Invalid refresh token'], 401);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'user' => Auth::guard('api')->user(),
        ]);
    }

    public function updateProfile(updateUserRequest $request)
    {
        $fields = $request->validated();
        if ($request->hasFile('photo')) {
            $fields['photo'] = $request->file('photo')->store('photos', 'public');
        }
        $user = User::where('id', Auth::guard('api')->id())->update($fields);
        if (!$user) {
            return $this->unauthorized(__('messages.Error_update_profile'));
        }
        return $this->success($user, __('messages.update_profile'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
        $user = auth()->user();
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'message' => 'The current password is incorrect.'
            ], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password changed successfully.'
        ], 200);
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['otp' => $otp, 'created_at' => Carbon::now()]
        );

        Mail::to($request->email)->send(new \App\Mail\SendOtpMail($otp));

        return response()->json(['message' => 'OTP sent successfully.']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$record || Carbon::parse($record->created_at)->addMinutes(10)->isPast()) {
            return response()->json(['message' => 'Invalid or expired OTP'], 422);
        }

        return response()->json(['message' => 'OTP verified successfully.']);
    }

    public function foregetPass(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
            'password' => 'required|confirmed|min:6',
        ]);

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password reset successful.']);
    }

    public function sendNotify(NotificationRequest $request)
    {
        $validated = $request->validated();
        $validated['sender_id'] = Auth::guard('api')->id();
        $notify = notification::create($validated);
        return response()->json(['message' => 'Notification sent successfully.', 'data' => $notify]);
    }

}
