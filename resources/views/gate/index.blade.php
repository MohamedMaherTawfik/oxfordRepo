<x-gatelayout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-[#79131d] via-[#5a0f16] to-[#79131d] py-20 md:py-32 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row items-center gap-12 {{ app()->getLocale() === 'ar' ? 'lg:flex-row-reverse' : '' }}">
                    <!-- Left: Content -->
                    <div class="lg:w-1/2 text-center lg:text-left {{ app()->getLocale() === 'ar' ? 'lg:text-right' : '' }}">
                        <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                            <span class="text-white text-sm font-semibold uppercase tracking-wide">
                                {{ __('messages.welcome_to_gate') ?? 'Welcome to GATE' }}
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                            {{ __('messages.gate_hero_title') ?? 'Professional Studies Training Portal' }}
                        </h1>
                        <p class="text-xl text-white/90 leading-relaxed mb-8 max-w-2xl {{ app()->getLocale() === 'ar' ? 'mx-auto lg:mx-0' : 'mx-auto lg:mx-0' }}">
                            {{ __('messages.gate_hero_description') ?? 'We aim to prepare the best leadership and professional competencies, as we strive to develop your skills and enhance your capabilities through specialized training programs.' }}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 {{ app()->getLocale() === 'ar' ? 'sm:flex-row-reverse justify-center lg:justify-start' : 'justify-center lg:justify-start' }}">
                            <a href="{{ route('gate.diplomas') }}"
                                class="inline-flex items-center justify-center px-8 py-4 bg-white text-[#79131d] font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <i class="fas fa-graduation-cap {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('messages.explore_programs') ?? 'Explore Programs' }}
                            </a>
                            <a href="#about"
                                class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white/10 transition-all duration-300">
                                <i class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('messages.learn_more') ?? 'Learn More' }}
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right: Stats or Image -->
                    <div class="lg:w-1/2">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                                <div class="text-4xl font-bold text-white mb-2">1000+</div>
                                <div class="text-white/80 text-sm">{{ __('messages.students') ?? 'Students' }}</div>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                                <div class="text-4xl font-bold text-white mb-2">50+</div>
                                <div class="text-white/80 text-sm">{{ __('messages.programs') ?? 'Programs' }}</div>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                                <div class="text-4xl font-bold text-white mb-2">100+</div>
                                <div class="text-white/80 text-sm">{{ __('messages.instructors') ?? 'Instructors' }}</div>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                                <div class="text-4xl font-bold text-white mb-2">95%</div>
                                <div class="text-white/80 text-sm">{{ __('messages.success_rate') ?? 'Success Rate' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-6xl mx-auto">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <video id="homeVideo" 
                           class="w-full h-auto object-cover" 
                           autoplay 
                           muted 
                           loop
                           playsinline 
                           poster="{{ asset('web/graduation-group.jpg') }}">
                        <source src="{{ asset('web/video.mp4') }}" type="video/mp4">
                        {{ __('messages.video_not_supported') ?? 'Your browser does not support video playback.' }}
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end justify-center pb-8">
                        <button onclick="document.getElementById('homeVideo').play()" 
                                class="bg-white/20 backdrop-blur-sm rounded-full p-4 hover:bg-white/30 transition-all">
                            <i class="fas fa-play text-white text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row items-start gap-16 {{ app()->getLocale() === 'ar' ? 'lg:flex-row-reverse' : '' }}">
                    <!-- Left: Title -->
                    <div class="lg:w-1/2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                        <div class="inline-block px-4 py-2 bg-[#79131d]/10 rounded-full mb-6 {{ app()->getLocale() === 'ar' ? 'ml-auto' : 'mr-auto' }}">
                            <span class="text-[#79131d] text-sm font-semibold uppercase tracking-wide">
                                {{ __('messages.about_us') ?? 'About Us' }}
                            </span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                            {{ __('messages.certified_professional_education') ?? 'Get a Certified Professional Education' }}
                        </h2>
                    </div>
                    
                    <!-- Right: Description -->
                    <div class="lg:w-1/2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            {{ __('messages.gate_about_description') ?? 'We offer you a real opportunity to develop your skills and acquire the necessary knowledge required in the ever-evolving job market. Combining modern theories with practical application, our training programs provide you with the chance for professional growth and achieving your career goals.' }}
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            {{ __('messages.gate_about_description_2') ?? 'Join us and get ready to explore a new world of challenges and opportunities, and to achieve success in your professional journey.' }}
                        </p>
                        <div class="bg-gradient-to-r from-[#79131d]/10 to-[#5a0f16]/10 rounded-xl p-6 {{ app()->getLocale() === 'ar' ? 'border-r-4 border-[#79131d]' : 'border-l-4 border-[#79131d]' }}">
                            <p class="text-lg font-semibold text-[#79131d]">
                                {{ __('messages.register_free_now') ?? 'Register Free Now!' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <div class="inline-block px-4 py-2 bg-[#79131d]/10 rounded-full mb-4">
                        <span class="text-[#79131d] text-sm font-semibold uppercase tracking-wide">
                            {{ __('messages.our_programs') ?? 'Our Programs' }}
                        </span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ __('messages.professional_development_paths') ?? 'Professional Development Paths' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ __('messages.choose_your_path') ?? 'Choose the path that suits your career goals' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Program 1 -->
                    <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 flex items-center justify-center bg-gradient-to-br from-[#79131d] to-[#5a0f16] text-white text-3xl font-bold rounded-2xl transform rotate-3 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                                01
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-[#e4ce96] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.professional_diplomas') ?? 'Professional Diplomas' }}
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.professional_diplomas_desc') ?? 'Enhance your abilities and gain practical experience to excel professionally.' }}
                        </p>
                        <a href="{{ route('gate.diplomas') }}" 
                           class="inline-flex items-center text-[#79131d] font-semibold hover:text-[#5a0f16] transition-colors {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                            {{ __('messages.explore_specializations') ?? 'Explore specializations' }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }}"></i>
                        </a>
                    </div>

                    <!-- Program 2 -->
                    <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 flex items-center justify-center bg-gradient-to-br from-[#79131d] to-[#5a0f16] text-white text-3xl font-bold rounded-2xl transform rotate-3 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                                02
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-[#e4ce96] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.professional_masters') ?? 'Professional Master\'s Degree' }}
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.professional_masters_desc') ?? 'Graduate degree focusing on specialization and practical skills.' }}
                        </p>
                        <a href="{{ route('gate.diplomas') }}" 
                           class="inline-flex items-center text-[#79131d] font-semibold hover:text-[#5a0f16] transition-colors {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                            {{ __('messages.explore_specializations') ?? 'Explore specializations' }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }}"></i>
                        </a>
                    </div>

                    <!-- Program 3 -->
                    <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 flex items-center justify-center bg-gradient-to-br from-[#79131d] to-[#5a0f16] text-white text-3xl font-bold rounded-2xl transform rotate-3 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                                03
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-[#e4ce96] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.professional_doctorate') ?? 'Professional Doctorate' }}
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.professional_doctorate_desc') ?? 'Advanced research and practice to enhance knowledge and skills.' }}
                        </p>
                        <a href="{{ route('gate.diplomas') }}" 
                           class="inline-flex items-center text-[#79131d] font-semibold hover:text-[#5a0f16] transition-colors {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                            {{ __('messages.explore_specializations') ?? 'Explore specializations' }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }}"></i>
                        </a>
                    </div>

                    <!-- Program 4 -->
                    <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 flex items-center justify-center bg-gradient-to-br from-[#79131d] to-[#5a0f16] text-white text-3xl font-bold rounded-2xl transform rotate-3 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                                04
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-[#e4ce96] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.professional_fellowship') ?? 'Professional Fellowship' }}
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.professional_fellowship_desc') ?? 'High distinction for experts in their respective fields.' }}
                        </p>
                        <a href="{{ route('gate.diplomas') }}" 
                           class="inline-flex items-center text-[#79131d] font-semibold hover:text-[#5a0f16] transition-colors {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                            {{ __('messages.explore_specializations') ?? 'Explore specializations' }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }}"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Diplomas Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
                    <div class="mb-6 md:mb-0 {{ app()->getLocale() === 'ar' ? 'text-right ml-auto' : 'text-left' }}">
                        <div class="inline-block px-4 py-2 bg-[#79131d]/10 rounded-full mb-4 {{ app()->getLocale() === 'ar' ? 'ml-auto' : '' }}">
                            <span class="text-[#79131d] text-sm font-semibold uppercase tracking-wide">
                                {{ __('messages.most_enrolled_programs') ?? 'THE MOST ENROLLED PROGRAMS' }}
                            </span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mt-2">
                            {{ __('messages.program_categories') ?? 'Program Categories' }}
                        </h2>
                    </div>
                    <a href="{{ route('gate.diplomas') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#79131d] to-[#5a0f16] hover:from-[#5a0f16] hover:to-[#79131d] text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl {{ app()->getLocale() === 'ar' ? 'flex-row-reverse mr-auto' : '' }}">
                        <i class="fas fa-eye {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.view_all_diplomas') ?? 'View all Diplomas' }}
                    </a>
                </div>

                <x-diplomasomponent />
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <x-diplomascategoreycomponent />

    <!-- Newsletter Section -->
    <section class="py-20 bg-gradient-to-r from-[#79131d] via-[#5a0f16] to-[#79131d] relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 {{ app()->getLocale() === 'ar' ? 'md:flex-row-reverse' : '' }}">
                    <div class="md:w-2/3 text-center md:text-left {{ app()->getLocale() === 'ar' ? 'md:text-right' : '' }}">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            {{ __('messages.subscribe_section_title') ?? 'Subscribe to Our Newsletter' }}
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ __('messages.subscribe_section_desc') ?? 'Be the first to know about new programs and special offers' }}
                        </p>
                    </div>
                    <form class="flex flex-col sm:flex-row w-full md:w-auto gap-3 {{ app()->getLocale() === 'ar' ? 'sm:flex-row-reverse' : '' }}">
                        <input type="email" 
                               placeholder="{{ __('messages.subscribe_placeholder') ?? 'Your email' }}"
                               class="flex-1 px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] outline-none transition-all {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                        <button type="submit"
                            class="px-8 py-4 bg-gradient-to-r from-[#79131d] to-[#5a0f16] hover:from-[#5a0f16] hover:to-[#79131d] text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl whitespace-nowrap">
                            <i class="fas fa-paper-plane {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ __('messages.subscribe_button') ?? 'Subscribe' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</x-gatelayout>
