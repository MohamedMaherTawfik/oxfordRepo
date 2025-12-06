@php
    use App\Models\categories;
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    $categories = categories::all();

    $coursesForJs = ($courses ?? collect())
        ->filter(fn($course) => $course->admin_price != 0)
        ->map(function ($course) {
            return [
                'id' => $course->id,
                'slug' => $course->slug,
                'user_id' => $course->user_id,
                'title' => $course->title,
                'description' => $course->description,
                'description_short' => Str::limit($course->description, 50),
                'price' => (int) ($course->admin_price ?? $course->price),
                'level' => ucfirst($course->level ?? 'Beginner'),
                'category_name' => $course->category->name ?? 'General',
                'cover_photo_url' => $course->cover_photo_url ?? '',
                'duration' => $course->duration ?? 0,
                'instructor' => $course->user->name ?? '—',
                'rating' => $course->rating ?? 0,
                'reviews_count' => $course->reviews_count ?? 0,
                'url' => isset($course->slug) ? route('course.show', $course->slug) : null,
                'start_date_formatted' => $course->start_date
                    ? Carbon::parse($course->start_date)->format('d M Y')
                    : null,
            ];
        })
        ->values()
        ->toArray();
@endphp


<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('node_modules/flag-icons/css/flag-icons.min.css') }}">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }

        [dir="rtl"] .course-card {
            text-align: right;
        }

        [dir="rtl"] .course-card h3,
        [dir="rtl"] .course-card p,
        [dir="rtl"] .course-card span {
            text-align: right;
        }

        [dir="rtl"] .mr-1 {
            margin-right: 0 !important;
            margin-left: 0.25rem !important;
        }

        [dir="rtl"] .ml-1 {
            margin-left: 0 !important;
            margin-right: 0.25rem !important;
        }

        [dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }

        [dir="rtl"] .ml-2 {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }

        [dir="rtl"] .mr-4 {
            margin-right: 0 !important;
            margin-left: 1rem !important;
        }

        [dir="rtl"] .ml-4 {
            margin-left: 0 !important;
            margin-right: 1rem !important;
        }

        [dir="rtl"] .space-x-2>*+* {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }

        [dir="rtl"] .space-x-4>*+* {
            margin-left: 0 !important;
            margin-right: 1rem !important;
        }

        [dir="rtl"] .text-left {
            text-align: right !important;
        }

        [dir="rtl"] .text-right {
            text-align: right !important;
        }

        [dir="rtl"] .text-center {
            text-align: right !important;
        }

        /* Force RTL alignment for sidebar and filters in Arabic */
        [dir="rtl"] .bg-white.p-5,
        [dir="rtl"] .bg-white.p-5 * {
            text-align: right !important;
        }

        [dir="rtl"] label,
        [dir="rtl"] h3,
        [dir="rtl"] span:not(.fi) {
            text-align: right !important;
        }

        [dir="rtl"] .flex-row {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .justify-start {
            justify-content: flex-end;
        }

        [dir="rtl"] .justify-end {
            justify-content: flex-start;
        }

        [dir="rtl"] .justify-between {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .left-2 {
            left: auto !important;
            right: 0.5rem !important;
        }

        [dir="rtl"] .right-2 {
            right: auto !important;
            left: 0.5rem !important;
        }

        [dir="rtl"] .pr-1 {
            padding-right: 0 !important;
            padding-left: 0.25rem !important;
        }

        /* Professional Course Cards */
        .course-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .course-card:hover {
            transform: translateY(-8px);
        }

        /* Smooth Image Zoom */
        .course-card img {
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Badge Animation */
        .course-card .badge {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #79131d 0%, #5a0f16 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Course Cards Grid Spacing - Better Visual Separation */
        .courses-grid {
            row-gap: 3rem;
            column-gap: 2.5rem;
        }

        @media (min-width: 640px) {
            .courses-grid {
                row-gap: 3.5rem;
                column-gap: 3rem;
            }
        }

        @media (min-width: 1024px) {
            .courses-grid {
                row-gap: 4rem;
                column-gap: 3.5rem;
            }
        }

        /* Make entire card clickable */
        .course-card {
            text-decoration: none;
            color: inherit;
        }

        .course-card:hover {
            text-decoration: none;
        }

        .course-card * {
            pointer-events: none;
        }

        .course-card .pointer-events-none {
            pointer-events: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col" x-data="courseFilter()" x-cloak>
    <div class="flex-grow">
        <x-navbar />

        <div class="mt-10">.</div>
        <div class="mt-10">.</div>

        <section class="py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-center' }} mb-12">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-[#79131d]/10 text-[#79131d] rounded-full text-sm font-semibold">
                        {{ __('messages.featured') }}
                    </span>
                </div>
                <h2
                    class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 bg-gradient-to-r from-[#79131d] to-[#5a0f16] bg-clip-text text-transparent">
                    {{ __('messages.featured') }}
                </h2>
                <p
                    class="text-lg text-gray-600 max-w-2xl {{ app()->getLocale() === 'ar' ? 'mr-0 ml-auto text-right' : 'mx-auto text-center' }} leading-relaxed mb-8">
                    {{ __('messages.boost') }}
                </p>
            </div>

            <!-- Main Content: Filters (Left) + Courses (Right) -->
            <div class="flex flex-col {{ app()->getLocale() === 'ar' ? 'lg:flex-row-reverse' : 'lg:flex-row' }} gap-8">
                <!-- Filters Sidebar -->
                <div class="w-full lg:w-64 flex-shrink-0 {{ app()->getLocale() === 'ar' ? 'order-2' : 'order-1' }}">
                    <div class="bg-white p-5 rounded-lg shadow sticky top-6">
                        <!-- Search -->
                        <div class="mb-6">
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ __('messages.search_courses') ?? (app()->getLocale() === 'ar' ? 'ابحث عن الدورات' : 'Search Courses') }}</label>
                            <input type="text" x-model="search" placeholder="{{ __('messages.course_name') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-transparent {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                                dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                        </div>

                        <!-- Level -->
                        <div class="mb-6">
                            <h3
                                class="text-gray-600 text-sm font-medium mb-3 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.level') }}</h3>
                            <div
                                class="flex flex-wrap gap-2 {{ app()->getLocale() === 'ar' ? 'justify-end' : 'justify-start' }}">
                                <button @click="level = level === 'Beginner' ? '' : 'Beginner'"
                                    :class="{
                                        'bg-blue-600 text-white border-blue-600': level === 'Beginner',
                                        'border border-blue-300 text-blue-600 hover:bg-blue-50': level !== 'Beginner'
                                    }"
                                    class="px-3 py-1.5 text-sm rounded-md transition-colors">
                                    {{ __('messages.Beginner') }}
                                </button>
                                <button @click="level = level === 'Mid' ? '' : 'Mid'"
                                    :class="{
                                        'bg-blue-600 text-white border-blue-600': level === 'Mid',
                                        'border border-blue-300 text-blue-600 hover:bg-blue-50': level !== 'Mid'
                                    }"
                                    class="px-3 py-1.5 text-sm rounded-md transition-colors">
                                    {{ __('messages.mid') }}
                                </button>
                                <button @click="level = level === 'Advanced' ? '' : 'Advanced'"
                                    :class="{
                                        'bg-blue-600 text-white border-blue-600': level === 'Advanced',
                                        'border border-blue-300 text-blue-600 hover:bg-blue-50': level !== 'Advanced'
                                    }"
                                    class="px-3 py-1.5 text-sm rounded-md transition-colors">
                                    {{ __('messages.advanced') }}
                                </button>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <h3
                                class="text-gray-600 text-sm font-medium mb-3 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.categories') }}</h3>
                            <div
                                class="space-y-2 max-h-60 overflow-y-auto {{ app()->getLocale() === 'ar' ? 'pr-1' : 'pl-1' }}">
                                @foreach ($categories as $item)
                                    <label
                                        class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse justify-end' : 'justify-start' }} cursor-pointer hover:bg-gray-50 p-2 rounded-md transition-colors">
                                        <input type="checkbox" x-model="selectedCategories"
                                            :value="'{{ $item->name }}'"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}">
                                        <span
                                            class="text-gray-700 text-sm {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ $item->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.price_label') ?? (__('messages.price') ?? (app()->getLocale() === 'ar' ? 'السعر:' : 'Price:')) }}
                                <span x-text="minPrice"></span> – <span x-text="maxPrice"></span> <img
                                    src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="inline-block"
                                    style="width: 1em; height: 1em; vertical-align: middle;">
                            </label>
                            <div class="flex items-center gap-2 mb-1">
                                <input type="range" min="0" :max="globalMaxPrice" x-model="minPrice"
                                    @input="if (minPrice > maxPrice) maxPrice = minPrice"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                <input type="range" min="0" :max="globalMaxPrice" x-model="maxPrice"
                                    @input="if (maxPrice < minPrice) minPrice = maxPrice"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            </div>
                            <div
                                class="flex justify-between text-xs text-gray-500 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-right' : 'text-left' }}">
                                <span>0 <img
                                        src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                        alt="SAR" class="inline-block"
                                        style="width: 1em; height: 1em; vertical-align: middle;"></span>
                                <span x-text="globalMaxPrice"></span> <img
                                    src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="inline-block"
                                    style="width: 1em; height: 1em; vertical-align: middle;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="flex-1 {{ app()->getLocale() === 'ar' ? 'order-1' : 'order-2' }}">
                    <div>
                        <!-- Loading Skeleton -->
                        <template x-if="isLoading">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <template x-for="i in 6" :key="i">
                                    <div class="animate-pulse bg-white rounded-lg shadow-md h-96 p-6">
                                        <div class="h-40 bg-gray-300 rounded mb-4"></div>
                                        <div class="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
                                        <div class="h-4 bg-gray-300 rounded w-1/2 mb-2"></div>
                                        <div class="h-4 bg-gray-300 rounded w-1/4"></div>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <!-- Filtered Courses -->
                        <div class="courses-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10"
                            x-show="!isLoading">
                            <template x-for="(course, index) in filteredCourses" :key="course.id">
                                <a :href="window.authId === course.user_id ?
                                    '{{ route('myCourse', ['slug' => '___SLUG___']) }}'.replace(
                                        '___SLUG___', course.slug) :
                                    course.url"
                                    class="course-card group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col border border-gray-100 hover:border-[#79131d]/20 transform hover:-translate-y-2 block cursor-pointer"
                                    :class="index > 0 && index % 3 !== 0 ? 'mt-0' : ''">
                                    <!-- Image Section with Overlay -->
                                    <div
                                        class="relative h-56 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300">
                                        <img :src="course.cover_photo_url"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                            :alt="course.title">
                                        <!-- Gradient Overlay -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        </div>

                                        <!-- Badges -->
                                        <div
                                            class="absolute top-3 {{ app()->getLocale() === 'ar' ? 'right-3' : 'left-3' }} flex flex-col gap-2">
                                            <span
                                                class="badge px-3 py-1 text-xs font-bold text-white bg-[#79131d] rounded-full shadow-lg backdrop-blur-sm"
                                                x-text="course.category_name">
                                            </span>
                                            <span
                                                class="badge px-3 py-1 text-xs font-semibold text-white bg-gradient-to-r from-[#e4ce96] to-[#d4be86] text-[#79131d] rounded-full shadow-lg"
                                                x-text="course.level">
                                            </span>
                                        </div>

                                        <!-- Date Badge -->
                                        <div
                                            class="absolute bottom-3 {{ app()->getLocale() === 'ar' ? 'right-3' : 'left-3' }} bg-white/95 backdrop-blur-sm text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-lg shadow-md">
                                            <i
                                                class="far fa-calendar-alt {{ app()->getLocale() === 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                            <span x-text="course.start_date_formatted"></span>
                                        </div>
                                    </div>

                                    <!-- Content Section -->
                                    <div
                                        class="p-6 flex-1 flex flex-col {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                        <!-- Title -->
                                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-[#79131d] transition-colors {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                                            x-text="course.title"></h3>

                                        <!-- Description -->
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                                            x-text="course.description_short"></p>

                                        <!-- Course Info Icons -->
                                        <div class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-600">
                                            <!-- Duration -->
                                            <div
                                                class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} gap-1.5">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-[#79131d]/10 flex items-center justify-center">
                                                    <i class="far fa-clock text-[#79131d] text-xs"></i>
                                                </div>
                                                <span class="font-medium"
                                                    x-text="course.duration + ' {{ __('messages.hours') ?? (app()->getLocale() === 'ar' ? 'ساعة' : 'hours') }}'"></span>
                                            </div>

                                            <!-- Rating -->
                                            <div
                                                class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} gap-1.5">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                                                    <i class="fas fa-star text-yellow-500 text-xs"></i>
                                                </div>
                                                <span class="font-medium"
                                                    x-text="course.rating + ' (' + course.reviews_count + ')'"></span>
                                            </div>
                                        </div>

                                        <!-- Instructor -->
                                        <div
                                            class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} gap-2 mb-4 pb-4 border-b border-gray-200">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gradient-to-br from-[#79131d] to-[#5a0f16] flex items-center justify-center text-white font-bold text-sm">
                                                <span x-text="course.instructor.charAt(0)"></span>
                                            </div>
                                            <div
                                                class="flex-1 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                                <p class="text-xs text-gray-500 mb-0.5">
                                                    {{ __('messages.instructor') ?? (app()->getLocale() === 'ar' ? 'المعلم' : 'Instructor') }}
                                                </p>
                                                <p class="text-sm font-semibold text-gray-800"
                                                    x-text="course.instructor"></p>
                                            </div>
                                        </div>

                                        <!-- Price and Button -->
                                        <div
                                            class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} justify-between gap-3 mt-auto">
                                            <div
                                                class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} gap-1.5">
                                                <span class="text-2xl font-bold text-[#79131d]"
                                                    x-text="course.price"></span>
                                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                                    alt="SAR" class="inline-block"
                                                    style="width: 1.2em; height: 1.2em; vertical-align: middle;">
                                            </div>
                                            <div
                                                class="flex-1 px-5 py-2.5 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white text-sm font-semibold rounded-xl hover:from-[#5a0f16] hover:to-[#79131d] transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 text-center pointer-events-none">
                                                <span
                                                    x-text="window.authId === course.user_id ? '{{ __('messages.my_course') }}' : '{{ __('messages.subscribe_now') }}'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </template>

                            <template x-if="filteredCourses.length === 0 && !isLoading">
                                <div class="col-span-full text-center py-12 text-gray-500">
                                    {{ __('messages.no_courses_match') }}
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    <x-footer />

    <script>
        function courseFilter() {
            return {
                // Filters
                search: '',
                level: '',
                selectedCategories: [],
                minPrice: 0,
                maxPrice: 500,

                // Data
                courses: {!! json_encode($coursesForJs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},

                globalMaxPrice: 500,
                isLoading: false,

                init() {
                    if (this.courses.length > 0) {
                        this.globalMaxPrice = Math.max(...this.courses.map(c => c.price));
                        this.maxPrice = this.globalMaxPrice;
                    }

                    this.$watch('search', () => this.debouncedFilter());
                    this.$watch('level', () => this.debouncedFilter());
                    this.$watch('selectedCategories', () => this.debouncedFilter());
                    this.$watch('minPrice', () => this.debouncedFilter());
                    this.$watch('maxPrice', () => this.debouncedFilter());
                },

                debouncedFilter() {
                    clearTimeout(this.filterTimeout);
                    this.isLoading = true;
                    this.filterTimeout = setTimeout(() => {
                        this.isLoading = false;
                    }, 300);
                },

                get filteredCourses() {
                    return this.courses.filter(course => {
                        if (this.search && !course.title.toLowerCase().includes(this.search.toLowerCase())) {
                            return false;
                        }
                        if (this.level && course.level !== this.level) {
                            return false;
                        }
                        if (this.selectedCategories.length > 0 && !this.selectedCategories.includes(course
                                .category_name)) {
                            return false;
                        }
                        if (course.price < this.minPrice || course.price > this.maxPrice) {
                            return false;
                        }
                        return true;
                    });
                }
            };
        }
    </script>
    <script>
        window.authId = {{ auth()->id() ?? 'null' }};
    </script>

</body>

</html>
