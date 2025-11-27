<x-teacher-panel>

    <!-- عرض رسائل النجاح أو الفشل -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Content -->
    <div class="flex flex-col flex-1 overflow-hidden">

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ __('teacher.overview') }}</h1>
                        <p class="text-gray-600">
                            {{ __('teacher.welcome_back', ['name' => Auth::user()->name]) }}
                        </p>
                    </div>

                    <!-- Include Alpine.js -->
                    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

                    <div x-data="{ dropdownOpen: false, modalOpen: false }" class="relative inline-block text-left">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="bg-[#79131DC0] text-white px-4 py-2 rounded-lg shadow hover:bg-[#79131d]">
                            {{ __('teacher.options') }} +
                        </button>

                        <!-- Dropdown -->
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                            <a href="{{ route('teacher.lessons.create', $course->slug) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('teacher.add_lesson') }}</a>
                            <a href="{{ route('teacher.courses.edit', $course->slug) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('teacher.edit') }}</a>
                            <form method="POST" action="{{ route('teacher.courses.delete', $course->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    {{ __('teacher.delete') }}
                                </button>
                            </form>
                            <a href="{{ route('teacherDashboard.quizzes.index', $course->slug) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('teacher.make_quiz') }}</a>
                            <a href="{{ route('teacher.project.all', $course->slug) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('teacher.graduation_projects') }}</a>
                            <a href="{{ route('zoom.index', $course) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('teacher.start_live') }}</a>
                            <a href="{{ route('teacherDashboard.certificates.index', $course->slug) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('teacher.certificates') }}</a>
                            <a href="{{ route('course-schedules.index', $course) }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('teacher.academic_schedule') }}</a>

                            <!-- زرار فتح المودال -->
                            <button @click="modalOpen = true; dropdownOpen = false"
                                class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                {{ __('teacher.send_notification') }}
                            </button>
                        </div>

                        <!-- Modal -->
                        <div x-show="modalOpen"
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-cloak>
                            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                                <h2 class="text-lg font-bold mb-4">{{ __('teacher.send_notification') }}</h2>

                                <form method="POST" action="{{ route('teacher.courses.notify', $course) }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="title"
                                            class="block text-gray-700">{{ __('teacher.title') }}</label>
                                        <input type="text" name="title" id="title"
                                            class="w-full border border-gray-300 rounded px-3 py-2" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="message"
                                            class="block text-gray-700">{{ __('teacher.message') }}</label>
                                        <textarea name="message" id="message" class="w-full border border-gray-300 rounded px-3 py-2" required></textarea>
                                    </div>

                                    <div class="flex justify-end space-x-2">
                                        <button type="button" @click="modalOpen = false"
                                            class="px-4 py-2 bg-gray-300 rounded">{{ __('teacher.cancel') }}</button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-500 text-white rounded">{{ __('teacher.send') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">{{ __('teacher.total_revenue') }}</p>
                            <p class="text-2xl font-semibold text-gray-800">${{ $price }}</p>
                        </div>
                        <div class="p-3 bg-indigo-100 rounded-lg text-indigo-600">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">{{ __('teacher.enrollments') }}</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $enrollments }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg text-green-600">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- lessons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($course->lessons as $lesson)
                    <div class="max-w-sm rounded-2xl overflow-hidden shadow-lg bg-white">
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $lesson->image) }}"
                            alt="{{ __('teacher.lesson_image') }}">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ Str::limit($lesson->title, 25) }}
                            </h2>
                            <p class="text-gray-600">{{ Str::limit($lesson->description, 30) }}</p>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('teacher.lessons.show', $lesson->slug) }}"
                                class="inline-block px-4 py-2 bg-[#79131DC0] text-white rounded-lg hover:bg-[#79131DFF] transition duration-200">
                                {{ __('teacher.view_lesson') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </main>
    </div>

</x-teacher-panel>
