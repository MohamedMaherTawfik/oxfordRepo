<x-teacher-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen" 
         dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                        <i class="fas fa-book-open text-[#79131d]"></i>
                        {{ __('teacher.all_courses') ?? 'جميع الدورات' }}
                    </h1>
                    <p class="text-gray-600">{{ __('teacher.manage_your_courses') ?? 'إدارة جميع دوراتك في مكان واحد' }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        {{ __('teacher.showing_your_courses_only') ?? 'عرض دوراتك فقط' }} 
                        <span class="font-semibold">({{ $courses->total() }} {{ __('teacher.courses') ?? 'دورة' }})</span>
                    </p>
                </div>
                <a href="{{ route('teacher.courses.create') }}"
                    class="flex items-center gap-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-xl hover:shadow-xl transition-all duration-200 transform hover:scale-105 font-semibold">
                    <i class="fas fa-plus"></i>
                    <span>{{ __('teacher.add_new_course') }}</span>
                </a>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white rounded-xl shadow-md p-4 mb-6" x-data="{ search: '', showFilters: false }">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="flex-1 relative">
                        <input type="text" 
                               x-model="search"
                               placeholder="{{ __('teacher.search_courses') ?? 'ابحث عن دورة...' }}"
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <!-- Filter Button -->
                    <button @click="showFilters = !showFilters"
                            class="px-6 py-3 border-2 border-gray-200 rounded-lg hover:bg-gray-50 transition-all flex items-center gap-2">
                        <i class="fas fa-filter text-gray-600"></i>
                        <span class="text-gray-700 font-medium">{{ __('teacher.filters') ?? 'فلتر' }}</span>
                    </button>
                </div>

                <!-- Filters Panel -->
                <div x-show="showFilters" 
                     x-transition
                     class="mt-4 pt-4 border-t border-gray-200 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('teacher.category') ?? 'الفئة' }}</label>
                        <select class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-[#79131d]">
                            <option value="">{{ __('teacher.all_categories') ?? 'جميع الفئات' }}</option>
                            @foreach(\App\Models\categories::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('teacher.sort_by') ?? 'ترتيب حسب' }}</label>
                        <select class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-[#79131d]">
                            <option value="newest">{{ __('teacher.newest') ?? 'الأحدث' }}</option>
                            <option value="oldest">{{ __('teacher.oldest') ?? 'الأقدم' }}</option>
                            <option value="enrollments">{{ __('teacher.most_enrollments') ?? 'الأكثر تسجيلاً' }}</option>
                            <option value="title">{{ __('teacher.title') ?? 'العنوان' }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('teacher.status') ?? 'الحالة' }}</label>
                        <select class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-[#79131d]">
                            <option value="">{{ __('teacher.all') ?? 'الكل' }}</option>
                            <option value="active">{{ __('teacher.active') ?? 'نشط' }}</option>
                            <option value="inactive">{{ __('teacher.inactive') ?? 'غير نشط' }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="courses-grid">
                @foreach($courses as $course)
                    <div class="group bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Course Image -->
                        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                            @if($course->cover_photo && file_exists(public_path('storage/' . $course->cover_photo)))
                                <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    src="{{ asset('storage/' . $course->cover_photo) }}"
                                    alt="{{ $course->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-book text-6xl text-gray-400"></i>
                                </div>
                            @endif
                            
                            <!-- Badges -->
                            <div class="absolute top-3 right-3 flex flex-col gap-2">
                                <span class="px-3 py-1 bg-black/70 text-white text-xs rounded-lg backdrop-blur-sm flex items-center gap-1">
                                    <i class="fas fa-users"></i>
                                    <span>{{ $course->enrollments->count() }}</span>
                                </span>
                                <span class="px-3 py-1 bg-[#79131d]/90 text-white text-xs rounded-lg backdrop-blur-sm flex items-center gap-1">
                                    <i class="fas fa-video"></i>
                                    <span>{{ $course->lessons->count() }}</span>
                                </span>
                            </div>
                        </div>

                        <!-- Course Info -->
                        <div class="p-5">
                            <!-- Category -->
                            <div class="mb-3">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-lg">
                                    {{ $course->category->name ?? __('main.general') }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $course->title }}</h3>
                            
                            <!-- Description -->
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ Str::limit($course->description, 100) }}</p>

                            <!-- Stats -->
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-video text-[#79131d]"></i>
                                        <span>{{ $course->lessons->count() }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-users text-green-600"></i>
                                        <span>{{ $course->enrollments->count() }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1 text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <span class="font-semibold">{{ $course->rating ?? 0 }}</span>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <div class="flex items-center gap-2">
                                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                        alt="SAR" class="w-5 h-5">
                                    <span class="text-xl font-bold text-[#79131d]">{{ $course->price ?? 0 }}</span>
                                    <span class="text-sm text-gray-500">{{ __('teacher.riyal') }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('teacher.courses.show', $course->slug) }}"
                                    class="flex-1 text-center px-4 py-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white rounded-lg hover:shadow-lg transition-all font-medium">
                                    <i class="fas fa-eye mr-2"></i>
                                    {{ __('teacher.view') ?? 'عرض' }}
                                </a>
                                <a href="{{ route('teacher.courses.edit', $course->slug) }}"
                                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="inline-block p-6 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-book-open text-6xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">{{ __('teacher.no_courses_yet') ?? 'لا توجد دورات بعد' }}</h3>
                <p class="text-gray-500 mb-6">{{ __('teacher.start_creating_courses') ?? 'ابدأ بإنشاء دورتك الأولى الآن' }}</p>
                <a href="{{ route('teacher.courses.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-8 py-4 rounded-xl hover:shadow-xl transition-all duration-200 transform hover:scale-105 font-semibold text-lg">
                    <i class="fas fa-plus"></i>
                    <span>{{ __('teacher.add_new_course') }}</span>
                </a>
            </div>
        @endif
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Simple search functionality
        document.addEventListener('alpine:init', () => {
            Alpine.data('courseSearch', () => ({
                search: '',
                get filteredCourses() {
                    if (!this.search) return this.courses;
                    const searchLower = this.search.toLowerCase();
                    return this.courses.filter(course => 
                        course.title.toLowerCase().includes(searchLower) ||
                        (course.description && course.description.toLowerCase().includes(searchLower))
                    );
                }
            }));
        });
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-teacher-panel>
