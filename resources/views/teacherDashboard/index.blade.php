<x-teacher-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                {{ __('main.welcome_back') }}، {{ Auth::user()->name }} 👋
            </h1>
            <p class="text-gray-600">{{ __('teacher.overview') }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Courses Card -->
            <div
                class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-book-open text-2xl"></i>
                    </div>
                    <span class="text-blue-100 text-sm font-medium">{{ __('teacher.courses') }}</span>
                </div>
                <h3 class="text-4xl font-bold mb-2">{{ $totalCourses }}</h3>
                <p class="text-blue-100 text-sm flex items-center">
                    <i class="fas fa-book mr-2"></i>
                    <span>{{ __('teacher.your_courses') }}</span>
                </p>
            </div>

            <!-- Total Lessons Card -->
            <div
                class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-video text-2xl"></i>
                    </div>
                    <span class="text-purple-100 text-sm font-medium">{{ __('main.add_lesson') }}</span>
                </div>
                <h3 class="text-4xl font-bold mb-2">{{ $totalLessons }}</h3>
                <p class="text-purple-100 text-sm flex items-center">
                    <i class="fas fa-play-circle mr-2"></i>
                    <span>{{ __('main.add_lesson') }}</span>
                </p>
            </div>

            <!-- Total Enrollments Card -->
            <div
                class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <span class="text-green-100 text-sm font-medium">{{ __('teacher.enrollments') }}</span>
                </div>
                <h3 class="text-4xl font-bold mb-2">{{ $totalEnrollments }}</h3>
                <p class="text-green-100 text-sm flex items-center">
                    <i class="fas fa-user-check mr-2"></i>
                    <span>{{ __('teacher.enrollments') }}</span>
                </p>
            </div>

            <!-- Total Revenue Card -->
            <div
                class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-dollar-sign text-2xl"></i>
                    </div>
                    <span class="text-orange-100 text-sm font-medium">{{ __('teacher.total_revenue') }}</span>
                </div>
                <div class="flex items-center gap-2 mb-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol" style="display: inline-block;">
                    <h3 class="text-4xl font-bold">{{ number_format($totalRevenue, 2) }}</h3>
                </div>
                <p class="text-orange-100 text-sm flex items-center">
                    <i class="fas fa-chart-line mr-2"></i>
                    <span>{{ __('teacher.total_revenue') }}</span>
                </p>
            </div>
        </div>

        <!-- Courses Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <i class="fas fa-book-open"></i>
                        {{ __('teacher.your_courses') }} ({{ $totalCourses }})
                    </h2>
                    <a href="{{ route('teacher.courses.create') }}"
                        class="flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-plus"></i>
                        <span>{{ __('teacher.add_new_course') }}</span>
                    </a>
                </div>
            </div>

            @if ($courses->count() > 0)
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($courses as $course)
                            <div
                                class="group bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="relative h-48 overflow-hidden bg-gray-200">
                                    @if ($course->cover_photo && file_exists(public_path('storage/' . $course->cover_photo)))
                                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                            src="{{ asset('storage/' . $course->cover_photo) }}"
                                            alt="{{ $course->title }}">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                            <i class="fas fa-book text-6xl text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="absolute top-2 right-2">
                                        <span
                                            class="px-2 py-1 bg-black/50 text-white text-xs rounded-lg backdrop-blur-sm">
                                            {{ $course->enrollments->count() }} {{ __('teacher.enrollments') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded-lg">
                                            {{ $course->category->name ?? __('main.general') }}
                                        </span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                        {{ $course->title }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                        {{ $course->description }}
                                    </p>
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-2 text-sm text-gray-500">
                                            <i class="fas fa-video"></i>
                                            <span>{{ $course->lessons->count() }} {{ __('main.add_lesson') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 text-sm text-yellow-500">
                                            <i class="fas fa-star"></i>
                                            <span>{{ $course->rating ?? 0 }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('teacher.courses.show', $course->slug) }}"
                                        class="block w-full text-center px-4 py-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white rounded-lg hover:shadow-lg transition-all font-medium">
                                        <i class="fas fa-eye mr-2"></i>
                                        {{ __('teacher.course_detail') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="inline-block p-6 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-book-open text-6xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ __('teacher.your_courses') }}</h3>
                    <p class="text-gray-500 mb-6">{{ __('main.no_courses') }}</p>
                    <a href="{{ route('teacher.courses.create') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all font-medium">
                        <i class="fas fa-plus"></i>
                        <span>{{ __('teacher.add_new_course') }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sar-symbol {
            display: inline-block !important;
            width: 1em !important;
            height: 1em !important;
            vertical-align: middle !important;
        }
    </style>
</x-teacher-panel>
