<!-- Top Bar with Marquee -->
<div class="bg-[#79131d] text-white py-3 px-6 text-sm sticky top-0 w-full z-50 overflow-hidden"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" x-data="{ langMenuTop: false }">

    <!-- Marquee Wrapper -->
    <div class="flex items-center justify-between">

        <!-- LEFT SIDE (Call + Social) -->
        <div class="flex items-center gap-6 ml-20">
            <span>Call: 971563357115</span>

            <div class="flex items-center gap-3">
                <span>Follow us:</span>

                <!-- Facebook -->
                <a href="#" class="hover:text-gray-300">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24">
                        <path
                            d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1 .9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.3l-.4 3h-1.9v7A10 10 0 0 0 22 12" />
                    </svg>
                </a>

                <!-- Twitter -->
                <a href="#" class="hover:text-gray-300">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24">
                        <path
                            d="M22.46 6c-.77.35-1.5.6-2.3.7a3.9 3.9 0 0 0 1.7-2.2 7.72 7.72 0 0 1-2.5 1 3.86 3.86 0 0 0-6.6 3.5A10.94 10.94 0 0 1 3.1 4.9 3.86 3.86 0 0 0 4.3 10a4 4 0 0 1-1.7-.5v.05a3.86 3.86 0 0 0 3.1 3.8 3.9 3.9 0 0 1-1.7.07 3.9 3.9 0 0 0 3.6 2.7A7.72 7.72 0 0 1 2 18.1a11 11 0 0 0 6 1.7" />
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="#" class="hover:text-gray-300">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24">
                        <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2
                                 5-5V7c0-2.8-2.2-5-5-5H7zm5 5a5 5 0 1 1 0 10
                                 5 5 0 0 1 0-10zm6-2a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                </a>

                <!-- YouTube -->
                <a href="#" class="hover:text-gray-300">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24">
                        <path d="M10 15l5.2-3L10 9v6zm12-3c0-2.5-.2-4.1-.5-5
                                 -.3-.9-1-1.6-1.9-1.9C18.7 5 12 5 12 5s-6.7 0-7.6.2
                                 c-.9.3-1.6 1-1.9 1.9C2.2 7.9 2 9.5 2 12s.2 4.1.5 5
                                 c.3.9 1 1.6 1.9 1.9C5.3 19 12 19 12 19s6.7 0 7.6-.2
                                 c.9-.3 1.6-1 1.9-1.9.3-.9.5-2.5.5-5z" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- RIGHT SIDE (Language + Login/Register) -->
        <div class="flex items-center gap-4 mr-6">

            <!-- Language Switch -->
            <div class="relative">
                <button @click="langMenuTop = !langMenuTop"
                    class="flex items-center gap-2 bg-white text-gray-800 px-2 py-1 rounded text-xs">

                    @if (app()->getLocale() === 'ar')
                        <span class="fi fi-sa"></span>
                        <span>AR</span>
                    @else
                        <span class="fi fi-us"></span>
                        <span>EN</span>
                    @endif
                </button>

                <div x-show="langMenuTop" @click.away="langMenuTop = false"
                    class="absolute right-0 mt-1 bg-white text-gray-800 w-24 shadow rounded text-sm">

                    <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100">
                        <span class="fi fi-us"></span> EN
                    </a>

                    <a href="{{ route('lang.switch', ['locale' => 'ar']) }}"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100">
                        <span class="fi fi-sa"></span> AR
                    </a>
                </div>
            </div>

            <!-- Auth -->
            @guest
                <a href="{{ route('login') }}" class="hover:text-gray-200">{{ __('messages.login') }}</a>
                <a href="{{ route('register') }}" class="hover:text-gray-200">{{ __('messages.register') }}</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="hover:text-gray-200">{{ __('messages.logout') }}</button>
                </form>
            @endguest
        </div>
    </div>
</div>




<!-- Main Navigation Bar (White) -->
<nav class="shadow-sm z-40 sticky top-[48px] w-full bg-white text-gray-800"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" x-data="{ open: false }">

    <div class="container mx-auto px-6 py-2 flex items-center justify-between">

        <!-- Left Section: Logo + Profile -->
        <div class="flex items-center gap-4">
            <a href="{{ route('gate.index') }}">
                <img src="{{ asset('images/logo.png') }}" class="h-14 w-14" alt="LOGO">
            </a>

            <!-- Profile Button -->
            <a href="https://profile.oxford-cis.com/" target="_blank"
                class="hidden md:flex items-center gap-2 px-3 py-1 bg-[#79131d] text-white rounded-md hover:bg-[#4B0A10] transition font-semibold text-[14px]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A9 9 0 1118.88 6.196 9 9 0 015.12 17.804zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-[16px]">{{ __('messages.profile') }}</span>
            </a>
        </div>

        <!-- Center Section: Menu Links -->
        <div class="hidden md:flex items-center gap-6 font-medium text-lg">
            <a href="{{ route('gate.index') }}"
                class="hover:text-[#79131d] transition {{ request()->is('/') ? 'text-[#79131d] underline' : '' }}">
                {{ __('messages.home') }}
            </a>
            <a href="{{ route('gate.categories') }}"
                class="hover:text-[#79131d] transition {{ request()->is('Courses') || request()->is('courses') ? 'text-[#79131d] underline' : '' }}">
                {{ __('messages.category') }}
            </a>
            <a href="{{ route('gate.diplomas') }}"
                class="hover:text-[#79131d] transition {{ request()->is('Courses') || request()->is('courses') ? 'text-[#79131d] underline' : '' }}">
                {{ __('messages.Diplomas') }}
            </a>
            <a href="{{ route('about') }}"
                class="hover:text-[#79131d] transition {{ request()->is('about') ? 'text-[#79131d] underline' : '' }}">
                {{ __('messages.about') }}
            </a>
            <a href="{{ route('contact') }}"
                class="hover:text-[#79131d] transition {{ request()->is('contact') ? 'text-[#79131d] underline' : '' }}">
                {{ __('messages.contact') }}
            </a>
            @auth
                <a href="{{ route('gate.diplomas.me') }}" class="hover:text-[#79131d]">
                    {{ __('messages.Mydiplomas') }}
                </a>
            @endauth
        </div>

        <!-- Mobile Button -->
        <button class="md:hidden ml-4" @click="open = !open">
            <svg x-show="!open" class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden bg-white text-gray-800 border-t shadow-inner">
        <div class="flex flex-col px-6 py-3 space-y-2 text-md font-medium">
            <a href="{{ route('gate.index') }}" class="hover:text-[#79131d]">{{ __('messages.home') }}</a>
            <a href="{{ route('gate.diplomas') }}" class="hover:text-[#79131d]">{{ __('messages.Diplomas') }}</a>
            <a href="{{ route('about') }}" class="hover:text-[#79131d]">{{ __('messages.about') }}</a>
            <a href="{{ route('contact') }}" class="hover:text-[#79131d]">{{ __('messages.contact') }}</a>
            @auth
                <a href="{{ route('gate.diplomas.me') }}"
                    class="hover:text-[#79131d]">{{ __('messages.MyCourses') }}</a>
            @endauth

            <hr>

            @guest
                <a href="{{ route('login') }}" class="hover:text-[#79131d]">{{ __('messages.login') }}</a>
                <a href="{{ route('register') }}" class="hover:text-[#79131d]">{{ __('messages.register') }}</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-left hover:text-[#79131d]">{{ __('messages.logout') }}</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
<div class="mt-10"></div>
{{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
