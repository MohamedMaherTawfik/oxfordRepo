<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                        accent: '#10B981',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    },
                    fontFamily: {
                        'cairo': ['Cairo', 'sans-serif'],
                        'sans': ['Cairo', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'slide-in-left': 'slideInLeft 0.8s ease-out',
                        'slide-in-right': 'slideInRight 0.8s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s infinite',
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        body {
            font-size: 14px;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-size: 18px !important;
        }
    </style>
</head>

<body class="font-cairo bg-light text-dark text-[14px] min-h-screen flex flex-col">
    <div class="flex-grow">
        <x-navbar />

    <div class="mt-8"></div>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 gradient-bg text-white">
        <div class="container mx-auto px-4 text-center animate-on-scroll">
            <h1 class="font-bold mb-4">{{ __('messages.hero_title') }}</h1>
            <p class="max-w-3xl mx-auto mb-6 text-[14px]">{{ __('messages.hero_subtitle') }}</p>
            <div>
                <button
                    class="bg-white text-[#C2A14DFF] font-bold py-2 px-6 rounded-full hover:bg-gray-300 transition-all duration-300 shadow-lg transform hover:scale-110 text-[14px]">
                    {{ __('messages.learn_more') }}
                </button>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 animate-on-scroll">
                    <h2 class="font-bold mb-3">{{ __('messages.our_story_title') }}</h2>
                    <p class="text-gray-600 mb-3">{{ __('messages.our_story_p1') }}</p>
                    <p class="text-gray-600 mb-3">{{ __('messages.our_story_p2') }}</p>
                    <p class="text-gray-600">{{ __('messages.our_story_p3') }}</p>
                </div>

                <div class="md:w-1/2 flex justify-center animate-on-scroll">
                    <div class="relative w-full max-w-md">
                        <div class="bg-[#79131d] rounded-2xl p-5 text-[#e4ce96] shadow-xl transform rotate-3">
                            <h3 class="font-bold mb-2">{{ __('messages.mission_title') }}</h3>
                            <p class="mb-3">{{ __('messages.mission_text') }}</p>
                            <h3 class="font-bold mb-2">{{ __('messages.vision_title') }}</h3>
                            <p>{{ __('messages.vision_text') }}</p>
                        </div>

                        <div
                            class="absolute -bottom-5 -right-5 bg-[#79131d] rounded-2xl p-4 text-[#e4ce96] shadow-xl transform -rotate-3 w-4/5 text-[14px]">
                            <h3 class="font-bold mb-2">{{ __('messages.values_title') }}</h3>
                            <ul class="list-disc list-inside">
                                @if (app()->getLocale() === 'ar')
                                    <li>النزاهة والصدق في جميع المعاملات</li>
                                    <li>الالتزام برضا العملاء</li>
                                    <li>التعلم المستمر والابتكار</li>
                                    <li>احترام الوقت والاحترافية</li>
                                @else
                                    <li>Integrity and honesty in all dealings</li>
                                    <li>Commitment to client satisfaction</li>
                                    <li>Continuous learning and innovation</li>
                                    <li>Respect for time and professionalism</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 gradient-bg text-[#e4ce96] text-[14px]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
                <div class="animate-on-scroll">
                    <div class="text-3xl font-bold mb-1 animate-pulse-slow">200+</div>
                    <p>{{ __('messages.stats_teachers') }}</p>
                </div>
                <div class="animate-on-scroll">
                    <div class="text-3xl font-bold mb-1 animate-pulse-slow">50k+</div>
                    <p>{{ __('messages.stats_students') }}</p>
                </div>
                <div class="animate-on-scroll">
                    <div class="text-3xl font-bold mb-1 animate-pulse-slow">15</div>
                    <p>{{ __('messages.stats_countries') }}</p>
                </div>
                <div class="animate-on-scroll">
                    <div class="text-3xl font-bold mb-1 animate-pulse-slow">98%</div>
                    <p>{{ __('messages.stats_satisfaction') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-12 bg-white text-[14px]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10 animate-on-scroll">
                <h2 class="font-bold mb-2">{{ __('messages.core_values_title') }}</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">{{ __('messages.core_values_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-gray-200 rounded-2xl p-5 card-hover animate-on-scroll">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-[#79131d] mb-3">
                        <i class="fas fa-lightbulb text-[#e4ce96]"></i>
                    </div>
                    <h3 class="font-bold mb-2">{{ __('messages.value_1_title') }}</h3>
                    <p class="text-gray-600">{{ __('messages.value_1_text') }}</p>
                </div>

                <div class="bg-gray-200 rounded-2xl p-5 card-hover animate-on-scroll">
                    <div class="w-12 h-12 bg-[#79131d] rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-users text-[#e4ce96]"></i>
                    </div>
                    <h3 class="font-bold mb-2">{{ __('messages.value_2_title') }}</h3>
                    <p class="text-gray-600">{{ __('messages.value_2_text') }}</p>
                </div>

                <div class="bg-gray-200 rounded-2xl p-5 card-hover animate-on-scroll">
                    <div class="w-12 h-12 bg-[#79131d] rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-star text-[#e4ce96]"></i>
                    </div>
                    <h3 class="font-bold mb-2">{{ __('messages.value_3_title') }}</h3>
                    <p class="text-gray-600">{{ __('messages.value_3_text') }}</p>
                </div>
            </div>
        </div>
    </section>
    </div>

    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('animated');
                });
            }, {
                threshold: 0.1
            });
            animatedElements.forEach(el => observer.observe(el));
        });
    </script>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
