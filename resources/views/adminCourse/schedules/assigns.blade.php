<x-panel>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-start py-10 px-4">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg p-6">

            <h1 class="text-2xl font-bold text-gray-700 mb-6">
                {{ $course->title }} - {{ request('day') }}
            </h1>

            @if ($times->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-center">
                                <th class="py-3 px-4 border-b">{{ __('teacher.student_name') }}</th>
                                <th class="py-3 px-4 border-b">{{ __('teacher.student_email') }}</th>
                                <th class="py-3 px-4 border-b">{{ __('teacher.time') }}</th>
                                <th class="py-3 px-4 border-b">{{ __('teacher.day') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($times as $item)
                                <tr class="text-center text-gray-700 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4 border-b font-semibold">
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="py-4 px-4 border-b font-semibold">
                                        {{ $item->user->email }}
                                    </td>
                                    <td class="py-4 px-4 border-b font-semibold">
                                        {{ $item->time }}
                                    </td>
                                    <td class="py-4 px-4 border-b font-semibold">
                                        {{ $item->day }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center mt-4">
                    {{ __('teacher.no_students_found') }}
                </p>
            @endif

        </div>
    </div>
</x-panel>
