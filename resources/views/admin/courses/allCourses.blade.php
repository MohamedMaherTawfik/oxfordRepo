<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('main.all_courses') }}</h1>
                <p class="text-gray-600">{{ __('main.manage_courses_description') }}</p>
            </div>
        </div>

        <!-- Stats Card -->
        <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-[#79131d] mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ __('main.total_courses') }}</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $courses->count() }}</h3>
                </div>
                <div class="bg-[#79131d]/10 rounded-full p-3">
                    <i class="fas fa-book-open text-[#79131d] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Courses Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center">
                    <i class="fas fa-list mr-3"></i>
                    {{ __('main.course_list') }}
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.image') }}</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.course') }}</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.category') }}</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.instructor') }}</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.duration') }}</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.price') }}</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($courses as $course)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Image -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                        <img src="{{ $course->cover_photo_url }}" alt="{{ $course->title }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                </td>

                                <!-- Course Info -->
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <h3 class="text-sm font-bold text-gray-900 mb-1">{{ $course->title }}</h3>
                                        <p class="text-xs text-gray-500 mb-2 line-clamp-2">
                                            {{ Str::limit($course->description, 60) }}</p>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-[#79131d]/10 text-[#79131d]">
                                                {{ __('main.levels.' . strtolower($course->level ?? 'beginner')) }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                {{ \Carbon\Carbon::parse($course->start_Date)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $course->category->name ?? __('main.general') }}
                                    </span>
                                </td>

                                <!-- Instructor -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 mr-2 overflow-hidden">
                                            <img src="{{ $course->user->photo ? asset('storage/' . $course->user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($course->user->name) . '&background=79131d&color=fff' }}"
                                                alt="{{ $course->user->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <span class="text-sm text-gray-900">{{ $course->user->name ?? 'N/A' }}</span>
                                    </div>
                                </td>

                                <!-- Duration -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center text-sm text-gray-600">
                                        <i class="far fa-clock mr-1"></i>
                                        <span>{{ $course->duration ?? 0 }} {{ __('main.hours') }}</span>
                                    </div>
                                </td>

                                <!-- Price -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                            alt="SAR" class="inline-block"
                                            style="width: 0.9em; height: 0.9em; vertical-align: middle;">
                                        <span
                                            class="text-sm font-bold text-gray-900">{{ number_format($course->price ?? 0, 2) }}</span>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.course.edit', $course) }}"
                                            class="text-yellow-600 hover:text-yellow-800 p-2 rounded-lg hover:bg-yellow-50 transition-colors"
                                            title="{{ __('main.edit_price') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.courses.show', $course->slug) }}"
                                            class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                            title="{{ __('main.view') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('{{ __('main.confirm_delete_course') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                                title="{{ __('main.delete') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500 text-lg font-medium">{{ __('main.no_courses') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-panel>
