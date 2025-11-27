<?php
use App\Models\footer;
$footer = footer::count();
$currentRoute = request()->route()->getName();
?>
<div class="hidden md:flex md:flex-shrink-0" x-data="{ 
    openSections: {
        users: false,
        courses: false,
        diplomas: false,
        settings: false
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
                    <a href="{{ route('admin.index') }}" class="text-lg font-bold hover:opacity-90 transition"
                        style="color: #e4ce96; text-decoration: none;">
                        Oxford Dashboard
                    </a>
                    <p class="text-xs text-[#e4ce96]/70">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-[#e4ce96]/30 scrollbar-track-transparent">
            <nav class="px-4 py-6 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('admin.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ str_contains($currentRoute, 'admin.index') ? 'bg-[#e4ce96] shadow-lg' : 'hover:bg-[#e4ce96]/20' }}"
                    style="{{ str_contains($currentRoute, 'admin.index') ? 'color: #79131d;' : 'color: #e4ce96;' }}">
                    <i class="fas fa-tachometer-alt text-lg {{ str_contains($currentRoute, 'admin.index') ? '' : 'text-[#e4ce96]' }}"></i>
                    <span class="font-semibold">{{ __('main.dashboard') }}</span>
                </a>

                <div class="h-px bg-[#e4ce96]/20 my-4"></div>

                <!-- Users Section -->
                <div class="space-y-1">
                    <button @click="toggleSection('users')"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 hover:bg-[#e4ce96]/20"
                        style="color: #e4ce96;">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-users text-lg"></i>
                            <span class="font-medium">{{ __('main.applications') }}</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                            :class="{ 'rotate-180': openSections.users }"></i>
                    </button>
                    <div x-show="openSections.users" x-transition class="space-y-1 mr-4 mt-1">
                        <!-- Students -->
                        <a href="{{ route('admin.users') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.users') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-user-graduate text-sm"></i>
                            <span>{{ __('main.all_students') }}</span>
                        </a>
                        <a href="{{ route('admin.users.create') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-user-plus text-sm"></i>
                            <span>{{ __('main.add_new_student') }}</span>
                        </a>
                        <!-- Teachers -->
                        <a href="{{ route('admin.teachers') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.teachers') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-chalkboard-teacher text-sm"></i>
                            <span>{{ __('main.all_teachers') }}</span>
                        </a>
                        <!-- Staff (Admin Only) -->
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.staff.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.staff') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-user-tie text-sm"></i>
                            <span>{{ __('main.staff') }}</span>
                        </a>
                        <a href="{{ route('admin.staff.create') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-user-plus text-sm"></i>
                            <span>{{ __('main.add_staff') }}</span>
                        </a>
                        @endif
                        <!-- Applies -->
                        <a href="{{ route('admin.applies') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.applies') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-clock text-sm"></i>
                            <span>{{ __('main.pending') }}</span>
                        </a>
                        <a href="{{ route('admin.accepts') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-check-circle text-sm"></i>
                            <span>{{ __('main.accepted') }}</span>
                        </a>
                        <a href="{{ route('admin.rejects') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-times-circle text-sm"></i>
                            <span>{{ __('main.rejected') }}</span>
                        </a>
                    </div>
                </div>

                <div class="h-px bg-[#e4ce96]/20 my-4"></div>

                <!-- Courses Section -->
                <div class="space-y-1">
                    <button @click="toggleSection('courses')"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 hover:bg-[#e4ce96]/20"
                        style="color: #e4ce96;">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-book-open text-lg"></i>
                            <span class="font-medium">{{ __('main.courses') }}</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                            :class="{ 'rotate-180': openSections.courses }"></i>
                    </button>
                    <div x-show="openSections.courses" x-transition class="space-y-1 mr-4 mt-1">
                        <a href="{{ route('admin.courses.me') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-user text-sm"></i>
                            <span>{{ __('main.my_courses') }}</span>
                        </a>
                        <a href="{{ route('admin.courses.all') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.courses') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-folder-open text-sm"></i>
                            <span>{{ __('main.all_courses') }}</span>
                        </a>
                        <a href="{{ route('admin.courses.create') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-plus-circle text-sm"></i>
                            <span>{{ __('main.add_new_course') }}</span>
                        </a>
                        <a href="{{ route('admin.categories') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.categories') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-tags text-sm"></i>
                            <span>{{ __('main.all_categories') }}</span>
                        </a>
                        <a href="{{ route('admin.categories.create') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-plus text-sm"></i>
                            <span>{{ __('main.create_category') }}</span>
                        </a>
                    </div>
                </div>

                <div class="h-px bg-[#e4ce96]/20 my-4"></div>

                <!-- Diplomas Section -->
                <div class="space-y-1">
                    <button @click="toggleSection('diplomas')"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 hover:bg-[#e4ce96]/20"
                        style="color: #e4ce96;">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-certificate text-lg"></i>
                            <span class="font-medium">{{ __('main.all_diplomas') }}</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                            :class="{ 'rotate-180': openSections.diplomas }"></i>
                    </button>
                    <div x-show="openSections.diplomas" x-transition class="space-y-1 mr-4 mt-1">
                        <a href="{{ route('diplomas.categorey.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-layer-group text-sm"></i>
                            <span>{{ __('main.all_diplomas_categories') }}</span>
                        </a>
                        <a href="{{ route('diplomas.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'diplomas.index') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-certificate text-sm"></i>
                            <span>{{ __('main.all_diplomas') }}</span>
                        </a>
                        <a href="{{ route('diplomas.create', 0) }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 hover:bg-[#e4ce96]/15"
                            style="color: #e4ce96;">
                            <i class="fas fa-plus text-sm"></i>
                            <span>{{ __('main.create_diploma') }}</span>
                        </a>
                    </div>
                </div>

                <div class="h-px bg-[#e4ce96]/20 my-4"></div>

                <!-- Settings Section -->
                <div class="space-y-1">
                    <button @click="toggleSection('settings')"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 hover:bg-[#e4ce96]/20"
                        style="color: #e4ce96;">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-cog text-lg"></i>
                            <span class="font-medium">{{ __('main.settings') }}</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                            :class="{ 'rotate-180': openSections.settings }"></i>
                    </button>
                    <div x-show="openSections.settings" x-collapse class="space-y-1 mr-4 mt-1">
                        <a href="{{ route('admin.footers') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.footers') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-globe text-sm"></i>
                            <span>{{ __('main.footer_settings') }}</span>
                        </a>
                        <a href="{{ route('admin.home') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.home') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-home text-sm"></i>
                            <span>{{ __('main.homepage') }}</span>
                        </a>
                        <a href="{{ route('admin.payments.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-all duration-200 {{ str_contains($currentRoute, 'admin.payments') ? 'bg-[#e4ce96]/30' : 'hover:bg-[#e4ce96]/15' }}"
                            style="color: #e4ce96;">
                            <i class="fas fa-credit-card text-sm"></i>
                            <span>{{ __('main.payment') }}</span>
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
                        @if(Auth::user()->role === 'admin')
                            <i class="fas fa-crown text-yellow-400"></i> {{ __('main.system_administrator') }}
                        @elseif(Auth::user()->role === 'staff')
                            <i class="fas fa-user-tie"></i> {{ __('main.employee') }}
                        @else
                            <i class="fas fa-user"></i> {{ Auth::user()->role }}
                        @endif
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
