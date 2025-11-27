<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('teacher.dashboard_title') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <!-- Load Alpine (defer ok) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Flag Icons -->
    <link rel="stylesheet" href="{{ asset('node_modules/flag-icons/css/flag-icons.min.css') }}">

    <style>
        /* Hide elements with x-cloak until Alpine initializes */
        [x-cloak] {
            display: none !important;
        }

        /* RTL helpers for margin utilities used in icons/text */
        [dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }

        [dir="rtl"] .ml-2 {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }

        /* Ensure dropdowns align correctly in RTL: if dir=rtl, switch right -> left */
        [dir="rtl"] .dropdown-right {
            right: auto !important;
            left: 0 !important;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <x-teacher-sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-end items-center gap-4 px-6 py-4">

                    <!-- Language Dropdown (Alpine) -->
                    <div class="relative inline-block text-left" x-data="{ openLang: false }">
                        <!-- Button -->
                        <button @click="openLang = !openLang"
                            class="px-3 py-2 rounded-md text-white text-sm flex items-center gap-2"
                            style="background-color:#79131d;">
                            <i class="fas fa-globe"></i>
                            <span class="hidden sm:inline">
                                @if (app()->getLocale() == 'ar')
                                    عربي
                                @else
                                    English
                                @endif
                            </span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <!-- Menu -->
                        <div x-cloak x-show="openLang" x-transition @click.outside="openLang = false"
                            class="absolute mt-2 w-36 bg-white rounded-md shadow-lg py-1 z-50 dropdown-right">
                            <a href="{{ route('lang.switch', 'ar') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-100 {{ app()->getLocale() == 'ar' ? 'font-semibold' : '' }}">
                                <span class="fi fi-sa"></span>
                                <span>العربية</span>
                            </a>

                            <a href="{{ route('lang.switch', 'en') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-100 {{ app()->getLocale() == 'en' ? 'font-semibold' : '' }}">
                                <span class="fi fi-us"></span>
                                <span>English</span>
                            </a>
                        </div>
                    </div>

                    <!-- User Dropdown (Alpine) -->
                    <div class="relative inline-block text-left" x-data="{ openUser: false }">
                        <!-- Button -->
                        <button @click="openUser = !openUser" class="flex items-center focus:outline-none">
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="w-8 h-8 rounded-full mr-2"
                                alt="User Image">
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2 text-xs text-gray-500 transition-transform duration-200"
                                :class="{ 'transform rotate-180': openUser }"></i>
                        </button>

                        <!-- Dropdown -->
                        <div x-cloak x-show="openUser" x-transition @click.outside="openUser = false"
                            class="absolute right-0 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-50 dropdown-right">
                            <div class="py-1">
                                <a href="{{ route('profile') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    {{ __('teacher.profile') }}
                                </a>

                                <div class="border-t border-gray-100 my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        {{ __('teacher.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </header>

            {{ $slot }}

        </div>

    </div>

</body>

</html>
