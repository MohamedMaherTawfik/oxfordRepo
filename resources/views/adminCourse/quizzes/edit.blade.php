<x-teacher-panel>
    <div class="flex justify-center items-center min-h-[70vh] mt-10">
        <div class="w-full max-w-xl bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6 text-center"> {{ __('teacher.edit_quiz') }}{{ $quiz->title }}</h1>
            <form method="POST" action="{{ route('teacherDashboard.quizzes.update', [$course->slug, $quiz->slug]) }}"
                class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold mb-1"> {{ __('teacher.title') }}</label>
                    <input name="title" type="text" value="{{ $quiz->title }}"
                        class="w-full border px-4 py-2 rounded">
                    @error('title')
                        <span class="text-red text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-semibold mb-1"> {{ __('teacher.description') }}</label>
                    <textarea name="description" class="w-full border px-4 py-2 rounded">{{ $quiz->description }}</textarea>
                    @error('description')
                        <span class="text-red text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-semibold mb-1"> {{ __('teacher.duration') }} (
                        {{ __('teacher.') }})</label>
                    <input name="duration" type="number" value="{{ $quiz->duration }}"
                        class="w-full border px-4 py-2 rounded">
                    @error('duration')
                        <span class="text-red text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-semibold mb-1"> {{ __('teacher.start_at') }}</label>
                    <input name="start_at" type="datetime-local"
                        value="{{ \Carbon\Carbon::parse($quiz->start_at)->format('Y-m-d\TH:i') }}"
                        class="w-full border px-4 py-2 rounded">
                    @error('strat_at')
                        <span class="text-red text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block font-semibold mb-1"> {{ __('teacher.end_at') }}</label>
                    <input name="end_at" type="datetime-local"
                        value="{{ \Carbon\Carbon::parse($quiz->end_at)->format('Y-m-d\TH:i') }}"
                        class="w-full border px-4 py-2 rounded">
                    @error('end_at')
                        <span class="text-red text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-[#79131DD5] text-white px-6 py-2 rounded hover:bg-[#79131d]">
                        {{ __('teacher.update_quiz') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-teacher-panel>
