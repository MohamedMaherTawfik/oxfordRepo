<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>

<body class="bg-gray-100 py-8 px-4">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Hello {{ $user->name ?? 'User' }},</h2>
            <p class="text-gray-600 mb-4">Your One-Time Password (OTP) is:</p>
            <div class="text-3xl font-mono font-bold text-indigo-600 tracking-widest mb-6">{{ $otp }}</div>
            <p class="text-gray-600 text-sm">Please use this code to complete your verification process. The code is
                valid for a short time only.</p>
            <div class="mt-6 text-gray-500 text-xs">
                If you didn’t request this code, you can safely ignore this email.
            </div>
        </div>
    </div>
</body>

</html>
