<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" x-data x-init="$nextTick(() => window.scrollTo(0, 0))" x-cloak>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('messages.about title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
    </style>
</head>

<body class="bg-white text-gray-800 min-h-screen flex flex-col">
    <div class="flex-grow">
        {{-- Navbar --}}
        <x-navbar />

    {{-- Notifications --}}

    <div class="mt-10">.</div>
    <div class="mt-10">.</div>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6">Notifications</h1>

        @forelse($notifications as $notification)
            <div class="bg-white shadow-md rounded-lg p-6 mb-4 border border-gray-200">
                <p class="text-gray-800 text-lg font-medium mb-2">
                    {{ $notification->message }}
                </p>
                <p class="text-gray-600 text-sm mb-1">
                    <span class="font-semibold">Sender:</span> {{ $notification->sender->name ?? 'Unknown' }}
                </p>
                <p class="text-gray-500 text-xs">
                    <span class="font-semibold">Send At:</span>
                    {{ $notification->created_at->format('Y-m-d H:i') }}
                </p>
            </div>
        @empty
            <p class="text-gray-500">No notifications found.</p>
        @endforelse
    </div>
    {{-- End Notifications --}}
    </div>

    {{-- Footer --}}
    <x-footer />

</body>

</html>
