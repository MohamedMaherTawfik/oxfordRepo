<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Reset Your Password</h2>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.reset.submit') }}">
            @csrf

            <input type="hidden" name="token" value="{{ request()->get('token') }}">
            <input type="hidden" name="email" value="{{ request()->get('email') }}">

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">New Password</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded p-2 mt-1">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium">Confirm New Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 rounded p-2 mt-1">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Reset Password
            </button>
        </form>
    </div>

</body>

</html>
