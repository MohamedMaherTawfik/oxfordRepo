<section class="bg-gray-100" dir="rtl">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- العنوان -->
        <div class="text-center mb-12">
            <h2 class="text-xs uppercase tracking-wider text-amber-700 font-medium mb-2">
                {{ __('messages.unique_to_us') }}
            </h2>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8">
                {{ __('messages.why_oxford_royale') }}
            </h1>
            <p class="text-gray-700 text-lg max-w-3xl mx-auto leading-relaxed">
                {{ __('messages.oxford_royale_description') }}
            </p>
        </div>

        <!-- أزرار التبويب -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button
                class="px-6 py-3 bg-[#79131D] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#530B12FF] transition-colors duration-200">
                {{ __('messages.inspirational_guest_speakers') }}
            </button>
            <button
                class="px-6 py-3 bg-[#79131D] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#530B12FF] transition-colors duration-200 border border-gray-200">
                {{ __('messages.our_teachers') }}
            </button>
            <button
                class="px-6 py-3 bg-[#79131D] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#530B12FF] transition-colors duration-200 border border-gray-200">
                {{ __('messages.how_you_learn') }}
            </button>
            <button
                class="px-6 py-3 bg-[#79131D] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#530B12FF] transition-colors duration-200 border border-gray-200">
                {{ __('messages.student_stories') }}
            </button>
            <button
                class="px-6 py-3 bg-[#79131D] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#530B12FF] transition-colors duration-200 border border-gray-200">
                {{ __('messages.designed_by_experts') }}
            </button>
            <button
                class="px-6 py-3 bg-[#79131D] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#530B12FF] transition-colors duration-200 border border-gray-200">
                {{ __('messages.beyond_classroom') }}
            </button>
        </div>

        <!-- المحتوى الرئيسي -->
        <div class="flex flex-col md:flex-row gap-10 items-start">
            <!-- النص -->
            <div class="md:w-1/2">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">
                    {{ __('messages.be_inspired_by_experts') }}
                </h2>
                <p class="text-[#e4ce96] mb-6 leading-relaxed">
                    {{ __('messages.unique_guest_speakers_intro') }}
                </p>
                <p class="text-gray-700 mb-8 leading-relaxed">
                    {{ __('messages.guest_speakers_description') }}
                </p>
                <a href="#"
                    class="inline-block px-6 py-3 bg-[#79131D] text-white rounded-full text-sm font-medium hover:bg-[#5F0B13FF] transition-colors duration-200">
                    {{ __('messages.find_out_more') }}
                </a>
            </div>

            <!-- الصورة -->
            <div class="md:w-1/2">
                <img src="https://d1okx4gh513q4s.cloudfront.net/files/963426522749773170-helen-profile-image.two-thirds.gif"
                    alt="{{ __('messages.student_astronaut_image_alt') }}"
                    class="rounded-lg shadow-md w-full h-auto object-cover">
            </div>
        </div>
    </div>
</section>
