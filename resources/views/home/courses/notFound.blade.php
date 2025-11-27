<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('notfound.title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

<body class="">
    {{-- navbar --}}
    <x-navbar />


    <div class="mt-10">.</div>
    <div class="mt-10">.</div>
    <div class="flex flex-col items-center justify-center text-center p-6">
        <!-- SVG Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-500 mb-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
        </svg>

        <!-- Message -->
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
            {{ __('notfound.heading') }}
        </h1>
        <p class="text-gray-600">
            {{ __('notfound.message') }}
        </p>

        <!-- Optional: Back button -->
        <a href="/"
            class="inline-block mt-6 px-6 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600 transition">
            {{ __('notfound.back_home') }}
        </a>
    </div>

    {{-- footer --}}
    <x-footer />

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
