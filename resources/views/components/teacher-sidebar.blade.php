<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
</div>
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 text-white" style="background-color: #79131d">

        <!-- Header -->
        <div class="flex items-center h-16 px-4 border-b border-[#e4ce96]">
            <i class="fas fa-chart-line mr-2" style="color: #e4ce96"></i>

            <a href="{{ route('dashboard') }}" class="text-xl font-bold hover:opacity-80 transition"
                style="color: #e4ce96; text-decoration: none; display: inline-block; cursor: pointer;">

                {{ __('teacher.oxford_dashboard') }}

            </a>
        </div>

        <!-- Sidebar Nav -->
        <div class="flex-1 overflow-y-auto">
            <nav class="px-4 py-4">

                <!-- Main -->
                <div class="mb-6">
                    <h2 class="text-xs uppercase tracking-wider mb-2" style="color: #e4ce96">
                        {{ __('teacher.main') }}
                    </h2>

                    <ul>
                        <li class="mb-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-white"
                                style="background-color: #e4ce96">

                                <i class="fas fa-tachometer-alt mr-3" style="color: #79131d;"></i>

                                <span style="color: #79131d; font-weight: 600;">
                                    {{ __('teacher.dashboard') }}
                                </span>

                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Applications -->
                <div class="mb-6">
                    <h2 class="text-xs uppercase tracking-wider mb-2" style="color: #e4ce96">
                        {{ __('teacher.applications') }}
                    </h2>

                    <ul>
                        <li class="mb-1 group">
                            <a href="#" class="flex items-center justify-between px-3 py-2 rounded-lg"
                                style="color: #e4ce96">

                                <div class="flex items-center">
                                    <i class="fas fa-users mr-3"></i>
                                    {{ __('teacher.courses') }}
                                </div>

                                <i
                                    class="fas fa-chevron-down text-xs transform group-hover:rotate-180 transition-transform"></i>
                            </a>

                            <ul class="ml-6 mt-1 hidden group-hover:block">

                                <li class="mb-1">
                                    <a href="{{ route('teacher.courses.create') }}"
                                        class="flex items-center px-3 py-2 rounded-lg text-sm hover:bg-[#E4CE9648]"
                                        style="color: #e4ce96;">

                                        <i class="fa-solid fa-user mr-2"></i>
                                        {{ __('teacher.add_new_course') }}
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>

                </div>

            </nav>
        </div>

        <!-- Footer User -->
        <div class="p-4 border-t border-[#e4ce96]">
            <div class="flex items-center">

                <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="w-8 h-8 rounded-full mr-2"
                    alt="Profile">

                <div>
                    <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-[#e4ce96]">{{ __('teacher.admin') }}</p>
                </div>

            </div>
        </div>

    </div>
</div>
