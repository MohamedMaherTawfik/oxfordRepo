<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.contact_title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        
        [dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }
        
        [dir="rtl"] .mr-4 {
            margin-right: 0 !important;
            margin-left: 1rem !important;
        }
        
        [dir="rtl"] .space-x-4 > * + * {
            margin-left: 0 !important;
            margin-right: 1rem !important;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <div class="flex-grow">
        <x-navbar />

    <div class="mt-10">.</div>
    <div class="mt-10">.</div>

    <section class="py-16 px-4 sm:px-6 lg:px-8" x-data="contactForm()" x-init="initAnimations()">
        <div class="max-w-4xl mx-auto">
            <!-- العنوان -->
            <div class="text-center mb-12" x-show="showHeader" x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <h2 class="text-3xl font-bold text-[#79131d] mb-4">{{ __('messages.contact_us') }}</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('messages.contact_intro') }}
                </p>
            </div>

            <!-- محتوى الاتصال -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden" x-show="showForm"
                x-transition:enter="transition ease-out duration-700 delay-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">

                <div class="grid grid-cols-1 md:grid-cols-2 {{ app()->getLocale() === 'ar' ? 'md:grid-flow-row-dense' : '' }}">
                    <!-- معلومات التواصل -->
                    <div class="bg-[#79131d] p-8 text-[#e4ce96] {{ app()->getLocale() === 'ar' ? 'order-2' : '' }}">
                        <h3 class="text-xl font-bold mb-6">{{ __('messages.contact_info') }}</h3>

                        <div class="space-y-5">
                            <div class="flex items-start {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                                <i class="fas fa-map-marker-alt mt-1 {{ app()->getLocale() === 'ar' ? 'ml-4 mr-0' : 'mr-4' }}"></i>
                                <div class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                    <h4 class="font-semibold">{{ __('messages.address') }}</h4>
                                    <p class="text-sm opacity-80">{{ $contact->address ?? '' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                                <i class="fas fa-phone-alt mt-1 {{ app()->getLocale() === 'ar' ? 'ml-4 mr-0' : 'mr-4' }}"></i>
                                <div>
                                    <h4 class="font-semibold">{{ __('messages.phone') }}</h4>
                                    <p class="text-sm opacity-80">{{ $contact->phone ?? '' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                                <i class="fas fa-envelope mt-1 {{ app()->getLocale() === 'ar' ? 'ml-4 mr-0' : 'mr-4' }}"></i>
                                <div>
                                    <h4 class="font-semibold">{{ __('messages.email') }}</h4>
                                    <p class="text-sm opacity-80">{{ $contact->email ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h4 class="font-semibold mb-3">{{ __('messages.follow_us') }}</h4>
                            <div class="flex {{ app()->getLocale() === 'ar' ? 'flex-row-reverse space-x-reverse' : 'space-x-4' }}">
                                @if ($footer->facebook)
                                    <a href="{{ $footer->facebook }}" target="_blank"
                                        class="w-10 h-10 rounded-full bg-[#e4ce96] text-[#79131d] flex items-center justify-center hover:bg-white transition">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                @endif
                                @if ($footer->x)
                                    <a href="{{ $footer->x }}" target="_blank"
                                        class="w-10 h-10 rounded-full bg-[#e4ce96] text-[#79131d] flex items-center justify-center hover:bg-white transition">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                                @if ($footer->telegram)
                                    <a href="{{ $footer->telegram }}" target="_blank"
                                        class="w-10 h-10 rounded-full bg-[#e4ce96] text-[#79131d] flex items-center justify-center hover:bg-white transition">
                                        <i class="fab fa-telegram-plane"></i>
                                    </a>
                                @endif
                                @if ($footer->instgram)
                                    <a href="{{ $footer->instgram }}" target="_blank"
                                        class="w-10 h-10 rounded-full bg-[#e4ce96] text-[#79131d] flex items-center justify-center hover:bg-white transition">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- نموذج المراسلة -->
                    <div class="p-8 {{ app()->getLocale() === 'ar' ? 'order-1' : '' }}">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">{{ __('messages.send_message') }}</h3>
                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                            @csrf

                            @guest
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('messages.full_name') }}
                                    </label>
                                    <input type="text" id="name" name="name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#79131d]"
                                        placeholder="{{ __('messages.enter_full_name') }}" required>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('messages.email') }}
                                    </label>
                                    <input type="email" id="email" name="user_email"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#79131d]"
                                        placeholder="{{ __('messages.enter_email') }}" required>
                                </div>
                            @endguest

                            @auth
                                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
                            @endauth

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('messages.specialist') }}
                                </label>
                                <input type="text" id="subject" name="subject"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#79131d]"
                                    placeholder="{{ __('messages.enter_specialist') }}" required>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('messages.message') }}
                                </label>
                                <textarea id="message" name="message" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#79131d]"
                                    placeholder="{{ __('messages.enter_message') }}" required></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-[#79131d] text-[#e4ce96] py-3 rounded-md font-medium hover:bg-[#79131d]/90 transition">
                                {{ __('messages.send_button') }}
                            </button>
                        </form>

                        @if (session('success'))
                            <div
                                class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md animate-fade-in">
                                <i class="fas fa-check-circle mr-2"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mt-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-md">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    <x-footer />

    <script>
        function contactForm() {
            return {
                showHeader: false,
                showForm: false,
                initAnimations() {
                    setTimeout(() => this.showHeader = true, 100);
                    setTimeout(() => this.showForm = true, 300);
                },
            }
        }
    </script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


</body>

</html>
