<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - {{ __('course.details_page_title') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('node_modules/flag-icons/css/flag-icons.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <script>
        function scheduleSelector() {
            return {
                activeTab: 'schedule',
                selectedDays: [],
                scheduleTimes: {
                    saturday: '',
                    sunday: '',
                    monday: '',
                    tuesday: '',
                    wednesday: '',
                    thursday: ''
                },
                handleDaySelection(day) {
                    if (!this.selectedDays.includes(day)) {
                        this.scheduleTimes[day] = '';
                    }

                    if (day === 'sunday') {
                        if (this.selectedDays.includes('sunday')) {
                            if (!this.selectedDays.includes('tuesday')) this.selectedDays.push('tuesday');
                            if (!this.selectedDays.includes('thursday')) this.selectedDays.push('thursday');
                            if (this.scheduleTimes.sunday) {
                                this.scheduleTimes.tuesday = this.scheduleTimes.sunday;
                                this.scheduleTimes.thursday = this.scheduleTimes.sunday;
                            }
                        } else {
                            this.selectedDays = this.selectedDays.filter(d => d !== 'tuesday' && d !== 'thursday');
                            this.scheduleTimes.tuesday = '';
                            this.scheduleTimes.thursday = '';
                        }
                    }

                    if (day === 'saturday') {
                        if (this.selectedDays.includes('saturday')) {
                            if (!this.selectedDays.includes('monday')) this.selectedDays.push('monday');
                            if (!this.selectedDays.includes('wednesday')) this.selectedDays.push('wednesday');
                            if (this.scheduleTimes.saturday) {
                                this.scheduleTimes.monday = this.scheduleTimes.saturday;
                                this.scheduleTimes.wednesday = this.scheduleTimes.saturday;
                            }
                        } else {
                            this.selectedDays = this.selectedDays.filter(d => d !== 'monday' && d !== 'wednesday');
                            this.scheduleTimes.monday = '';
                            this.scheduleTimes.wednesday = '';
                        }
                    }

                    if ((day === 'monday' || day === 'wednesday') && this.selectedDays.includes(day)) {
                        if (!this.selectedDays.includes('saturday')) this.selectedDays.push('saturday');
                    }
                    if ((day === 'tuesday' || day === 'thursday') && this.selectedDays.includes(day)) {
                        if (!this.selectedDays.includes('sunday')) this.selectedDays.push('sunday');
                    }
                },
                canShowPayment() {
                    return this.selectedDays.some(day => this.scheduleTimes[day] !== '');
                },
                hasSelectedSchedule() {
                    return this.selectedDays.length > 0 && this.selectedDays.some(day => this.scheduleTimes[day] !== '');
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }

        [dir="rtl"] .text-left {
            text-align: right !important;
        }

        [dir="rtl"] .flex-row {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .ml-2 {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }

        [dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }

        [dir="rtl"] .space-x-2>*+* {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }

        [dir="rtl"] .space-x-reverse>*+* {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }

        [dir="rtl"] table {
            direction: rtl;
        }

        [dir="rtl"] .text-right {
            text-align: right !important;
        }

        [dir="rtl"] .justify-end {
            justify-content: flex-end !important;
        }

        [dir="rtl"] .justify-start {
            justify-content: flex-start !important;
        }

        .sticky-sidebar {
            position: sticky;
            top: 100px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .schedule-table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .schedule-table thead th:first-child {
            border-top-left-radius: 0.75rem;
        }

        .schedule-table thead th:last-child {
            border-top-right-radius: 0.75rem;
        }
    </style>
</head>

<body class="bg-white" x-data="scheduleSelector()" data-is-auth="{{ auth()->check() ? 'true' : 'false' }}">
    <x-navbar />

    <!-- Hero Section - Udemy Style -->
    <section class="bg-white border-b border-gray-200 pt-24 md:pt-28">
        <div class="container mx-auto px-4 md:px-6 py-8">
            <div class="max-w-7xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="mb-6 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    <ol
                        class="flex items-center space-x-2 text-sm text-gray-600 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse space-x-reverse' : '' }}">
                        <li><a href="{{ route('home') }}"
                                class="hover:text-[#79131d]">{{ __('messages.home') ?? 'Home' }}</a></li>
                        <li><i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-xs"></i>
                        </li>
                        <li><a href="{{ route('courses.all') }}"
                                class="hover:text-[#79131d]">{{ __('messages.courses') ?? 'Courses' }}</a></li>
                        <li><i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} text-xs"></i>
                        </li>
                        <li class="text-gray-900 font-medium">{{ Str::limit($course->title, 50) }}</li>
                    </ol>
                </nav>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Course Image -->
                    <div class="lg:w-2/5 {{ app()->getLocale() === 'ar' ? 'lg:order-2' : 'lg:order-1' }}">
                        <div class="relative rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ $course->cover_photo_url }}" alt="{{ $course->title }}"
                                class="w-full h-64 lg:h-96 object-cover">
                            <div class="absolute top-4 {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }}">
                                <span class="px-3 py-1 bg-[#79131d] text-white text-xs font-semibold rounded">
                                    {{ $course->category->name }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div
                        class="lg:w-3/5 flex flex-col {{ app()->getLocale() === 'ar' ? 'text-right lg:order-1' : 'text-left lg:order-2' }}">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                            {{ $course->title }}
                        </h1>

                        <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                            {{ Str::limit($course->description, 200) }}
                        </p>

                        <!-- Course Stats -->
                        <div
                            class="flex flex-wrap items-center gap-4 mb-6 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }}">
                            <div
                                class="flex items-center gap-2 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                                <div class="flex items-center gap-1 text-yellow-500">
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 mx-1">5.0</span>
                                <span class="text-sm text-gray-600 mx-1">(0
                                    {{ __('messages.reviews') ?? 'reviews' }})</span>
                            </div>
                            <div
                                class="flex items-center gap-2 text-gray-600 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                                <i class="fas fa-users text-sm"></i>
                                <span class="text-sm mx-1">0 {{ __('messages.students') ?? 'students' }}</span>
                            </div>
                            <div
                                class="flex items-center gap-2 text-gray-600 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                                <i class="far fa-clock text-sm"></i>
                                <span class="text-sm mx-1">{{ $course->duration }} {{ __('messages.hours') }}</span>
                            </div>
                        </div>

                        <!-- Instructor Info -->
                        <div
                            class="flex items-center gap-3 mb-6 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }}">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 flex-shrink-0">
                                <img src="{{ $course->user && $course->user->photo ? asset('storage/' . $course->user->photo) : 'https://cdn.vectorstock.com/i/1000v/66/13/default-avatar-profile-icon-social-media-user-vector-49816613.jpg' }}"
                                    alt="{{ $course->user->name ?? 'Instructor' }}" class="w-full h-full object-cover">
                            </div>
                            <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                <p class="text-sm text-gray-600 mb-1">{{ __('messages.created_by') ?? 'Created by' }}
                                </p>
                                <p class="font-semibold text-gray-900">{{ $course->user->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Last Updated -->
                        <div
                            class="text-sm text-gray-600 mb-6 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            <i class="far fa-calendar-alt {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            <span>{{ __('messages.last_updated') ?? 'Last updated' }}:
                                {{ \Carbon\Carbon::parse($course->updated_at)->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content with Sidebar -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Main Content -->
                    <div
                        class="lg:w-2/3 {{ app()->getLocale() === 'ar' ? 'lg:order-1 text-right' : 'lg:order-1 text-left' }}">
                        <!-- Tabs Navigation -->
                        <div class="bg-white border-b border-gray-200 mb-6">
                            <nav class="flex {{ app()->getLocale() === 'ar' ? 'justify-end flex-row-reverse space-x-reverse' : 'justify-start space-x-8' }}"
                                aria-label="Tabs" style="{{ app()->getLocale() === 'ar' ? 'gap: 2rem;' : '' }}">
                                <button @click="activeTab = 'overview'"
                                    :class="activeTab === 'overview' ? 'border-[#79131d] text-[#79131d]' :
                                        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    {{ __('messages.overview') ?? 'Overview' }}
                                </button>
                                <button @click="activeTab = 'curriculum'"
                                    :class="activeTab === 'curriculum' ? 'border-[#79131d] text-[#79131d]' :
                                        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    {{ __('messages.curriculum') ?? 'Curriculum' }}
                                </button>
                                <button @click="activeTab = 'instructor'"
                                    :class="activeTab === 'instructor' ? 'border-[#79131d] text-[#79131d]' :
                                        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    {{ __('messages.instructor') ?? 'Instructor' }}
                                </button>
                                <button @click="activeTab = 'schedule'"
                                    :class="activeTab === 'schedule' ? 'border-[#79131d] text-[#79131d]' :
                                        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    {{ app()->getLocale() === 'ar' ? 'الحجز' : __('messages.schedule') ?? 'Schedule' }}
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content: Overview -->
                        <div x-show="activeTab === 'overview'" class="bg-white rounded-lg shadow-sm p-6 mb-6">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.what_you_will_learn') }}
                            </h2>
                            <div
                                class="prose max-w-none text-gray-700 leading-relaxed {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {!! nl2br(e($course->description)) !!}
                            </div>

                            <h2
                                class="text-2xl font-bold text-gray-900 mt-8 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.course_content') }}
                            </h2>
                            <ul class="space-y-3 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                <li
                                    class="flex items-start gap-3 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }}">
                                    <i class="fas fa-check-circle text-[#79131d] mt-1 flex-shrink-0"></i>
                                    <span class="text-gray-700">{{ $course->duration }} {{ __('messages.hours') }}
                                        {{ __('messages.on_demand_video') }}</span>
                                </li>
                                <li
                                    class="flex items-start gap-3 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }}">
                                    <i class="fas fa-check-circle text-[#79131d] mt-1 flex-shrink-0"></i>
                                    <span class="text-gray-700">{{ __('messages.full_lifetime_access') }}</span>
                                </li>
                                <li
                                    class="flex items-start gap-3 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }}">
                                    <i class="fas fa-check-circle text-[#79131d] mt-1 flex-shrink-0"></i>
                                    <span class="text-gray-700">{{ __('messages.certificate_of_completion') }}</span>
                                </li>
                            </ul>

                            <h2
                                class="text-2xl font-bold text-gray-900 mt-8 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.requirements') }}
                            </h2>
                            <ul
                                class="list-disc space-y-2 text-gray-700 {{ app()->getLocale() === 'ar' ? 'text-right list-inside' : 'text-left list-inside' }}">
                                <li>{{ __('messages.no_prerequisites') }}</li>
                                <li>{{ __('messages.willingness_to_learn') }}</li>
                            </ul>
                        </div>

                        <!-- Tab Content: Curriculum -->
                        <div x-show="activeTab === 'curriculum'" class="bg-white rounded-lg shadow-sm p-6 mb-6">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-6 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.course_content') ?? 'Course Content' }}
                            </h2>
                            @if ($course->lessons && $course->lessons->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($course->lessons as $lesson)
                                        <div
                                            class="border border-gray-200 rounded-lg p-4 hover:border-[#79131d] transition-colors">
                                            <div
                                                class="flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                                                <div
                                                    class="flex items-center gap-3 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                                                    <i class="fas fa-play-circle text-[#79131d] text-xl"></i>
                                                    <div>
                                                        <h3 class="font-semibold text-gray-900">{{ $lesson->title }}
                                                        </h3>
                                                        <p class="text-sm text-gray-600">
                                                            {{ $lesson->duration ?? '10:00' }}
                                                            {{ __('messages.min') ?? 'min' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p
                                    class="text-gray-600 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    {{ __('messages.no_lessons_available') ?? 'No lessons available yet' }}</p>
                            @endif
                        </div>

                        <!-- Tab Content: Instructor -->
                        <div x-show="activeTab === 'instructor'" class="bg-white rounded-lg shadow-sm p-6 mb-6">
                            <div
                                class="flex flex-col md:flex-row gap-6 {{ app()->getLocale() === 'ar' ? 'md:flex-row-reverse' : '' }}">
                                <div class="flex-shrink-0">
                                    <img src="{{ $course->user && $course->user->photo ? asset('storage/' . $course->user->photo) : 'https://cdn.vectorstock.com/i/1000v/66/13/default-avatar-profile-icon-social-media-user-vector-49816613.jpg' }}"
                                        alt="{{ $course->user->name ?? 'Instructor' }}"
                                        class="w-32 h-32 rounded-full object-cover border-4 border-[#79131d]">
                                </div>
                                <div class="flex-1 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                        {{ $course->user->name ?? 'N/A' }}
                                    </h2>
                                    <p class="text-gray-600 mb-4">
                                        {{ __('messages.certified_expert') ?? 'Certified Expert' }}</p>
                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                            <p class="text-sm text-gray-600">
                                                {{ __('messages.total_students') ?? 'Total Students' }}</p>
                                            <p class="text-lg font-semibold text-gray-900">0</p>
                                        </div>
                                        <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                            <p class="text-sm text-gray-600">{{ __('messages.courses') ?? 'Courses' }}
                                            </p>
                                            <p class="text-lg font-semibold text-gray-900">
                                                {{ $course->user && $course->user->courses ? $course->user->courses->count() : 0 }}
                                            </p>
                                        </div>
                                        <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                            <p class="text-sm text-gray-600">{{ __('messages.rating') ?? 'Rating' }}
                                            </p>
                                            <p class="text-lg font-semibold text-gray-900">5.0</p>
                                        </div>
                                        <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                            <p class="text-sm text-gray-600">{{ __('messages.reviews') ?? 'Reviews' }}
                                            </p>
                                            <p class="text-lg font-semibold text-gray-900">0</p>
                                        </div>
                                    </div>
                                    <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                        <h3 class="font-semibold text-gray-900 mb-2">
                                            {{ __('messages.about_instructor') ?? 'About Instructor' }}</h3>
                                        <p class="text-gray-700 leading-relaxed">
                                            {{ __('messages.instructor_bio_placeholder') ?? 'Professional instructor with years of experience in teaching and professional development.' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Content: Schedule -->
                        <div x-show="activeTab === 'schedule'" class="bg-white rounded-lg shadow-sm p-6 mb-6">
                            <h2
                                class="text-2xl font-bold text-gray-900 mb-6 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.select_training_days') }}
                            </h2>
                            <div class="overflow-x-auto">
                                <table
                                    class="schedule-table min-w-full bg-white rounded-lg border border-gray-200 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    <thead class="bg-[#79131d]">
                                        <tr>
                                            <th
                                                class="px-6 py-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} text-white font-semibold">
                                                {{ __('messages.day') }}
                                            </th>
                                            <th
                                                class="px-6 py-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-center' }} text-white font-semibold">
                                                {{ __('messages.select_time') }}
                                            </th>
                                            <th class="px-6 py-4 text-center text-white font-semibold">
                                                {{ __('messages.select_day') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @php
                                            $days = [
                                                'saturday' => __('messages.saturday'),
                                                'sunday' => __('messages.sunday'),
                                                'monday' => __('messages.monday'),
                                                'tuesday' => __('messages.tuesday'),
                                                'wednesday' => __('messages.wednesday'),
                                                'thursday' => __('messages.thursday'),
                                            ];
                                        @endphp

                                        @foreach ($days as $dayKey => $dayName)
                                            @php
                                                $hasSchedule = $schedule->where('day', $dayKey)->count() > 0;
                                            @endphp

                                            <tr class="hover:bg-gray-50 {{ !$hasSchedule ? 'bg-gray-100 opacity-60' : '' }}"
                                                :class="selectedDays.includes('{{ $dayKey }}') ? 'bg-green-50' : ''">
                                                <td
                                                    class="px-6 py-4 font-medium text-gray-900 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                                    {{ $dayName }}
                                                    @if (!$hasSchedule)
                                                        <span
                                                            class="text-xs text-red-500 block mt-1 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                                            <i
                                                                class="fas fa-exclamation-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                                            {{ __('messages.no_schedule') ?? 'No schedule' }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                    <select x-model="scheduleTimes.{{ $dayKey }}"
                                                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:border-[#79131d] focus:ring-1 focus:ring-[#79131d] {{ !$hasSchedule ? 'bg-gray-200 cursor-not-allowed' : '' }} {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                                                        {{ !$hasSchedule ? 'disabled' : '' }}>
                                                        <option value="">-- {{ __('messages.select_time') }} --
                                                        </option>
                                                        @php $printed = []; @endphp
                                                        @foreach ($schedule as $item)
                                                            @if ($item->day == $dayKey)
                                                                @php
                                                                    $start = \Carbon\Carbon::parse(
                                                                        $item->start_time,
                                                                    )->format('g:i A');
                                                                    $end = \Carbon\Carbon::parse(
                                                                        $item->end_time,
                                                                    )->format('g:i A');
                                                                    $timeValue =
                                                                        $item->start_time .
                                                                        '|' .
                                                                        $item->end_time .
                                                                        '|' .
                                                                        $item->id;
                                                                @endphp
                                                                @if (!in_array($timeValue, $printed))
                                                                    @php $printed[] = $timeValue; @endphp
                                                                    <option value="{{ $timeValue }}">
                                                                        {{ $start }} - {{ $end }}
                                                                    </option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="px-6 py-4 text-center">
                                                    <input type="checkbox" x-model="selectedDays"
                                                        value="{{ $dayKey }}"
                                                        @change="handleDaySelection('{{ $dayKey }}')"
                                                        class="w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d] {{ !$hasSchedule ? 'cursor-not-allowed opacity-50' : '' }}"
                                                        {{ !$hasSchedule ? 'disabled' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Payment Buttons -->
                            <div x-show="canShowPayment()"
                                class="mt-6 flex flex-wrap gap-4 {{ app()->getLocale() === 'ar' ? 'justify-center flex-row-reverse' : 'justify-center' }}">
                                @if ($visaenables && $visaenables->visa_enable == 1)
                                    @guest
                                        <form action="{{ route('pay.form.login', [$course, 'visa']) }}" method="post">
                                            @csrf
                                            <template x-for="day in selectedDays" :key="day">
                                                <div>
                                                    <input type="hidden" :name="'days[' + day + '][id]'"
                                                        :value="scheduleTimes[day].split('|')[2]">
                                                    <input type="hidden" :name="'days[' + day + '][start_time]'"
                                                        :value="scheduleTimes[day].split('|')[0]">
                                                    <input type="hidden" :name="'days[' + day + '][end_time]'"
                                                        :value="scheduleTimes[day].split('|')[1]">
                                                </div>
                                            </template>
                                            <button type="submit"
                                                class="px-6 py-3 bg-[#79131d] text-white font-semibold rounded-lg hover:bg-[#5a0f16] transition-colors">
                                                <i
                                                    class="fas fa-credit-card {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                                {{ __('messages.proceed_to_payment') }}
                                            </button>
                                        </form>
                                    @endguest
                                    @auth
                                        <form action="{{ route('pay.form.auth', $course) }}" method="get">
                                            @csrf
                                            <template x-for="day in selectedDays" :key="day">
                                                <div>
                                                    <input type="hidden" :name="'days[' + day + '][id]'"
                                                        :value="scheduleTimes[day].split('|')[2]">
                                                    <input type="hidden" :name="'days[' + day + '][start_time]'"
                                                        :value="scheduleTimes[day].split('|')[0]">
                                                    <input type="hidden" :name="'days[' + day + '][end_time]'"
                                                        :value="scheduleTimes[day].split('|')[1]">
                                                </div>
                                            </template>
                                            <button type="submit"
                                                class="px-6 py-3 bg-[#79131d] text-white font-semibold rounded-lg hover:bg-[#5a0f16] transition-colors">
                                                <i
                                                    class="fas fa-credit-card {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                                {{ __('messages.proceed_to_payment') }}
                                            </button>
                                        </form>
                                    @endauth
                                @endif

                                @if ($visaenables && $visaenables->cash_enable == 1)
                                    @guest
                                        <form action="{{ route('pay.form.login', [$course, 'cash']) }}" method="post">
                                            @csrf
                                            <template x-for="day in selectedDays" :key="day">
                                                <div>
                                                    <input type="hidden" :name="'days[' + day + '][id]'"
                                                        :value="scheduleTimes[day].split('|')[2]">
                                                    <input type="hidden" :name="'days[' + day + '][start_time]'"
                                                        :value="scheduleTimes[day].split('|')[0]">
                                                    <input type="hidden" :name="'days[' + day + '][end_time]'"
                                                        :value="scheduleTimes[day].split('|')[1]">
                                                </div>
                                            </template>
                                            <button type="submit"
                                                class="px-6 py-3 bg-[#e4ce96] text-[#79131d] font-semibold rounded-lg hover:bg-[#d4be86] transition-colors">
                                                <i
                                                    class="fas fa-money-bill-wave {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                                {{ __('messages.pay_cash') }}
                                            </button>
                                        </form>
                                    @endguest
                                    @auth
                                        <form action="{{ route('pay.form.auth', $course) }}" method="get">
                                            @csrf
                                            <template x-for="day in selectedDays" :key="day">
                                                <div>
                                                    <input type="hidden" :name="'days[' + day + '][id]'"
                                                        :value="scheduleTimes[day].split('|')[2]">
                                                    <input type="hidden" :name="'days[' + day + '][start_time]'"
                                                        :value="scheduleTimes[day].split('|')[0]">
                                                    <input type="hidden" :name="'days[' + day + '][end_time]'"
                                                        :value="scheduleTimes[day].split('|')[1]">
                                                </div>
                                            </template>
                                            <button type="submit"
                                                class="px-6 py-3 bg-[#e4ce96] text-[#79131d] font-semibold rounded-lg hover:bg-[#d4be86] transition-colors">
                                                <i
                                                    class="fas fa-money-bill-wave {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                                {{ __('messages.pay_cash') }}
                                            </button>
                                        </form>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar: Price & CTA -->
                    <div
                        class="lg:w-1/3 {{ app()->getLocale() === 'ar' ? 'lg:order-2 text-left' : 'lg:order-2 text-left' }}">
                        <div class="sticky-sidebar bg-white border border-gray-200 rounded-lg shadow-lg p-6">
                            <div class="mb-6">
                                <div class="flex items-baseline gap-2 mb-4 justify-start">
                                    @if (app()->getLocale() === 'ar')
                                        <span class="text-4xl font-bold text-gray-900">
                                            {{ $course->admin_price > 0 ? number_format($course->admin_price, 2) : number_format($course->price, 2) }}
                                        </span>
                                        <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                            alt="SAR" class="w-6 h-6 sar-symbol" style="display: inline-block;">
                                    @else
                                        <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                            alt="SAR" class="w-6 h-6 sar-symbol" style="display: inline-block;">
                                        <span class="text-4xl font-bold text-gray-900">
                                            {{ $course->admin_price > 0 ? number_format($course->admin_price, 2) : number_format($course->price, 2) }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Payment Buttons - Only show when schedule is selected -->
                                <div x-show="hasSelectedSchedule()" class="space-y-3 mb-4">
                                    @if ($visaenables && $visaenables->visa_enable == 1)
                                        @guest
                                            <form action="{{ route('pay.form.login', [$course, 'visa']) }}"
                                                method="post" id="visaFormGuest">
                                                @csrf
                                                <template x-for="day in selectedDays" :key="day">
                                                    <div>
                                                        <input type="hidden" :name="'days[' + day + '][id]'"
                                                            :value="scheduleTimes[day].split('|')[2]">
                                                        <input type="hidden" :name="'days[' + day + '][start_time]'"
                                                            :value="scheduleTimes[day].split('|')[0]">
                                                        <input type="hidden" :name="'days[' + day + '][end_time]'"
                                                            :value="scheduleTimes[day].split('|')[1]">
                                                    </div>
                                                </template>
                                                <button type="submit"
                                                    class="w-full bg-[#79131d] text-white font-bold py-4 rounded-lg hover:bg-[#5a0f16] transition-colors">
                                                    <i
                                                        class="fas fa-credit-card {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                                    {{ __('messages.proceed_to_payment') }}
                                                </button>
                                            </form>
                                        @endguest
                                        @auth
                                            <form action="{{ route('pay.form.auth', $course) }}" method="get"
                                                id="visaFormAuth">
                                                <template x-for="day in selectedDays" :key="day">
                                                    <div>
                                                        <input type="hidden" :name="'days[' + day + '][id]'"
                                                            :value="scheduleTimes[day].split('|')[2]">
                                                        <input type="hidden" :name="'days[' + day + '][start_time]'"
                                                            :value="scheduleTimes[day].split('|')[0]">
                                                        <input type="hidden" :name="'days[' + day + '][end_time]'"
                                                            :value="scheduleTimes[day].split('|')[1]">
                                                    </div>
                                                </template>
                                                <button type="submit"
                                                    class="w-full bg-[#79131d] text-white font-bold py-4 rounded-lg hover:bg-[#5a0f16] transition-colors">
                                                    <i
                                                        class="fas fa-credit-card {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                                    {{ __('messages.proceed_to_payment') }}
                                                </button>
                                            </form>
                                        @endauth
                                    @endif

                                    @if ($visaenables && $visaenables->cash_enable == 1)
                                        @guest
                                            <form action="{{ route('pay.form.login', [$course, 'cash']) }}"
                                                method="post" id="cashFormGuest">
                                                @csrf
                                                <template x-for="day in selectedDays" :key="day">
                                                    <div>
                                                        <input type="hidden" :name="'days[' + day + '][id]'"
                                                            :value="scheduleTimes[day].split('|')[2]">
                                                        <input type="hidden" :name="'days[' + day + '][start_time]'"
                                                            :value="scheduleTimes[day].split('|')[0]">
                                                        <input type="hidden" :name="'days[' + day + '][end_time]'"
                                                            :value="scheduleTimes[day].split('|')[1]">
                                                    </div>
                                                </template>
                                                <button type="submit"
                                                    class="w-full bg-[#e4ce96] text-[#79131d] font-bold py-4 rounded-lg hover:bg-[#d4be86] transition-colors">
                                                    <i
                                                        class="fas fa-money-bill-wave {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                                    {{ __('messages.pay_cash') }}
                                                </button>
                                            </form>
                                        @endguest
                                        @auth
                                            <form action="{{ route('pay.later.auth', $course) }}" method="get"
                                                id="cashFormAuth">
                                                <template x-for="day in selectedDays" :key="day">
                                                    <div>
                                                        <input type="hidden" :name="'days[' + day + '][id]'"
                                                            :value="scheduleTimes[day].split('|')[2]">
                                                        <input type="hidden" :name="'days[' + day + '][start_time]'"
                                                            :value="scheduleTimes[day].split('|')[0]">
                                                        <input type="hidden" :name="'days[' + day + '][end_time]'"
                                                            :value="scheduleTimes[day].split('|')[1]">
                                                    </div>
                                                </template>
                                                <button type="submit"
                                                    class="w-full bg-[#e4ce96] text-[#79131d] font-bold py-4 rounded-lg hover:bg-[#d4be86] transition-colors">
                                                    <i
                                                        class="fas fa-money-bill-wave {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                                    {{ __('messages.pay_cash') }}
                                                </button>
                                            </form>
                                        @endauth
                                    @endif
                                </div>

                                <!-- Message when no schedule selected -->
                                <div x-show="!hasSelectedSchedule()" class="mb-4">
                                    <p
                                        class="text-xs text-gray-500 text-center {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                        <i
                                            class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ app()->getLocale() === 'ar' ? 'يجب تحديد وقت الحجز أولاً' : __('messages.select_booking_time_first') ?? 'Please select booking time first' }}
                                    </p>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-6 space-y-4">
                                <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    <h3 class="font-semibold text-gray-900 mb-2">
                                        {{ __('messages.this_course_includes') ?? 'This course includes:' }}
                                    </h3>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li
                                            class="flex items-center gap-2 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }}">
                                            <i class="fas fa-video text-[#79131d]"></i>
                                            <span>{{ $course->duration }} {{ __('messages.hours') }}
                                                {{ __('messages.on_demand_video') ?? 'on-demand video' }}</span>
                                        </li>
                                        <li
                                            class="flex items-center gap-2 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }}">
                                            <i class="fas fa-mobile-alt text-[#79131d]"></i>
                                            <span>{{ __('messages.access_on_mobile_tv') ?? 'Access on mobile and TV' }}</span>
                                        </li>
                                        <li
                                            class="flex items-center gap-2 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }}">
                                            <i class="fas fa-certificate text-[#79131d]"></i>
                                            <span>{{ __('messages.certificate_of_completion') ?? 'Certificate of completion' }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer />
</body>

</html>
