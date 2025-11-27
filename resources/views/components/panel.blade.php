<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden" x-data="{ open: false }">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-end px-6 py-4">
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
                                            <i class="fas fa-user mr-2"></i> {{ __('Profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">
                                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            {{ $slot }}
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
