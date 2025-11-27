@php
    use Illuminate\Support\Facades\Storage;

@endphp ?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ $diplomas->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://source.zoom.us/3.11.5/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.11.5/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.11.5/zoom-meeting-embedded.min.js"></script>
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

        #meetingSDKElement {
            width: 100%;
            height: 100vh;
        }
    </style>
    <!-- Add Alpine.js if not already included -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- navbar --}}
    <x-gate-navbar />

    <!-- Course Header -->

    <div class="mt-10">.</div>
    <div class="mt-10">.</div>
    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-5xl mx-auto py-6 px-4" x-data="{ activeTab: 'overview' }">

        <!-- Navigator Tabs -->
        <div class="flex border-b border-gray-200 pb-4 mb-6">
            <a href="#" @click.prevent="activeTab = 'overview'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'overview' ? 'text-[#79131d] border-b-2 border-[#79131d]' :
                    'text-gray-600 hover:text-[#79131d]'"
                id="overview-tab">
                {{ __('messages.overview') }}
            </a>

            <a href="#" @click.prevent="activeTab = 'notes'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'notes' ? 'text-[#79131d] border-b-2 border-[#79131d]' :
                    'text-gray-600 hover:text-[#79131d]'"
                id="notes-tab">
                {{ __('messages.notes') }}
            </a>
            <a href="#" @click.prevent="activeTab = 'Join Meeting'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'Join Meeting' ? 'text-[#79131d] border-b-2 border-[#79131d]' :
                    'text-gray-600 hover:text-[#79131d]'">
                {{ __('messages.join_meeting') }}
            </a>
        </div>

        <!-- Overview Section -->
        <div x-show="activeTab === 'overview'" id="overview-section" x-transition>
            <h1 class="text-3xl font-bold mb-3">{{ $diplomas->name }}</h1>

            <!-- Course Image -->
            <div class="mb-6 flex justify-center">
                @php
                    $defaultPhoto =
                        'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg';
                    $imagePath =
                        $diplomas->image && Storage::disk('public')->exists($diplomas->image)
                            ? asset('storage/' . $diplomas->image)
                            : $defaultPhoto;
                @endphp

                <img src="{{ $imagePath }}" alt="{{ $diplomas->name }}" class="w-full h-48 object-cover">
            </div>

            <!-- Learning Scheduler Section -->
            <!-- Learning Scheduler Section -->
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
                <h3 class="font-bold text-lg mb-2">{{ __('messages.schedule_learning') }}</h3>
                <p class="text-gray-700 mb-3">{{ $diplomas->description }}</p>

                @if (!$requests)
                    <form action="{{ route('gate.diplomas.request', $diplomas) }}" method="POST"
                        class="inline-block mt-2">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2 bg-[#79131d] text-white rounded-lg font-semibold hover:bg-[#5a0f16] transition">
                            {{ __('messages.certificate') }}
                        </button>
                    </form>
                @else
                    <p> هنا ستظهر شهادتك الخاصة بعد قبول طلبك من الإدارة.</p>
                    <a href="{{ asset('storage/' . $send->file) }}" target="_blank"
                        class="inline-block px-4 py-2 mt-2 rounded-lg bg-[#79131d] text-white font-semibold hover:bg-[#5c0f14] transition">
                        الشهادة
                    </a>
                @endif


            </div>


            <!-- Course Schedule Table -->
            @if ($diplomas->courseSchedule && count($diplomas->courseSchedule) > 0)
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">
                                    {{ __('messages.day') }}</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">
                                    {{ __('messages.start_time') }}</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">
                                    {{ __('messages.end_time') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diplomas->courseSchedule->sortByDesc('created_at')->take(3) as $schedule)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">{{ $schedule->day }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">{{ $schedule->start_time }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700 border-b">{{ $schedule->end_time }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 mb-6">{{ __('messages.no_schedule') }}</p>
            @endif


        </div>

        <!-- Notes Section -->
        <div x-show="activeTab === 'notes'" id="notes-section" x-transition>
            <h3 class="text-xl font-semibold mb-4">{{ __('messages.notes') }}</h3>
            <p class="text-gray-700 mb-4">{{ __('messages.notes_description') }}</p>

            <div class="bg-white p-4 rounded border border-gray-200 shadow-sm">
                <h4 class="font-bold mb-2">{{ __('messages.note_title') }}</h4>
                <p class="text-sm text-gray-600">{{ __('messages.note_text') }}</p>
            </div>
        </div>

        <!-- Join Meeting Section -->
        <div x-show="activeTab === 'Join Meeting'" id="join-meeting-section" x-transition>
            <h3 class="text-2xl font-bold text-[#79131d] mb-4">{{ __('messages.meettitle') }}</h3>

            @if ($zoommeeting && $zoommeeting->join_url)
                <div class="bg-green-50 border border-green-200 p-6 rounded-lg text-center shadow-sm">
                    <p class="text-green-800 font-medium mb-2">
                        {{ __('messages.available') }}
                    </p>
                    <a href="{{ route('zoom.join.student', $zoommeeting->id) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        {{ __('messages.join_now') }}
                    </a>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-md text-sm text-gray-700 shadow-sm">
                    {{ __('messages.not_available') }}
                </div>
            @endif
        </div>

        <hr class="font-bold">
    </div>
    <!-- Lessons List -->
    @php
        $lessons = $diplomas->lessons;
        $perPage = 3;
        $totalLessons = count($lessons);
        $totalPages = ceil($totalLessons / $perPage);
    @endphp

    <!-- Custom Loader -->
    <div id="lesson-loader" class="fixed inset-0 bg-white/80 flex items-center justify-center z-50"
        dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="w-16 h-16 border-[6px] border-[#79131d] border-t-transparent rounded-full animate-spin"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 mb-16" x-data="{ expandedCard: null }"
        dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <h2 class="text-2xl font-semibold mb-6">{{ __('messages.lessons_title') }}</h2>

        @if ($lessons->isEmpty())
            <div class="text-center py-10 text-gray-600 bg-white rounded-lg shadow border">
                {{ __('messages.no_lessons') }}
            </div>
        @else
            <!-- Lessons Tabs -->
            <div id="lessons-wrapper" class="relative">
                @for ($page = 1; $page <= $totalPages; $page++)
                    <div class="lesson-page grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-all duration-300 ease-in-out"
                        data-page="{{ $page }}" style="{{ $page !== 1 ? 'display:none' : '' }}">
                        @foreach ($lessons->forPage($page, $perPage) as $lesson)
                            <!-- كارد الدرس -->
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1"
                                x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false"
                                :class="{
                                    'scale-105 z-10': expandedCard === {{ $lesson->id }},
                                    'scale-100': expandedCard !== {{ $lesson->id }}
                                }"
                                @click="expandedCard = expandedCard === {{ $lesson->id }} ? null : {{ $lesson->id }}">
                                <!-- صورة -->
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $lesson->image) }}" alt="{{ $lesson->title }}"
                                        class="h-40 w-full object-cover transition-all duration-300"
                                        :class="{ 'brightness-75': isHovered }">

                                    <!-- زر التشغيل -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300"
                                        :class="{ 'opacity-100': isHovered }">
                                        <div class="bg-[#79131DDA] bg-opacity-80 rounded-full p-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- المحتوى -->
                                <div class="p-4 flex-1 flex flex-col justify-between transition-all duration-300"
                                    :class="{
                                        'h-auto': expandedCard === {{ $lesson->id }},
                                        'h-40': expandedCard !== {{ $lesson->id }}
                                    }">
                                    <div>
                                        <h3 class="text-lg font-bold mb-1 text-gray-800">
                                            {{ \Illuminate\Support\Str::limit($lesson->title, 25) }}
                                        </h3>
                                        <p class="text-sm text-gray-600 transition-all duration-300"
                                            :class="{
                                                'line-clamp-3': expandedCard !== {{ $lesson->id }},
                                                'line-clamp-none': expandedCard === {{ $lesson->id }}
                                            }">
                                            {{ $lesson->description }}
                                        </p>
                                    </div>
                                    <div class="mt-4 transition-all duration-300"
                                        :class="{
                                            'opacity-100 translate-y-0': expandedCard === {{ $lesson->id }} ||
                                                isHovered,
                                            'opacity-0 translate-y-2': expandedCard !== {{ $lesson->id }} && !
                                                isHovered
                                        }">
                                        <a href="{{ route('gate.diplomas.lesson.show', $lesson) }}"
                                            class="inline-block bg-[#79131DDA] text-[#e4ce96] px-4 py-2 rounded hover:bg-[#5a0e16] font-medium text-sm transition-colors duration-300 flex items-center">
                                            {{ __('messages.go_to_lesson') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endfor
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center items-center space-x-2"
                dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                <button id="lesson-prev-btn"
                    class="px-4 py-2 border rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 transition-colors duration-200"
                    disabled>
                    {{ __('messages.prev') }}
                </button>

                <div id="lesson-tabs" class="flex space-x-1">
                    @php
                        $currentPage = 1;
                        $visibleTabs = 4;
                        $start = 1;
                        $end = min($totalPages, $visibleTabs);
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <button data-page="{{ $i }}"
                            class="w-10 h-10 flex items-center justify-center rounded-md text-sm font-semibold transition-all duration-200 border border-[#79131d]
                    {{ $i === 1 ? 'bg-[#79131d] text-white' : 'bg-transparent text-gray-700 hover:bg-[#79131d] hover:text-white' }}">
                            {{ $i }}
                        </button>
                    @endfor
                </div>

                <button id="lesson-next-btn"
                    class="px-4 py-2 border rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    {{ __('messages.next') }}
                </button>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('lesson-loader').style.display = 'none';

            const lessonPages = document.querySelectorAll('.lesson-page');
            const prevBtn = document.getElementById('lesson-prev-btn');
            const nextBtn = document.getElementById('lesson-next-btn');
            const totalPages = {{ $totalPages }};
            const maxTabs = 4;
            let currentPage = 1;

            function updateLessonView() {
                lessonPages.forEach(page => {
                    if (parseInt(page.dataset.page) === currentPage) {
                        page.style.display = 'grid';
                        page.style.animation = 'fadeIn 0.5s ease-in-out';
                    } else {
                        page.style.display = 'none';
                    }
                });
            }

            function renderLessonTabs() {
                const tabsContainer = document.getElementById('lesson-tabs');
                tabsContainer.innerHTML = '';
                let start = Math.max(1, currentPage - Math.floor(maxTabs / 2));
                let end = start + maxTabs - 1;
                if (end > totalPages) {
                    end = totalPages;
                    start = Math.max(1, end - maxTabs + 1);
                }

                for (let i = start; i <= end; i++) {
                    const btn = document.createElement('button');
                    btn.dataset.page = i;
                    btn.textContent = i;
                    btn.className = `w-10 h-10 flex items-center justify-center rounded-md text-sm font-semibold transition-all duration-200 border border-[#79131d] ${
                    i === currentPage
                        ? 'bg-[#79131d] text-white'
                        : 'bg-transparent text-gray-700 hover:bg-[#79131d] hover:text-white'
                }`;
                    btn.addEventListener('click', () => {
                        currentPage = i;
                        updateLessonView();
                        renderLessonTabs();
                        prevBtn.disabled = currentPage === 1;
                        nextBtn.disabled = currentPage === totalPages;
                    });
                    tabsContainer.appendChild(btn);
                }
            }

            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateLessonView();
                    renderLessonTabs();
                    prevBtn.disabled = currentPage === 1;
                    nextBtn.disabled = currentPage === totalPages;
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateLessonView();
                    renderLessonTabs();
                    prevBtn.disabled = currentPage === 1;
                    nextBtn.disabled = currentPage === totalPages;
                }
            });

            updateLessonView();
            renderLessonTabs();
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .lesson-page {
            animation: fadeIn 0.5s ease-in-out;
        }

        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        #lesson-loader {
            transition: opacity 0.4s ease;
        }
    </style>

    <!-- Related Courses -->
    <div class="bg-gray-100 py-10 px-4" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl font-semibold mb-6">{{ __('messages.related_courses') }}</h2>

            @if ($relatedCourses->isEmpty())
                <div class="text-center py-10 text-gray-600 bg-white rounded-lg shadow border">
                    {{ __('messages.no_related_courses') }}
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($relatedCourses as $related)
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 cursor-pointer"
                            x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false"
                            :class="{ 'scale-105 z-10': isHovered, 'scale-100': !isHovered }">

                            @php

                                $defaultPhoto =
                                    'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg';

                                $imagePath =
                                    $related->image && Storage::disk('public')->exists($related->image)
                                        ? asset('storage/' . $related->image)
                                        : $defaultPhoto;
                            @endphp

                            <!-- الصورة -->
                            <div class="relative">
                                <img src="{{ $imagePath }}" alt="{{ $related->name }}"
                                    class="h-40 w-full object-cover transition-all duration-300"
                                    :class="{ 'brightness-75': isHovered }">

                                <!-- زر التشغيل -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300"
                                    :class="{ 'opacity-100': isHovered }">
                                    <div class="bg-[#79131DDA] bg-opacity-80 rounded-full p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>


                            <!-- المحتوى -->
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">
                                        {{ \Illuminate\Support\Str::limit($related->name, 40) }}
                                    </h3>
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit($related->description, 80) }}
                                    </p>
                                </div>
                                <div class="mt-4 transition-all duration-300"
                                    :class="{ 'opacity-100 translate-y-0': isHovered, 'opacity-0 translate-y-2': !isHovered }">
                                    <a href="{{ route('course.show', $related->slug) }}"
                                        class="inline-block bg-[#79131d] p-2 mt-2 text-[#e4ce96] hover:bg-[#5a0e16] text-sm font-medium rounded transition duration-300 flex items-center">
                                        {{ __('messages.view_course') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    {{-- footer --}}
    <x-footer />

    <style>
        .star-rating {
            direction: rtl;
            /* Makes hover effect work right-to-left */
            display: inline-flex;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #e2e8f0;
            /* Default gray color (Tailwind's slate-200) */
            cursor: pointer;
            font-size: 2rem;
            padding: 0 2px;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            color: #fbbf24;
            /* Gold color (Tailwind's amber-400) */
        }
    </style>

    <script>
        // Optional: Log the selected rating to console
        document.querySelectorAll('.star-rating input').forEach(star => {
            star.addEventListener('change', (e) => {
                console.log(`Selected rating: ${e.target.value}`);
            });
        });
    </script>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.effect(() => {
                // نجيب قيمة التاب الحالية من x-data
                const root = document.querySelector('[x-data]');
                if (!root) return;

                const activeTab = root.__x.$data.activeTab;

                if (activeTab === 'quizzes') {
                    // نمنع الرجوع بزرار Back بعد دخول تبويب quizzes
                    history.replaceState(null, null, location.href);
                }
            });
        });
    </script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
