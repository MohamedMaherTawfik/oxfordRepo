<x-teacher-panel>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-start py-10 px-4"
        dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg p-6">

            <!-- العنوان و الزر -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-700">
                    {{ $course->title }} {{ __('teacher.course_schedules') }}
                </h1>
            </div>

            <!-- رسالة نجاح -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-center">
                            <th class="py-3 px-4 border-b">{{ __('teacher.day') }}</th>
                            <th class="py-3 px-4 border-b">{{ __('teacher.start_time') }}</th>
                            <th class="py-3 px-4 border-b">{{ __('teacher.end_time') }}</th>
                            <th class="py-3 px-4 border-b">{{ __('teacher.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $days = [
                                'saturday' => __('teacher.saturday'),
                                'sunday' => __('teacher.sunday'),
                                'monday' => __('teacher.monday'),
                                'tuesday' => __('teacher.tuesday'),
                                'wednesday' => __('teacher.wednesday'),
                                'thursday' => __('teacher.thursday'),
                            ];
                        @endphp

                        @foreach ($days as $key => $day)
                            <tr class="text-center text-gray-700 hover:bg-gray-50 transition">
                                <td class="py-4 px-4 border-b font-semibold">
                                    {{ $day }}
                                </td>
                                <td class="py-4 px-4 border-b">
                                    @foreach ($schedules->where('day', $key) as $item)
                                        <div class="flex justify-center items-center gap-3 mb-1">
                                            <span>{{ $item->start_time }}</span>
                                            <span>-</span>
                                            <span>{{ $item->end_time }}</span>

                                            <!-- زرار Show Students -->
                                            <a href="{{ route('course-schedules.students', [$course, $key, $item->start_time]) }}"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded shadow text-sm">
                                                {{ __('teacher.show_students') }}
                                            </a>

                                        </div>
                                    @endforeach
                                </td>
                                <td class="py-4 px-4 border-b"></td>
                                <!-- ممكن نسيبها فاضية أو تحذف العمود لو مش محتاج -->

                                @php
                                    $hasSchedule = $schedules->where('day', $key)->count() > 0;
                                @endphp

                                <td class="py-4 px-4 border-b flex justify-center gap-3">
                                    {{-- زرار إضافة ميعاد --}}
                                    <a href="{{ route('course-schedules.create', [$course, $key]) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded shadow">
                                        {{ __('teacher.add_time') }}
                                    </a>

                                    {{-- زرار حذف اليوم
                                    @if ($hasSchedule)
                                        <form action="{{ route('course-schedules.destroy', [$course, $key]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('{{ __('teacher.confirm_delete_day') }}')"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow">
                                                {{ __('teacher.delete_time') }}
                                            </button>
                                        </form>
                                    @endif --}}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-teacher-panel>
