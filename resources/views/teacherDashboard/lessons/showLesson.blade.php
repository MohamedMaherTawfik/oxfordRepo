<x-teacher-panel>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $lesson->title }}</h1>

            <!-- Description -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">{{ __('teacher.description') }}</h2>
                <p class="text-gray-600 leading-relaxed">{{ $lesson->description ?? __('teacher.no_description') }}</p>
            </div>

            <!-- Video -->
            @if ($lesson->video_url)
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">{{ __('teacher.video') }}</h2>
                    <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm relative">
                        <video id="lessonVideo" class="w-full" playsinline
                            poster="{{ $lesson->image ? asset('storage/' . $lesson->image) : '' }}">
                            <source src="{{ asset('storage/' . $lesson->video_url) }}" type="video/mp4">
                            {{ __('teacher.video_not_supported') }}
                        </video>
                    </div>

                    <!-- أزرار +5 / -5 -->
                    <div class="flex justify-center gap-4 mt-4">
                        <button id="backwardBtn"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg transition">
                            {{ __('teacher.backward') }}
                        </button>
                        <button id="forwardBtn"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg transition">
                            {{ __('teacher.forward') }}
                        </button>
                    </div>
                </div>
            @else
                <div class="text-gray-500 italic">{{ __('teacher.no_video') }}</div>
            @endif
        </div>
    </div>

    <!-- مكتبة Plyr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.css" />
    <script src="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.polyfilled.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // تهيئة Plyr
            const player = new Plyr('#lessonVideo', {
                controls: [
                    'play-large', 'play', 'progress', 'current-time', 'mute',
                    'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'
                ],
                clickToPlay: true,
                keyboard: {
                    focused: true,
                    global: true
                },
                seekTime: 5
            });

            // أزرار +5 / -5
            const forwardBtn = document.getElementById('forwardBtn');
            const backwardBtn = document.getElementById('backwardBtn');

            forwardBtn.addEventListener('click', () => {
                player.currentTime += 5;
            });

            backwardBtn.addEventListener('click', () => {
                player.currentTime = Math.max(player.currentTime - 5, 0);
            });
        });
    </script>
</x-teacher-panel>
