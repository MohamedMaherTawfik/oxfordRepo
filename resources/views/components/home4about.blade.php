<section class="py-10" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container text-[14px] mx-auto px-4">
        <div
            class="flex flex-col md:flex-row items-center justify-center gap-6 max-w-6xl mx-auto {{ app()->getLocale() === 'ar' ? 'md:flex-row-reverse' : '' }}">

            <!-- Card 1 -->
            <div
                class="flex-1 bg-[#79131DEE] border hover:bg-[#79131d] border-gray-300 rounded-xl p-6 md:p-8 flex items-center justify-between shadow-sm {{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-right' : 'text-left' }}">

                <div>
                    <p class="text-sm text-[#e4ce96]">{{ __('messages.card1_subtitle') }}</p>
                    <h3 class="text-xl font-semibold text-[#e4ce96]">{{ __('messages.card1_title') }}</h3>
                </div>

                <div
                    class="{{ app()->getLocale() === 'ar' ? 'mr-4' : 'ml-4' }} w-12 h-12 bg-[#e4ce96] rounded-full border border-gray-300 flex items-center justify-center hover:bg-[#e4ce96] transition-colors duration-300 cursor-pointer">
                    <svg class="w-6 h-6 text-gray-700 transform {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>

            <!-- Card 2 -->
            <div
                class="flex-1 bg-[#79131DEE] border hover:bg-[#79131d] border-gray-300 rounded-xl p-6 md:p-8 flex items-center justify-between shadow-sm {{ app()->getLocale() === 'ar' ? 'flex-row-reverse text-right' : 'text-left' }}">

                <div>
                    <p class="text-sm text-[#e4ce96]">{{ __('messages.card2_subtitle') }}</p>
                    <h3 class="text-xl font-semibold text-[#e4ce96]">{{ __('messages.card2_title') }}</h3>
                </div>

                <div
                    class="{{ app()->getLocale() === 'ar' ? 'mr-4' : 'ml-4' }} w-12 h-12 bg-[#E4CE96C0] rounded-full border border-gray-300 flex items-center justify-center hover:bg-[#e4ce96] transition-colors duration-300 cursor-pointer">
                    <svg class="w-6 h-6 text-gray-700 transform {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>

        </div>
    </div>
</section>
