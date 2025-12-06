<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ $quiz->title }} - {{ __('messages.result') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ✅ Tailwind CDN -->
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

<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex-grow flex items-center justify-center px-4 py-10">

    <div class="bg-white shadow-lg rounded-lg max-w-xl w-full p-8">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[#79131d]">{{ __('messages.result') }}</h1>
            <p class="text-gray-600 mt-2 text-lg">{{ $quiz->title }}</p>
        </div>

        <!-- Score Card -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6">
            <p class="text-lg text-gray-800 mb-2">
                <span class="font-semibold">{{ __('messages.your_score') }}:</span>
                <span
                    class="@if ($result->score === 0) text-red-600
                            @elseif($result->score < $quiz->questions->count())
                                text-yellow-600
                            @else
                                text-green-600 @endif font-bold text-xl">
                    {{ $result->score }} / {{ $quiz->questions->count() }}
                </span>
            </p>

            <p class="text-sm text-gray-600">{{ __('messages.duration') }}: {{ $quiz->duration }}
                {{ __('messages.minutes') }}</p>

            @if ($result->score === 0)
                <div class="mt-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                    {{ __('messages.result_zero') }}
                </div>
            @elseif ($result->score < $quiz->questions->count() / 2)
                <div class="mt-4 bg-yellow-100 text-yellow-800 px-4 py-2 rounded">
                    {{ __('messages.result_low') }}
                </div>
            @else
                <div class="mt-4 bg-green-100 text-green-800 px-4 py-2 rounded">
                    {{ __('messages.result_success') }}
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-1 text-[#79131d] hover:text-[#5a0e16] font-medium transition">
                <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
                {{ __('messages.back') }}
            </a>
        </div>
    </div>

    <x-footer />
</body>

</html>
