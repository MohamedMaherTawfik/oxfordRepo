<x-teacher-panel>
    <div class="max-w-5xl mx-auto mt-10 space-y-10">
        <!-- Quiz Info - Horizontal Table -->
        <div class="bg-white shadow rounded p-6">
            <h1 class="text-2xl font-bold mb-6">{{ $quiz->title }}</h1>
            <p class="text-gray-600 mb-4">{{ $quiz->description }}</p>

            <table class="table-auto w-full text-sm border border-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left"> {{ __('teacher.course') }}</th>
                        <th class="px-4 py-2 text-left"> {{ __('teacher.duration') }}</th>
                        <th class="px-4 py-2 text-left"> {{ __('teacher.start_at') }}</th>
                        <th class="px-4 py-2 text-left"> {{ __('teacher.end_at') }}</th>
                        <th class="px-4 py-2 text-left"> {{ __('teacher.created_by') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-gray-800">
                        <td class="px-4 py-2 border">{{ $course->title }}</td>
                        <td class="px-4 py-2 border">{{ $quiz->duration }} {{ __('teacher.duration') }}</td>
                        <td class="px-4 py-2 border">{{ $quiz->start_at }}</td>
                        <td class="px-4 py-2 border">{{ $quiz->end_at }}</td>
                        <td class="px-4 py-2 border">{{ $quiz->user->name ?? 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 text-right">
                <a href="{{ route('teacherDashboard.quizzes.edit', [$course->slug, $quiz->slug]) }}"
                    class="bg-[#79131DD5] text-white px-4 py-2 rounded hover:[#79131d]">
                    {{ __('teacher.edit_quiz') }}
                </a>
            </div>
        </div>

        <!-- Questions Table -->
        <div class="bg-white shadow rounded p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold"> {{ __('teacher.question') }}</h2>
                <a href="{{ route('questions.create', [$course->slug, $quiz->slug]) }}"
                    class="bg-[#79131DD5] text-white px-4 py-2 rounded hover:bg-[#79131d]">
                    {{ __('teacher.add_question') }}
                </a>
            </div>

            @if ($questions->count())
                <table class="w-full table-auto border border-gray-200">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border text-left"> {{ __('teacher.question') }}</th>
                            <th class="px-4 py-2 border text-center"> {{ __('teacher.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800 divide-y divide-gray-100">
                        @foreach ($questions as $index => $question)
                            <tr>
                                <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $question->question }}</td>
                                <td class="px-4 py-2 border text-center">

                                    <form
                                        action="{{ route('questions.destroy', [$course->slug, $quiz->slug, $question->slug]) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this question?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5
                     4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                            </svg>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500"> {{ __('teacher.no_questions') }}</p>
            @endif
        </div>
    </div>
</x-teacher-panel>
