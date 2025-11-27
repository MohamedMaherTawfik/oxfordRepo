<div class="relative w-full h-screen overflow-hidden">
    <!-- Video Background -->
    <video class="absolute top-0 left-0 w-full h-full object-cover z-0" autoplay muted loop playsinline>
        <source src="{{ asset('web/video.mp4') }}" type="video/mp4">
        {{ __('messages.video_not_supported') }}
    </video>
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70 z-10"></div>
    
    <!-- Content Overlay -->
    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center px-4 text-center">
        <div class="max-w-4xl mx-auto space-y-6 animate-fade-in">
            <!-- Logo/Brand -->
            <div class="mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Oxford Logo" class="h-24 w-24 mx-auto mb-4 drop-shadow-2xl">
            </div>
            
            <!-- Main Heading -->
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-lg">
                {{ __('messages.WelcomeMessage') }}
                <span class="text-[#e4ce96]">{{ __('messages.title') }}</span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-lg md:text-xl lg:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto leading-relaxed">
                {{ __('messages.welcomeDescription') }}
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center {{ app()->getLocale() === 'ar' ? 'sm:flex-row-reverse' : '' }}">
                <a href="{{ route('courses.all') }}"
                    class="px-8 py-4 bg-[#79131d] hover:bg-[#5a0f16] text-white font-semibold rounded-lg shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 text-lg">
                    {{ __('messages.Browse') }}
                </a>
                <a href="{{ route('about') }}"
                    class="px-8 py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white font-semibold rounded-lg border-2 border-white/30 hover:border-white/50 shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 text-lg">
                    {{ __('messages.about') }}
                </a>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
    
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
    </style>
</div>
