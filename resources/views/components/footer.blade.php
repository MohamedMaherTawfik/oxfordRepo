<?php
use App\Models\footer;
$footer = footer::first();

// إرجاع قيم افتراضية إذا لم تكن هناك بيانات
if (!$footer) {
    $footer = (object) [
        'phone' => '#',
        'facebook' => '#',
        'instgram' => '#',
        'whatsapp' => '#',
        'telegram' => '#',
        'google_play' => '#',
        'app_store' => '#',
    ];
}
?>
<style>
    :root {
        --primary-maroon: #800000;
        --primary-gold: #FFD700;
        --secondary-maroon: #a52a2a;
        --light-gold: #f9e79f;
        --dark-maroon: #600000;
    }

    body {
        font-family: 'Cairo', sans-serif;
        scroll-behavior: smooth;
    }

    .header-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(121, 19, 29, 0.7);
        z-index: 1;
    }

    .content {
        position: relative;
        z-index: 2;
    }

    .plyr {
        height: 100vh;
        min-height: 500px;
    }

    /* تأثيرات مخصصة */
    .gradient-bg {
        background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--dark-maroon) 100%);
    }

    .gold-gradient {
        background: linear-gradient(135deg, var(--primary-gold) 0%, var(--light-gold) 100%);
    }

    .text-gradient {
        background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .floating {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .stats-counter {
        font-variant-numeric: tabular-nums;
    }

    .testimonial-card {
        position: relative;
        overflow: hidden;
    }

    .testimonial-card::before {
        content: "";
        position: absolute;
        top: -20px;
        right: 10px;
        font-size: 120px;
        color: var(--primary-gold);
        opacity: 0.1;
        font-family: Arial, sans-serif;
    }

    .course-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .course-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .pagination-btn {
        transition: all 0.2s ease;
    }

    .pagination-btn:hover:not([disabled]) {
        background-color: var(--primary-maroon);
        color: white;
    }

    .nav-shadow {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* شريط التقدم أثناء التمرير */
    .progress-container {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 4px;
        background: transparent;
        z-index: 1000;
    }

    .progress-bar {
        height: 4px;
        background: var(--primary-gold);
        width: 0%;
    }

    /* تأثيرات دخول العناصر */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<footer class="gradient-bg py-10 px-4 text-[#e4ce96]" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Quick Links -->
        <div>
            <h4 class="font-bold border-b-2 border-[#e4ce96] inline-block mb-4">{{ __('messages.quick links') }}</h4>
            <ul class="space-y-2 text-gray-100">
                <li><a href="{{ route('home') }}" class="hover:text-[#e4ce96]">{{ __('messages.home') }}</a></li>
                <li><a href="{{ route('courses.all') }}" class="hover:text-[#e4ce96]">{{ __('messages.Courses') }}</a>
                </li>
                <li><a href="#" class="hover:text-[#e4ce96]">{{ __('messages.certificates') }}</a></li>
                <li><a href="#" class="hover:text-[#e4ce96]">{{ __('messages.services') }}</a></li>
                <li><a href="#" class="hover:text-[#e4ce96]">{{ __('messages.specialists') }}</a></li>
            </ul>
        </div>

        <!-- Support & Contact -->
        <div>
            <h4 class="font-bold border-b-2 border-[#e4ce96] inline-block mb-4">{{ __('messages.SupportContact') }}</h4>
            <ul class="space-y-2 text-gray-100">
                <li><a href="#" class="hover:text-[#e4ce96]">{{ __('messages.who are we') }}</a></li>
                <li><a href="{{ $footer->phone ?? '#' }}" target="_blank"
                        class="hover:text-[#e4ce96]">{{ __('messages.contact') }}</a></li>
                <li><a href="#" class="hover:text-[#e4ce96]">{{ __('messages.Copyrigth') }}</a></li>
                <li><a href="#" class="hover:text-[#e4ce96]">{{ __('messages.Terms') }}</a></li>
                <li><a href="#" class="hover:text-[#e4ce96]">{{ __('messages.privacy') }}</a></li>
                <li><a href="#" class="hover:text-[#e4ce96]">{{ __('messages.help') }}</a></li>
            </ul>
        </div>

        <!-- Social & App Info -->
        <div class="text-center md:text-left">
            <div class="mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Oxford Logo"
                    class="w-24 mx-auto md:mx-0 mb-2 rounded-full">
                <p class="font-semibold text-gray-100">{{ __('messages.Follow us') }}</p>
                <div class="flex justify-center md:justify-start gap-4 mt-2 text-[#e4ce96] text-xl">
                    @if($footer->facebook)
                        <a href="{{ $footer->facebook }}" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    @endif
                    @if($footer->instgram)
                        <a href="{{ $footer->instgram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($footer->whatsapp)
                        <a href="{{ $footer->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    @endif
                    @if($footer->telegram)
                        <a href="{{ $footer->telegram }}" target="_blank"><i class="fab fa-telegram"></i></a>
                    @endif
                </div>
            </div>

            <p class="text-sm text-gray-100 mb-2">{{ __('messages.learn anythime') }}</p>
            <div class="flex justify-center md:justify-start gap-4 mb-4">
                @if($footer->google_play)
                    <a href="{{ $footer->google_play }}" target="_blank"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/512px-Google_Play_Store_badge_EN.svg.png"
                            alt="Google Play" class="w-32"></a>
                @endif
                @if($footer->app_store)
                    <a href="{{ $footer->app_store }}" target="_blank"><img
                            src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                            alt="App Store" class="w-28"></a>
                @endif
            </div>

            <p class="text-sm text-gray-100">{{ __('messages.All rigths') }}</p>
        </div>
    </div>
</footer>
