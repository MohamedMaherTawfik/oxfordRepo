<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <a href="{{ route('admin.courses.all') }}"
                            class="text-[#79131d] hover:text-[#5a0f16] transition-colors">
                            <i class="fas fa-arrow-right text-xl"></i>
                        </a>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
                    </div>
                    <p class="text-gray-600 text-lg">{{ Str::limit($course->description, 100) }}</p>
                </div>

                <!-- Options Dropdown -->
                <div x-data="{ dropdownOpen: false, modalOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center gap-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                        <i class="fas fa-cog"></i>
                        <span>{{ __('messages.option') }}</span>
                        <i class="fas fa-chevron-down text-xs" :class="{ 'rotate-180': dropdownOpen }"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                        class="absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-hidden">
                        <div class="py-2">
                            <a href="{{ route('admin.lessons.create', $course->slug) }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-plus-circle text-[#79131d]"></i>
                                <span>{{ __('messages.add_lesson') }}</span>
                            </a>
                            <a href="{{ route('admin.courses.edit', $course->slug) }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-edit text-blue-600"></i>
                                <span>{{ __('messages.edit_lesson') }}</span>
                            </a>
                            <a href="{{ route('admin.project.all', $course->slug) }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-project-diagram text-purple-600"></i>
                                <span>{{ __('teacher.graduation_project') }}</span>
                            </a>
                            <a href="{{ route('admin.zoom.index', $course) }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-video text-green-600"></i>
                                <span>{{ __('teacher.meetings') }}</span>
                            </a>
                            <a href="{{ route('admin.certificates.index', $course->slug) }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-certificate text-yellow-600"></i>
                                <span>{{ __('teacher.certificate') }}</span>
                            </a>
                            <a href="{{ route('admin.course-schedules.index', $course) }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-calendar-alt text-indigo-600"></i>
                                <span>{{ __('teacher.add_schedule') }}</span>
                            </a>
                            <button @click="modalOpen = true; dropdownOpen = false"
                                class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors text-right">
                                <i class="fas fa-bell text-orange-600"></i>
                                <span>{{ __('teacher.send_notification') }}</span>
                            </button>
                            <div class="border-t border-gray-200 my-1"></div>
                            <form method="POST" action="{{ route('admin.courses.delete', $course->id) }}"
                                onsubmit="return confirm('{{ __('main.confirm_delete') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-colors text-right">
                                    <i class="fas fa-trash"></i>
                                    <span>{{ __('messages.delete_lesson') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Notification Modal -->
                    <div x-show="modalOpen" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50"
                        @click.away="modalOpen = false">
                        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md transform transition-all">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-bell text-[#79131d]"></i>
                                    {{ __('teacher.send_notification') }}
                                </h2>
                                <button @click="modalOpen = false"
                                    class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>

                            <form method="POST" action="{{ route('admin.courses.notify', $course) }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                        {{ __('teacher.title') }}
                                    </label>
                                    <input type="text" name="title" id="title"
                                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all"
                                        required>
                                </div>

                                <div class="mb-6">
                                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                        {{ __('teacher.message') }}
                                    </label>
                                    <textarea name="message" id="message" rows="4"
                                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all"
                                        required></textarea>
                                </div>

                                <div class="flex justify-end gap-3">
                                    <button type="button" @click="modalOpen = false"
                                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                                        {{ __('teacher.cancel') }}
                                    </button>
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white rounded-lg hover:shadow-lg transition-all font-medium">
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        {{ __('teacher.send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Info Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border-l-4 border-[#79131d]">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 rounded-lg p-3">
                            <i class="fas fa-user-tie text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">{{ __('main.instructor') }}</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $course->user->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-green-100 rounded-lg p-3">
                            <i class="fas fa-tag text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">{{ __('main.category') }}</p>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $course->category->name ?? __('main.general') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-purple-100 rounded-lg p-3">
                            <i class="fas fa-signal text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">{{ __('main.level') }}</p>
                            <p class="text-sm font-semibold text-gray-900">{{ ucfirst($course->level ?? 'Beginner') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-100 rounded-lg p-3">
                            <i class="far fa-calendar-alt text-orange-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">{{ __('main.start_date') }}</p>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($course->start_Date)->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Revenue -->
            <div
                class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-dollar-sign text-2xl"></i>
                    </div>
                </div>
                <p class="text-blue-100 text-sm font-medium mb-2">{{ __('teacher.total_revenue') }}</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol" style="display: inline-block;">
                    <h3 class="text-3xl font-bold">{{ number_format($price, 2) }}</h3>
                </div>
            </div>

            <!-- Enrollments -->
            <div
                class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
                <p class="text-green-100 text-sm font-medium mb-2">{{ __('teacher.enrollments') }}</p>
                <h3 class="text-3xl font-bold">{{ $enrollments }}</h3>
            </div>

            <!-- Total Lessons -->
            <div
                class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-book-open text-2xl"></i>
                    </div>
                </div>
                <p class="text-purple-100 text-sm font-medium mb-2">{{ __('main.add_lesson') }}</p>
                <h3 class="text-3xl font-bold">{{ $course->lessons->count() }}</h3>
            </div>

            <!-- Course Price -->
            <div
                class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-tag text-2xl"></i>
                    </div>
                </div>
                <p class="text-orange-100 text-sm font-medium mb-2">{{ __('main.price') }}</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol" style="display: inline-block;">
                    <h3 class="text-3xl font-bold">{{ number_format($course->price ?? 0, 2) }}</h3>
                </div>
            </div>
        </div>

        <!-- Lessons Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <i class="fas fa-book-open"></i>
                        {{ __('main.add_lesson') }} ({{ $course->lessons->count() }})
                    </h2>
                    <a href="{{ route('admin.lessons.create', $course->slug) }}"
                        class="flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-plus"></i>
                        <span>{{ __('messages.add_lesson') }}</span>
                    </a>
                </div>
            </div>

            @if ($course->lessons->count() > 0)
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($course->lessons as $lesson)
                            <div
                                class="group bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="relative h-48 overflow-hidden bg-gray-200">
                                    @if ($lesson->image && file_exists(public_path('storage/' . $lesson->image)))
                                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                            src="{{ asset('storage/' . $lesson->image) }}"
                                            alt="{{ $lesson->title }}">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                            <i class="fas fa-video text-4xl text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="absolute top-2 right-2">
                                        <span
                                            class="px-2 py-1 bg-black/50 text-white text-xs rounded-lg backdrop-blur-sm">
                                            #{{ $loop->iteration }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                        {{ $lesson->title }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                        {{ $lesson->description }}
                                    </p>
                                    <a href="{{ route('admin.lessons.show', $lesson->slug) }}"
                                        class="block w-full text-center px-4 py-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white rounded-lg hover:shadow-lg transition-all font-medium">
                                        <i class="fas fa-eye mr-2"></i>
                                        {{ __('teacher.view_lesson') }}
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
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ __('main.add_lesson') }}</h3>
                    <p class="text-gray-500 mb-6">{{ __('main.add_lesson') }}</p>
                    <a href="{{ route('admin.lessons.create', $course->slug) }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all font-medium">
                        <i class="fas fa-plus"></i>
                        <span>{{ __('messages.add_lesson') }}</span>
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

        [x-cloak] {
            display: none !important;
        }
    </style>
</x-panel>
