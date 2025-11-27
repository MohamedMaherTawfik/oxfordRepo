<x-teacher-panel>

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">{{ __('teacher.add_schedule') }}</h2>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('course-schedules.store', $course) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="day"
                        class="block mb-2 text-sm font-medium text-gray-700">{{ __('teacher.day') }}</label>
                    <input type="text" id="day" name="day" value="{{ $day }}" readonly
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="start_time"
                        class="block mb-2 text-sm font-medium text-gray-700">{{ __('teacher.start_time') }}</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="end_time"
                        class="block mb-2 text-sm font-medium text-gray-700">{{ __('teacher.end_time') }}</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">
                        {{ __('teacher.save_schedule') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-teacher-panel>
