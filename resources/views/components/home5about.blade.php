@php
    $isArabic = app()->getLocale() === 'ar';
@endphp

<section class="py-20 bg-gradient-to-b from-white via-rose-50 to-white relative overflow-hidden"
    dir="{{ $isArabic ? 'rtl' : 'ltr' }}" x-data="{ activeTab: 1 }">

    <div class="container mx-auto px-6 relative z-10">

        <!-- الخلفية الزخرفية -->
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
            <div
                class="absolute -top-40 -left-40 w-96 h-96 bg-rose-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse">
            </div>
            <div
                class="absolute -bottom-40 -right-40 w-96 h-96 bg-teal-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse delay-1000">
            </div>
        </div>

        <!-- العنوان -->
        <div class="text-center mb-16">
            <h1
                class="text-2xl font-extrabold bg-gradient-to-r from-[#79131d] to-rose-600 bg-clip-text text-transparent mb-8">
                {{ __('messages.now_booking_2026') }}
            </h1>

            <!-- أزرار التبويبات -->
            <div class="flex flex-wrap justify-center gap-4 mb-12 {{ $isArabic ? 'flex-row-reverse' : '' }}">
                <button @click="activeTab = 1"
                    :class="{
                        'bg-[#79131d] text-[#e4ce96] text-[14px] shadow-lg scale-105': activeTab === 1,
                        'bg-gray-100 text-gray-700 hover:bg-gray-200': activeTab !== 1
                    }"
                    class="px-8 py-4 rounded-full font-semibold text-sm transition-all duration-500 transform hover:scale-105 focus:outline-none">
                    {{ __('messages.tab_tech_courses') }}
                </button>

                <button @click="activeTab = 2"
                    :class="{
                        'bg-[#79131d] text-[#e4ce96] text-[14px] shadow-lg scale-105': activeTab === 2,
                        'bg-gray-100 text-gray-700 hover:bg-gray-200': activeTab !== 2
                    }"
                    class="px-8 py-4 rounded-full font-semibold text-sm transition-all duration-500 transform hover:scale-105 focus:outline-none">
                    {{ __('messages.tab_guest_speakers') }}
                </button>

                <button @click="activeTab = 3"
                    :class="{
                        'bg-[#79131d] text-[#e4ce96] text-[14px] shadow-lg scale-105': activeTab === 3,
                        'bg-gray-100 text-gray-700 hover:bg-gray-200': activeTab !== 3
                    }"
                    class="px-8 py-4 rounded-full font-semibold text-sm transition-all duration-500 transform hover:scale-105 focus:outline-none">
                    {{ __('messages.tab_parent_events') }}
                </button>
            </div>

            <!-- المحتوى الرئيسي -->
            <div
                class="flex flex-col lg:flex-row items-center gap-12 {{ $isArabic ? 'lg:flex-row-reverse text-right' : 'text-left' }}">

                <!-- الصورة الديناميكية -->
                <div class="w-full lg:w-1/2">
                    <img :src="activeTab === 1 ?
                        'https://www.shutterstock.com/image-photo/education-technology-ai-artificial-intelligence-600nw-2380984587.jpg' :
                        activeTab === 2 ?
                        'https://blog.functionfixers.co.uk/assets/Motivational-Speaker-1-scaled.jpg' :
                        'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1200&q=80'"
                        alt="Tab Image"
                        class="rounded-3xl shadow-2xl w-full h-auto max-h-[450px] object-cover hover:scale-105 transition-transform duration-700"
                        x-transition.opacity.duration.500ms />
                </div>

                <!-- المحتوى الديناميكي -->
                <div class="w-full lg:w-1/2 space-y-6">

                    <!-- التبويب 1 -->
                    <div x-show="activeTab === 1" x-transition.opacity.duration.500ms>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.enrolment_open') }}</h2>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ __('messages.enrolment_para1') }}</p>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ __('messages.enrolment_para2') }}</p>
                        <p class="text-gray-700 leading-relaxed mb-6">{{ __('messages.enrolment_para3') }}</p>
                    </div>

                    <!-- التبويب 2 -->
                    <div x-show="activeTab === 2" x-transition.opacity.duration.500ms>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.speakers_title') }}</h2>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ __('messages.speakers_para1') }}</p>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ __('messages.speakers_para2') }}</p>
                        <p class="text-gray-700 leading-relaxed mb-6">{{ __('messages.speakers_para3') }}</p>
                    </div>

                    <!-- التبويب 3 -->
                    <div x-show="activeTab === 3" x-transition.opacity.duration.500ms>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.parents_title') }}</h2>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ __('messages.parents_para1') }}</p>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ __('messages.parents_para2') }}</p>
                        <p class="text-gray-700 leading-relaxed mb-6">{{ __('messages.parents_para3') }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
