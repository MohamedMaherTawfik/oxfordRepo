<nav class="bg-white fixed shadow-sm z-50 fixed top-0 w-full" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
    x-data="{ open: false, userMenu: false }">

    <!-- Top Section -->
    <div
        class="container mx-auto px-6 py-1 flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">

        <!-- Left Section -->
        <div class="flex items-center gap-4 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">

            <!-- 🔙 Back Button -->
            @if (!request()->is('/'))
                <a href="{{ url()->previous() }}"
                    class="flex items-center justify-center h-10 w-10 rounded-full border border-gray-300 hover:bg-gray-100 transition"
                    title="{{ __('messages.back') }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-gray-700 {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            <!-- Logo -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-14 sm:h-16 sm:w-16">

            <!-- 🌐 Language Dropdown - Enhanced -->
            <div class="relative" x-data="{ langMenu: false }">
                <button @click="langMenu = !langMenu"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200 border border-gray-200 hover:border-[#79131d] hover:shadow-sm group">
                    <span class="fi {{ app()->getLocale() === 'ar' ? 'fi-sa' : 'fi-us' }}" style="font-size: 1.2rem;"></span>
                    <span
                        class="text-lg font-bold {{ app()->getLocale() === 'ar' ? 'text-[#79131d]' : 'text-gray-700' }}">
                        {{ app()->getLocale() === 'ar' ? 'عربي' : 'English' }}
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 transition-transform duration-200 {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}"
                        :class="langMenu ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Enhanced Dropdown menu -->
                <div x-show="langMenu" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    @click.away="langMenu = false"
                    class="absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-40 bg-white border border-gray-200 rounded-xl shadow-xl z-50 overflow-hidden">
                    <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-[#79131d] hover:text-white transition-all duration-200 {{ app()->getLocale() === 'en' ? 'bg-gray-50 font-semibold' : '' }}">
                        <span class="fi fi-us"></span>
                        <span>English</span>
                        @if (app()->getLocale() === 'en')
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'ml-auto' : 'mr-auto' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                    <a href="{{ route('lang.switch', ['locale' => 'ar']) }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-[#79131d] hover:text-white transition-all duration-200 {{ app()->getLocale() === 'ar' ? 'bg-gray-50 font-semibold' : '' }}">
                        <span class="fi fi-sa"></span>
                        <span>العربية</span>
                        @if (app()->getLocale() === 'ar')
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'ml-auto' : 'mr-auto' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </a>
                </div>
            </div>

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

        <!-- Hamburger (visible on mobile) -->
        <button @click="open = !open"
            class="md:hidden text-gray-700 hover:text-[#79131d] focus:outline-none transition {{ app()->getLocale() === 'ar' ? 'order-first' : '' }}">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Desktop Links - Enhanced -->
        <div class="hidden md:flex flex-wrap justify-center gap-2 font-semibold text-[17px]">
            <a href="{{ route('home') }}"
                class="relative px-4 py-2 rounded-lg transition-all duration-200 {{ request()->is('/') ? 'text-[#79131d] bg-[#79131d]/10' : 'text-gray-700 hover:text-[#79131d] hover:bg-gray-50' }}">
                {{ __('messages.home') }}
                @if (request()->is('/'))
                    <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#79131d] rounded-full"></span>
                @endif
            </a>
            <a href="{{ route('courses.all') }}"
                class="relative px-4 py-2 rounded-lg transition-all duration-200 {{ request()->is('Courses') ? 'text-[#79131d] bg-[#79131d]/10' : 'text-gray-700 hover:text-[#79131d] hover:bg-gray-50' }}">
                {{ __('messages.Courses') }}
                @if (request()->is('Courses'))
                    <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#79131d] rounded-full"></span>
                @endif
            </a>
            <a href="{{ route('about') }}"
                class="relative px-4 py-2 rounded-lg transition-all duration-200 {{ request()->is('about') ? 'text-[#79131d] bg-[#79131d]/10' : 'text-gray-700 hover:text-[#79131d] hover:bg-gray-50' }}">
                {{ __('messages.about') }}
                @if (request()->is('about'))
                    <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#79131d] rounded-full"></span>
                @endif
            </a>
            <a href="{{ route('contact') }}"
                class="relative px-4 py-2 rounded-lg transition-all duration-200 {{ request()->is('contact') ? 'text-[#79131d] bg-[#79131d]/10' : 'text-gray-700 hover:text-[#79131d] hover:bg-gray-50' }}">
                {{ __('messages.contact') }}
                @if (request()->is('contact'))
                    <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#79131d] rounded-full"></span>
                @endif
            </a>
            <a href="{{ route('gate.index') }}"
                class="relative px-4 py-2 rounded-lg transition-all duration-200 {{ request()->is('gate.index') ? 'text-[#79131d] bg-[#79131d]/10' : 'text-gray-700 hover:text-[#79131d] hover:bg-gray-50' }}">
                {{ __('messages.diploma') }}
                @if (request()->is('gate.index'))
                    <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#79131d] rounded-full"></span>
                @endif
            </a>
            @if (Auth::check())
                <a href="{{ route('myCourses') }}"
                    class="px-4 py-2 rounded-lg text-gray-700 hover:text-[#79131d] hover:bg-gray-50 transition-all duration-200">
                    {{ __('messages.MyCourses') }}
                </a>
            @endif

            @guest
                <a href="{{ route('register') }}"
                    class="px-4 py-2 rounded-lg text-gray-700 hover:text-[#79131d] hover:bg-gray-50 transition-all duration-200">
                    {{ __('messages.register') }}
                </a>
            @endguest
        </div>

        <!-- Right Side (Desktop only) - Enhanced -->
        <div class="hidden md:flex items-center gap-3 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-5 py-2.5 bg-[#79131d] text-white rounded-lg hover:bg-[#4B0A10] transition-all duration-200 font-semibold text-[14px] shadow-md hover:shadow-lg transform hover:scale-105 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        {{ __('messages.logout') }}
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="px-5 py-2.5 bg-[#79131d] text-white rounded-lg hover:bg-[#4B0A10] transition-all duration-200 font-semibold text-[14px] shadow-md hover:shadow-lg transform hover:scale-105 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    {{ __('messages.login') }}
                </a>
            @endif
        </div>

    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden bg-white border-t border-gray-200 shadow-inner text-[14px]">
        <div class="flex flex-col px-6 py-2 space-y-2 font-medium">
            <a href="{{ route('home') }}" class="hover:text-[#79131d]">
                {{ __('messages.home') }}</a>
            <a href="{{ route('about') }}" class="hover:text-[#79131d]">
                {{ __('messages.about') }}</a>
            <a href="{{ route('contact') }}" class="hover:text-[#79131d]">
                {{ __('messages.contact') }}</a>
            <a href="{{ route('courses.all') }}" class="hover:text-[#79131d]">
                {{ __('messages.Courses') }}</a>
            @if (Auth::check())
                <a href="{{ route('myCourses') }}" class="hover:text-[#79131d]">
                    {{ __('messages.MyCourses') }}</a>
            @endif
            <hr class="my-1">
            @guest
                <a href="{{ route('login') }}" class="hover:text-[#79131d]">
                    {{ __('messages.login') }}</a>
                <a href="{{ route('register') }}" class="hover:text-[#79131d]">
                    {{ __('messages.register') }}</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-left hover:text-[#79131d]">
                        {{ __('messages.logout') }}</button>
                </form>
            @endguest
        </div>
    </div>

    <!-- Promo Banner -->
    <div class="bg-[#79131d] text-white text-center py-1 font-medium text-[14px] mt-1">
        {{ __('messages.promo_text') }}
        <a href="{{ route('contact') }}" class="underline text-[#e4ce96] text-[14px] hover:text-[#E4C474FF]">
            {{ __('messages.promo_link') }}
        </a>
    </div>
</nav>
