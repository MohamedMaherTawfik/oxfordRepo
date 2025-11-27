    <?php
    use App\Models\comments;
    use Illuminate\Support\Str;
    $comments = comments::where('lesson_id', $lesson->id)->get();

    function extractYoutubeId($url)
    {
        if (Str::contains($url, 'youtube.com')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            return $params['v'] ?? null;
        }

        if (Str::contains($url, 'youtu.be')) {
            return Str::after($url, 'youtu.be/');
        }

        return null;
    }

    $videoId = extractYoutubeId($lesson->video_url);
    ?>
    <x-panel>

        <div class="max-w-4xl mx p-6 rounded-lg">
            <!-- Lesson Title -->
            <div class="mb-6 flex justify-between items-start">
                <!-- Title and Timestamp -->
                <div class="text-left">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $lesson->title }}</h1>
                </div>

                <!-- Dropdown Menu -->
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <button @click="open = !open"
                        class="bg-[#79131DC0] text-white px-4 py-2 rounded-lg shadow hover:bg-[#79131d]">
                        {{ __('teacher.options') }}
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                        <a href="{{ route('admin.lessons.edit', $lesson->slug) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100"> {{ __('teacher.edit') }}</a>
                        <form method="POST" action="{{ route('admin.lessons.delete', $lesson->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                {{ __('teacher.delete') }}
                            </button>
                        </form>

                    </div>
                </div>

            </div>


            <!-- Lesson Description -->
            <div class="mb-8 text-left">
                <p class="text-gray-700 leading-relaxed">
                    {{ $lesson->description }}
                </p>
            </div>

            <!-- Video Player -->
            <div class="mb-8 mx-4 bg-black rounded-lg overflow-hidden">
                <div class="relative w-full pb-[56.25%] mb-10">
                    @if ($videoId)
                        {{-- iframe YouTube --}}
                        <iframe class="absolute top-0 left-0 w-full h-full rounded-lg shadow-md"
                            src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @elseif(Str::contains($lesson->video_url, 'youtube.com') || Str::contains($lesson->video_url, 'youtu.be'))
                        {{-- فيديو YouTube غير قابل للتضمين --}}
                        <div
                            class="absolute top-0 left-0 w-full h-full rounded-lg shadow-md flex items-center justify-center bg-gray-100 border border-gray-300 text-gray-600">
                            <a href="{{ $lesson->video_url }}" target="_blank"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">
                                مشاهدة الفيديو خارجيًا
                            </a>
                        </div>
                    @else
                        {{-- فيديو مرفوع من لوحة التحكم --}}
                        <video controls class="absolute top-0 left-0 w-full h-full rounded-lg shadow-md">
                            <source src="{{ asset('storage/' . $lesson->video_url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>


                <div class="p-4 bg-gray-100 flex justify-between items-center">

                    <p class="text-gray-500 text-sm">Created At:
                        {{ \Carbon\Carbon::parse($lesson->created_at)->format('Y, d F') }}
                    </p>
                </div>
            </div>

            <!-- Comment Section -->
            <div class="border-t pt-6 text-left">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Comments ({{ count($comments) }})</h3>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const video = document.getElementById('lessonVideo');

                // Handle keydown globally
                window.addEventListener('keydown', function(e) {
                    // Make sure no input/textarea is focused
                    const active = document.activeElement;
                    if (active.tagName === 'INPUT' || active.tagName === 'TEXTAREA') return;

                    if (e.key === 'ArrowRight') {
                        e.preventDefault(); // prevent horizontal scroll
                        video.currentTime = Math.min(video.duration, video.currentTime + 5);
                    } else if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        video.currentTime = Math.max(0, video.currentTime - 5);
                    }
                });

                // Allow clicking on progress bar to seek
                video.addEventListener('click', function(e) {
                    const rect = video.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const ratio = x / rect.width;
                    video.currentTime = video.duration * ratio;
                });
            });
        </script>



    </x-panel>
