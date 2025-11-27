<x-teacher-panel>

    <section class="bg-gray-50 py-10 px-4">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                {{ __('teacher.your_courses') }} :
                <span class="text-sm font-normal"></span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @foreach ($courses as $course)
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('storage/' . $course->cover_photo) }}" alt="{{ $course->title }}"
                            style="height:55%;" class="w-full h-auto rounded mb-4">
                        <p class="text-sm text-gray-500">{{ $course->categorey }}</p>
                        <h3 class="text-lg font-bold text-gray-800">{{ $course->title }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ Str::limit($course->description, 70) }}</p>

                        <div class="text-sm text-gray-500 mb-2">{{ count($course->lessons) }}</div>

                        <div class="flex items-center justify-between text-sm text-gray-700">
                            <div class="flex items-center gap-1">
                                <span>⭐{{ $course->rating }} </span><span>(640)</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('teacher.courses.show', $course->slug) }}"
                                class="bg-[#79131DC0] text-white px-4 py-1 rounded hover:bg-[#79131DFF]">
                                {{ __('teacher.course_detail') }}
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

</x-teacher-panel>
