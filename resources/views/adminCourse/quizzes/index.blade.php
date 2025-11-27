<x-teacher-panel>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">All Quizzes in {{ $course->title }}</h1>
        <a href="{{ route('teacherDashboard.quizzes.create', $course->slug) }}"
            class="bg-[#79131DDE] text-white px-4 py-2 mr-4 rounded mt-3 hover:bg-[#79131d]">
            {{ __('teacher.create_new_quiz') }}
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full table-auto text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left"> {{ __('teacher.title') }}</th>
                    <th class="px-4 py-2 text-left"> {{ __('teacher.duration') }} ( {{ __('teacher.minutes') }})</th>
                    <th class="px-4 py-2 text-left"> {{ __('teacher.start_at') }}</th>
                    <th class="px-4 py-2 text-left"> {{ __('teacher.end_at') }}</th>
                    <th class="px-4 py-2"> {{ __('teacher.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $quiz)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $quiz->title }}</td>
                        <td class="px-4 py-2">{{ $quiz->duration }}</td>
                        <td class="px-4 py-2">{{ $quiz->start_at }}</td>
                        <td class="px-4 py-2">{{ $quiz->end_at }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('teacherDashboard.quizzes.edit', [$course->slug, $quiz->slug]) }}"
                                class="text-yellow-600 hover:underline mr-2"> {{ __('teacher.edit') }}</a>
                            <a href="{{ route('teacherDashboard.quizzes.show', [$course->slug, $quiz->slug]) }}"
                                class="text-blue-600 hover:underline mr-2"> {{ __('teacher.view') }}</a>
                            <form method="POST"
                                action="{{ route('teacherDashboard.quizzes.destroy', [$course->slug, $quiz->id]) }}"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Are you sure you want to delete this quiz?')">
                                    {{ __('teacher.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-teacher-panel>
