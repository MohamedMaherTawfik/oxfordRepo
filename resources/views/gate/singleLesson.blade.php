<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ $lesson->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    @php
        use Illuminate\Support\Str;

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
    @endphp

    <!-- Navbar -->
    <x-gate-navbar />

    <div class="mt-10">.</div>
    <div class="mt-10">.</div>

    <!-- Main Container -->
    <div class="max-w-5xl mx-auto px-4 py-10">

        @if ($videoId)
            <!-- Hidden iframe for Plyr to control -->
            <div class="absolute top-0 left-0 w-full h-full rounded-lg shadow-md">
                <div data-plyr-provider="youtube" data-plyr-embed-id="{{ $videoId }}"></div>
            </div>
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

    <!-- Footer -->
    <x-footer />

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Plyr JS -->
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = new Plyr('[data-plyr-provider="youtube"]', {
                youtube: {
                    noCookie: true,
                    rel: 0, // عدم عرض الفيديوهات المقترحة
                    modestbranding: 1, // تخفيف شعار يوتيوب
                    iv_load_policy: 3, // إخفاء التعليقات التوضيحية
                    controls: 0, // إخفاء عناصر التحكم الأصلية
                    disablekb: 1, // تعطيل اختصارات الكيبورد
                    fs: 0, // إخفاء زر fullscreen الأصلي
                    playsinline: 1,
                    origin: window.location.origin
                },
                controls: [
                    'play-large',
                    'play',
                    'progress',
                    'current-time',
                    'mute',
                    'volume',
                    'fullscreen'
                ]
            });
        });
    </script>
</body>

</html>
