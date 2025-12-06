<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ $quiz->title }} - {{ __('messages.quiz') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ✅ Tailwind + Alpine عبر CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
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
    <div class="relative flex-grow flex flex-col items-center justify-center p-8">

        <!-- Exit Button -->
        <form method="POST" action="{{ route('student.quiz.exit', $quiz->slug) }}"
            onsubmit="return confirm('{{ __('messages.exit_confirm') }}')" class="absolute top-4 right-4">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                {{ __('messages.exit') }}
            </button>
        </form>

        <!-- Quiz Container -->
        <div class="w-full max-w-3xl bg-white p-6 rounded-lg shadow" x-data="{ activeTab: 'question0' }">
            <h1 class="text-2xl font-bold text-[#79131d] mb-4">{{ $quiz->title }}</h1>
            <p class="text-gray-700 mb-2">
                {{ __('messages.duration') }}: {{ $quiz->duration }} {{ __('messages.minutes') }}
            </p>
            <p class="text-gray-600 mb-6">{{ __('messages.answer_questions') }}</p>

            <!-- Tabs Navigation -->
            <div class="flex space-x-2 mb-6 overflow-x-auto">
                @foreach ($quiz->questions as $index => $question)
                    <button type="button" class="px-4 py-2 rounded border text-sm font-semibold"
                        :class="activeTab === 'question{{ $index }}'
                            ?
                            'bg-[#79131d] text-[#e4ce96]' :
                            'bg-white text-gray-700 border-gray-300'"
                        @click="activeTab = 'question{{ $index }}'">
                        {{ __('messages.q') }}{{ $index + 1 }}
                    </button>
                @endforeach
            </div>

            <!-- Quiz Form -->
            <form method="POST" action="{{ route('student.quiz.submit', $quiz->slug) }}">
                @csrf

                @foreach ($quiz->questions as $index => $question)
                    <div x-show="activeTab === 'question{{ $index }}'" x-transition class="space-y-4">
                        <h2 class="font-semibold text-lg">
                            {{ $index + 1 }}. {{ $question->question }}
                        </h2>
                        @foreach ($question->options as $option)
                            <label class="block bg-gray-50 p-3 rounded border">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                    class="mr-2">
                                {{ $option->option_text }}
                            </label>
                        @endforeach
                    </div>
                @endforeach

                <!-- Submit -->
                <div class="mt-6 text-center">
                    <button type="submit"
                        class="bg-[#79131d] text-[#e4ce96] px-6 py-2 rounded hover:bg-[#5a0e16] transition">
                        {{ __('messages.submit_answers') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1); // يمنع الزر Back
        };
    </script>

    <x-footer />
</body>

</html>
