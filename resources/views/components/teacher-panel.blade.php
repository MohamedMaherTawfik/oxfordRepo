<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('teacher.dashboard_title') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- FontAwesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    {{-- alpine cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    {{-- Cairo Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    {{-- Flag Icons --}}
    <link rel="stylesheet" href="{{ asset('node_modules/flag-icons/css/flag-icons.min.css') }}">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        /* RTL Support */
        [dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }

        [dir="rtl"] .ml-2 {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Main Layout -->
    <div class="flex h-screen">
        <x-teacher-sidebar />

        <div class="flex-1 flex flex-col" x-data="{ open: false }">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center px-6 py-4">
                    <!-- زر الخيارات في الوسط -->
                    <div class="flex-1 flex justify-center">
                        <div class="relative" x-data="{ openOptions: false }">
                            <button @click="openOptions = !openOptions" @click.outside="openOptions = false"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-100 focus:outline-none">
                                <i class="fas fa-ellipsis-v text-gray-600"></i>
                                <span class="text-gray-700">{{ __('teacher.options') }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-500 transition-transform duration-200"
                                    :class="{ 'transform rotate-180': openOptions }"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="openOptions"
                                class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                                style="display: none">
                                <ul>
                                    <li>
                                        <a href="{{ route('dashboard') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-tachometer-alt mr-2"></i> {{ __('teacher.dashboard') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher.courses.create') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-plus-circle mr-2"></i> {{ __('teacher.add_new_course') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-user mr-2"></i> {{ __('teacher.profile') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <!-- زرار تغيير اللغة -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('lang.switch', 'ar') }}"
                                class="px-3 py-1 rounded text-sm font-medium transition
                   {{ app()->getLocale() == 'ar' ? 'bg-[#79131d] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                عربي
                            </a>

                            <a href="{{ route('lang.switch', 'en') }}"
                                class="px-3 py-1 rounded text-sm font-medium transition
                   {{ app()->getLocale() == 'en' ? 'bg-[#79131d] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                EN
                            </a>
                        </div>

                        <!-- زر البروفايل -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false"
                                class="flex items-center focus:outline-none">
                                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}"
                                    alt="{{ Auth::user()->name ?? 'Guest' }}"
                                    class="w-8 h-8 mr-2 rounded-full object-cover">
                                <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ml-2 text-xs text-gray-500 transition-transform duration-200"
                                    :class="{ 'transform rotate-180': open }"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                                style="display: none">
                                <ul>
                                    <li>
                                        <a href="{{ route('profile') }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-user mr-2"></i> {{ __('teacher.profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">
                                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('teacher.logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
