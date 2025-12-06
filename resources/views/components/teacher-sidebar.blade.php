<?php
$currentRoute = request()->route()->getName();
?>
<div class="hidden md:flex md:flex-shrink-0" x-data="{ 
    openSections: {
        courses: false
    },
    toggleSection(section) {
        this.openSections[section] = !this.openSections[section];
    }
}">
    <div class="flex flex-col w-72 text-white shadow-2xl" style="background: linear-gradient(180deg, #79131d 0%, #5a0f16 100%);">
        <!-- Header -->
        <div class="flex items-center justify-between h-20 px-6 border-b border-[#e4ce96]/30 bg-[#79131d]/50 backdrop-blur-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-[#e4ce96] to-[#d4be86] rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-graduation-cap text-[#79131d] text-xl"></i>
                </div>
                <div>
                    <a href="{{ route('dashboard') }}" class="text-lg font-bold hover:opacity-90 transition"
                        style="color: #e4ce96; text-decoration: none;">
                        Oxford Dashboard
                    </a>
                    <p class="text-xs text-[#e4ce96]/70">Teacher Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-[#e4ce96]/30 scrollbar-track-transparent">
            <nav class="px-4 py-6 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_contains($currentRoute, 'dashboard') && !str_contains($currentRoute, 'courses') ? 'bg-[#e4ce96] shadow-lg' : 'hover:bg-[#e4ce96]/20' }}"
                    style="{{ str_contains($currentRoute, 'dashboard') && !str_contains($currentRoute, 'courses') ? 'color: #79131d;' : 'color: #e4ce96;' }}">
                    <i class="fas fa-tachometer-alt text-lg {{ str_contains($currentRoute, 'dashboard') && !str_contains($currentRoute, 'courses') ? '' : 'text-[#e4ce96]' }}"></i>
                    <span class="font-semibold">{{ __('teacher.dashboard') }}</span>
                </a>

                <div class="h-px bg-[#e4ce96]/20 my-4"></div>

                <!-- Wallet -->
                <a href="{{ route('teacher.wallet.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_contains($currentRoute, 'teacher.wallet') ? 'bg-[#e4ce96] shadow-lg' : 'hover:bg-[#e4ce96]/20' }}"
                    style="{{ str_contains($currentRoute, 'teacher.wallet') ? 'color: #79131d;' : 'color: #e4ce96;' }}">
                    <i class="fas fa-wallet text-lg {{ str_contains($currentRoute, 'teacher.wallet') ? '' : 'text-[#e4ce96]' }}"></i>
                    <span class="font-semibold">{{ __('teacher.wallet') ?? 'المحفظة' }}</span>
                </a>

                <!-- Support -->
                <a href="{{ route('teacher.support.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_contains($currentRoute, 'teacher.support') ? 'bg-[#e4ce96] shadow-lg' : 'hover:bg-[#e4ce96]/20' }}"
                    style="{{ str_contains($currentRoute, 'teacher.support') ? 'color: #79131d;' : 'color: #e4ce96;' }}">
                    <i class="fas fa-life-ring text-lg {{ str_contains($currentRoute, 'teacher.support') ? '' : 'text-[#e4ce96]' }}"></i>
                    <span class="font-semibold">{{ __('teacher.support') ?? 'المساعدة' }}</span>
                </a>

                <div class="h-px bg-[#e4ce96]/20 my-4"></div>

                <!-- Courses Section -->
                <div class="space-y-1">
                    <button @click="toggleSection('courses')"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 hover:bg-[#e4ce96]/20"
                        style="color: #e4ce96;">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-book-open text-lg"></i>
                            <span class="font-medium">{{ __('teacher.courses') }}</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                            :class="{ 'rotate-180': openSections.courses }"></i>
                    </button>
                    <div x-show="openSections.courses" x-transition class="space-y-1 mr-4 mt-1">
                        <a href="{{ route('teacher.courses.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'teacher.courses.index') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-list text-sm"></i>
                            <span>{{ __('teacher.all_courses') ?? 'جميع الدورات' }}</span>
                        </a>
                        <a href="{{ route('teacher.courses.create') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'teacher.courses.create') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-plus-circle text-sm"></i>
                            <span>{{ __('teacher.add_new_course') }}</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- User Profile Footer -->
        <div class="p-4 border-t border-[#e4ce96]/30 bg-[#79131d]/50 backdrop-blur-sm">
            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#e4ce96]/10 transition-all duration-200 cursor-pointer">
                <div class="relative">
                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' }}"
                        alt="{{ Auth::user()->name ?? 'Guest' }}" 
                        class="w-12 h-12 rounded-full object-cover border-2 border-[#e4ce96]/50 shadow-lg">
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-[#79131d]"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-[#e4ce96] truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-[#e4ce96]/70 truncate">
                        <i class="fas fa-chalkboard-teacher text-yellow-400"></i> {{ __('teacher.teacher') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Scrollbar */
    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: rgba(228, 206, 150, 0.3);
        border-radius: 2px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: rgba(228, 206, 150, 0.5);
    }

    /* Smooth transitions */
    [x-cloak] { display: none !important; }
</style>
