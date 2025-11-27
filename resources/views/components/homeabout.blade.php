<section class="bg-white py-12" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div
        class="container mx-auto flex flex-col md:flex-row items-center justify-center {{ app()->getLocale() === 'ar' ? 'md:space-x-reverse md:space-x-16' : 'md:space-x-16' }} space-y-8 md:space-y-0">

        <!-- Button + Subtext -->
        <div class="text-center">
            <a href="{{ route('about') }}"
                class="bg-[#79131d] hover:bg-[#5F0B14FF] text-white text-[12px] font-semibold px-6 py-3 rounded-full shadow">
                {{ __('messages.eligible_button') }}
            </a>
            <p class="text-sm text-gray-600 mt-2">
                {{ __('messages.eligible_subtext') }}
            </p>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-12 bg-gray-200"></div>

        <!-- Alumni -->
        <div class="text-center">
            <h3 class="text-xl font-bold text-gray-900">35,000</h3>
            <p class="text-sm text-gray-600">
                {{ __('messages.happy_alumni') }}
            </p>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-12 bg-gray-200"></div>

        <!-- Parents Recommend -->
        <div class="text-center">
            <h3 class="text-xl font-bold text-gray-900">99%</h3>
            <p class="text-sm text-gray-600">
                {{ __('messages.parents_recommend') }}
            </p>
        </div>

        <!-- Divider -->
        <div class="hidden md:block w-px h-12 bg-gray-200"></div>

        <!-- Reviews -->
        <div class="text-center flex flex-col items-center">
            <div class="flex -space-x-2">
                <img src="https://randomuser.me/api/portraits/women/44.jpg"
                    class="w-8 h-8 rounded-full border-2 border-white" alt="">
                <img src="https://randomuser.me/api/portraits/men/45.jpg"
                    class="w-8 h-8 rounded-full border-2 border-white" alt="">
                <img src="https://randomuser.me/api/portraits/women/46.jpg"
                    class="w-8 h-8 rounded-full border-2 border-white" alt="">
            </div>
            <p class="text-sm text-gray-600 mt-1">
                <span class="font-semibold text-gray-900">4.8 ★</span>
                {{ __('messages.reviews_from') }}
                <a href="#" class="text-blue-600 hover:underline">
                    {{ __('messages.reviews_count') }}
                </a>
            </p>
        </div>

    </div>
</section>
