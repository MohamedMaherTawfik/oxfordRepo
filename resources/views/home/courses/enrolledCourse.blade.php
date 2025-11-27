<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ $course->title }}</title>
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <header class="relative z-50">
        <x-navbar />
    </header>

    <!-- Course Header -->
    <div class="mt-5">.</div>
    <div class="mt-10">.</div>
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

            <a href="#" @click.prevent="activeTab = 'graduation'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'graduation' ? 'text-[#79131d] border-b-2 border-[#79131d]' :
                    'text-gray-600 hover:text-[#79131d]'"
                id="graduation-tab">
                {{ __('messages.graduation_project') }}
            </a>

            <a href="#" @click.prevent="activeTab = 'quizzes'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'quizzes' ? 'text-[#79131d] border-b-2 border-[#79131d]' :
                    'text-gray-600 hover:text-[#79131d]'">
                {{ __('messages.quizzes') }}
            </a>

            <a href="#" @click.prevent="activeTab = 'Join Meeting'" class="mr-6 font-medium transition-colors"
                :class="activeTab === 'Join Meeting' ? 'text-[#79131d] border-b-2 border-[#79131d]' :
                    'text-gray-600 hover:text-[#79131d]'">
                {{ __('messages.join_meeting') }}
            </a>
        </div>

        <!-- Overview Section -->
        <div x-show="activeTab === 'overview'" id="overview-section" x-transition>
            <h1 class="text-3xl font-bold mb-3">{{ $course->title }}</h1>

            <!-- Course Image -->
            <div class="mb-6 flex justify-center">
                <img src="{{ $course->cover_photo_url }}"
                    class="w-[400px] h-[200px] object-cover rounded-md shadow-md transition-transform duration-300 hover:scale-105"
                    alt="{{ $course->title }}">
            </div>

            <!-- Learning Scheduler Section -->
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
                <h3 class="font-bold text-lg mb-2">{{ __('messages.schedule_learning') }}</h3>
                <p class="text-gray-700 mb-3">{{ $course->description }}</p>
            </div>


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

        <!-- Graduation Project Section -->
        <div x-show="activeTab === 'graduation'" id="graduation-section" x-transition>
            <h3 class="text-2xl font-bold text-[#79131d] mb-4">{{ __('messages.graduation_project') }}</h3>

            @if ($projects->isEmpty())
                <div class="text-center py-10 text-gray-600 bg-white rounded-lg shadow border">
                    {{ __('messages.no_project') }}
                </div>
            @else
                @foreach ($projects as $item)
                    @foreach ($assignemtns as $assign)
                        @if ($assign->graduation_project_id == $item->id)
                            <p class="font-bold text-dark text-3xl">{{ __('messages.project_uploaded') }}</p>
                            <hr>
                        @else
                            <div class="bg-blue-50 border border-blue-100 p-6 rounded-lg mb-6">
                                <h4 class="text-xl font-semibold mb-2">
                                    {{ $item->title ?? __('messages.project_title') }}</h4>
                                <p class="text-gray-700 mb-3">
                                    {{ $item->description ?? __('messages.project_description') }}</p>

                                @if (!empty($item->file) && Storage::disk('public')->exists($item->file))
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                        class="flex items-center space-x-2 text-[#79131d] hover:text-[#5a0e16] transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V8l-6-6H4z" />
                                            <path d="M14 2v6h6" />
                                        </svg>
                                        <button type="button"
                                            class="inline-flex items-center px-4 py-2 bg-[#79131d] text-[#e4ce96] rounded hover:bg-[#5a0e16] transition text-sm font-medium">
                                            {{ __('messages.show_project') }}
                                        </button>
                                    </a>
                                @else
                                    <p class="text-sm text-red-500">{{ __('messages.no_file') }}</p>
                                @endif
                            </div>

                            <form action="{{ route('messages.project.submit', $item) }}" method="POST"
                                enctype="multipart/form-data"
                                class="bg-white p-6 rounded-lg shadow border border-gray-200 space-y-4">
                                @csrf

                                <div>
                                    <label for="project_file" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('messages.submit_work') }}
                                    </label>
                                    <input type="file" id="project_file" name="project_file" accept=".pdf,.docx,.zip"
                                        required
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#79131d] focus:border-[#79131d]">
                                </div>

                                <button type="submit"
                                    class="bg-[#79131d] text-[#e4ce96] hover:bg-[#5a0e16] px-4 py-2 rounded font-semibold text-sm transition-colors duration-300">
                                    {{ __('messages.submit_project') }}
                                </button>
                            </form>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </div>

        <!-- Quizzes Section -->
        <div x-show="activeTab === 'quizzes'" id="quizzes-section" x-transition>
            <h3 class="text-2xl font-bold text-[#79131d] mb-4">{{ __('messages.available_quizzes') }}</h3>

            @if ($quizzes->isEmpty())
                <div class="text-center py-10 text-gray-600 bg-white rounded-lg shadow border">
                    {{ __('messages.no_quizzes') }}
                </div>
            @else
                @foreach ($quizzes as $quiz)
                    <div class="p-4 bg-white shadow rounded mb-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $quiz->title }}</h3>
                        @php
                            $result = Result::where('quizes_id', $quiz->id)->first();
                        @endphp
                        @if ($result)
                            <span class="inline-block bg-[#79131d] text-[#e4ce96] px-4 py-2 rounded">
                                {{ __('messages.attempted_quiz') }}
                            </span>
                            <a href="{{ route('student.quiz.result', $quiz->slug) }}"
                                class="ml-4 inline-flex items-center gap-1 text-[#79131d] hover:text-[#5a0e16] font-medium transition">
                                {{ __('messages.view_result') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('student.quiz.show', $quiz->slug) }}"
                                class="bg-[#79131d] text-[#e4ce96] px-4 py-2 rounded hover:bg-[#5a0e16] transition">
                                {{ __('messages.start_quiz') }}
                            </a>
                        @endif
                    </div>
                @endforeach
            @endif
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
        $lessons = $course->lessons;
        $perPage = 3;
        $totalLessons = count($lessons);
        $totalPages = ceil($totalLessons / $perPage);
    @endphp

    <!-- Custom Loader -->
    <div id="lesson-loader" class="fixed inset-0 bg-white/80 flex items-center justify-center z-50"
        dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="w-16 h-16 border-[6px] border-[#79131d] border-t-transparent rounded-full animate-spin"></div>
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
    <div class="bg-gray-100 py-8 sm:py-10 px-3 sm:px-4" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-xl sm:text-2xl font-semibold mb-6 text-center sm:text-start">
                {{ __('messages.related_courses') }}
            </h2>

            @if ($relatedCourses->isEmpty())
                <div class="text-center py-10 text-gray-600 bg-white rounded-lg shadow border">
                    {{ __('messages.no_related_courses') }}
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach ($relatedCourses as $related)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                            x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">

                            <!-- IMAGE -->
                            <div class="relative">
                                <img src="{{ $related->cover_photo_url }}" alt="{{ $related->title }}"
                                    class="h-48 sm:h-44 md:h-40 w-full object-cover transition duration-300"
                                    :class="{ 'brightness-75': isHovered }">

                                <div class="absolute inset-0 flex items-center justify-center opacity-0 transition duration-300"
                                    :class="{ 'opacity-100': isHovered }">
                                    <div class="bg-[#79131D] bg-opacity-90 rounded-full p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- CONTENT -->
                            <div class="p-4 flex flex-col justify-between flex-1">
                                <div>
                                    <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-2">
                                        {{ \Illuminate\Support\Str::limit($related->title, 40) }}
                                    </h3>
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit($related->description, 80) }}
                                    </p>
                                </div>

                                <div class="mt-4 transition-all duration-300"
                                    :class="{
                                        'opacity-100 translate-y-0': isHovered,
                                        'opacity-100 sm:opacity-0 translate-y-2':
                                            !isHovered
                                    }">

                                    <a href="{{ route('course.show', $related->slug) }}"
                                        class="w-full text-center bg-[#79131d] px-4 py-2 text-[#e4ce96] hover:bg-[#5a0e16] text-sm font-semibold rounded-lg transition flex items-center justify-center gap-1">
                                        {{ __('messages.view_course') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
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
