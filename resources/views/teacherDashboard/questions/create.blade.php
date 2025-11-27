<x-teacher-panel>
    <div class="max-w-5xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">{{ __('teacher.create_questions') }}</h1>
        @php
            $courseSlug = request('course');
        @endphp
        <form method="POST" action="{{ route('questions.store', [$courseSlug, $quiz->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div id="questions-container" class="space-y-8">

                <div class="question-block border p-4 rounded bg-gray-50">
                    <label class="block font-semibold mb-2">{{ __('teacher.question') }}</label>
                    <input type="text" name="questions[0][text]" class="w-full border px-4 py-3 rounded text-lg mb-1">
                    @error('questions.0.text')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        @for ($i = 0; $i < 4; $i++)
                            <div>
                                <label class="block font-medium mb-1">{{ __('teacher.option') }}
                                    {{ $i + 1 }}</label>
                                <input type="text" name="questions[0][options][{{ $i }}][text]"
                                    class="w-full border px-4 py-3 rounded text-lg mb-1">
                                @error("questions.0.options.$i.text")
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror

                                <label
                                    class="block font-medium mb-1 text-sm mt-2">{{ __('teacher.is_correct') }}</label>
                                <select name="questions[0][options][{{ $i }}][is_correct]"
                                    class="border px-3 py-2 rounded w-1/3 text-sm">
                                    <option value="false" selected>{{ __('teacher.false') }}</option>
                                    <option value="true">{{ __('teacher.true') }}</option>
                                </select>
                                @error("questions.0.options.$i.is_correct")
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

            <!-- Save Button -->
            <div class="mt-8">
                <button type="submit" class="bg-[#79131DD7] text-[#e4ce96] px-6 py-2 rounded hover:bg-[#79131D]">
                    {{ __('teacher.save_questions') }}
                </button>
            </div>
        </form>
    </div>
</x-teacher-panel>
