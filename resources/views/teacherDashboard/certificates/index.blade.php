<x-teacher-panel>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
            class="mb-4 px-4 py-3 bg-green-100 text-green-800 border border-green-300 rounded-md shadow relative">
            {{ session('success') }}
            <button @click="show = false" class="absolute top-1 right-2 text-green-700 hover:text-green-900">
                &times;
            </button>
        </div>
    @endif

    {{-- Make new Certificate --}}
    <div class="max-w-2xl mx-auto p-6 mt-3 mb-3 rounded-lg shadow" dir="rtl">
        <h2 class="text-xl font-semibold mb-4">
            {{ __('teacher.course_certificates') }} {{ $course->title }}
        </h2>

        <div class="text-right">
            <a href="{{ route('teacherDashboard.certificates.create', ['slug' => $course->slug, 'id' => auth()->id()]) }}"
                class="inline-block px-4 py-2 bg-[#79131d] text-white rounded-md hover:bg-[#5e1017] transition">
                {{ __('teacher.create_certificates') }} {{ __('teacher.by') }} {{ auth()->user()->name }}
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">{{ __('teacher.student') }}
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">{{ __('teacher.course') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                        {{ __('teacher.enrollment_date') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">{{ __('teacher.action') }}
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach ($course->enrollments as $enrollment)
                    @if ($enrollment->user->id == $assined->whereIn('user_id', $enrollment->user->id)->pluck('user_id')->first())
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $enrollment->user->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $course->title }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $enrollment->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('teacherDashboard.certificates.download', ['slug' => $course->slug, 'user_id' => $enrollment->user->id]) }}"
                                    class="inline-block px-3 py-1 text-white text-sm rounded bg-[#79131d] hover:bg-[#5e1017] transition">
                                    {{ __('teacher.download_certificate') }}
                                </a>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $enrollment->user->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $course->title }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $enrollment->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('teacherDashboard.certificates.assign', ['slug' => $course->slug, 'user_id' => $enrollment->user->id]) }}"
                                    class="inline-block px-3 py-1 text-white text-sm rounded bg-[#79131d] hover:bg-[#5e1017] transition">
                                    {{ __('teacher.assign_certificate') }}
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

</x-teacher-panel>
