<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categorey->name }} - {{ __('messages.courses') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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

        .category-hero {
            background: linear-gradient(135deg, #f0f4ff 0%, #d6e4ff 100%);
        }

        .rating-stars {
            color: #f59e0b;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="bg-gray-50">
    <x-navbar />

    <!-- Hero Section -->
    <section class="category-hero py-12 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $categorey->name }}</h1>
        <p class="text-gray-700 max-w-2xl mx-auto">{{ $categorey->description }}</p>
    </section>

    <!-- Courses Section -->
    <section class="py-10 px-4 sm:px-6 lg:px-8" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto">
            <div class="text-center lg:text-left mb-6">
                <h2 class="text-3xl font-bold text-gray-900">{{ __('messages.featured') }}</h2>
                <p class="text-gray-600">{{ __('messages.boost') }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($categorey->courses as $course)
                    <div class="bg-white rounded-lg shadow-md transition hover:shadow-xl overflow-hidden flex flex-col">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $course->cover_photo && file_exists(storage_path('app/public/' . $course->cover_photo))
                                ? asset('storage/' . $course->cover_photo)
                                : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                alt="{{ $course->title }}">

                            <div class="absolute bottom-2 left-2 bg-[#000000C5] text-white text-xs px-2 py-1 rounded">
                                {{ $course->start_date ? $course->start_date->format('M d, Y') : '' }}
                            </div>
                            <div class="absolute bottom-2 right-2 bg-[#000000B9] text-white text-xs px-2 py-1 rounded">
                                {{ $course->level }}
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <span
                                    class="inline-block mb-2 px-3 py-1 text-xs font-semibold text-[#e4ce96] bg-[#79131d] rounded-full">
                                    {{ $categorey->name }}
                                </span>
                                <h3 class="text-xl font-semibold text-gray-900">{{ $course->title }}</h3>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                                    {{ Str::limit($course->description, 100) }}
                                </p>
                                <p class="text-sm text-gray-500 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v3.586a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $course->duration }} {{ __('messages.hours') }}
                                </p>
                            </div>

                            <div class="mt-auto border-t pt-4 text-sm text-gray-700 flex justify-between items-center">
                                <div>
                                    <span class="font-bold">{{ __('messages.instructor') }}:</span>
                                    <span class="opacity-60">{{ $course->instructor }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★</span>
                                    <span class="ml-1 text-gray-600">
                                        {{ $course->rating }} ({{ $course->reviews_count }})
                                    </span>
                                </div>
                            </div>

                            <div class="pt-4 flex items-center justify-between">
                                <span class="text-lg font-bold text-[#79131d]">
                                    {{ $course->price }} <img
                                        src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                        alt="SAR" class="inline-block sar-symbol">
                                </span>
                                <a href="{{ route('course.show', $course->slug) }}"
                                    class="px-4 py-2 bg-[#79131DD2] text-[#e4ce96] text-sm font-medium rounded-md hover:bg-[#79131d] transition">
                                    {{ __('messages.subscribe_now') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        {{ __('messages.no_courses_found') }}
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <x-footer />

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
