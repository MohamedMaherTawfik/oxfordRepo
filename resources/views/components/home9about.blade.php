<!-- Newsletter Subscription Section -->
<section class="py-16 gradient-bg">
    <div class="container mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-2xl p-10 md:p-16 flex flex-col md:flex-row items-center justify-between"
            data-aos="zoom-in">
            <div class="md:w-2/3 mb-10 md:mb-0">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ __('messages.title_2') }}
                </h2>
                <p class="text-gray-600">
                    {{ __('messages.description_2') }}
                </p>
            </div>
            <div class="w-full md:w-1/3">
                <form class="flex flex-col md:flex-row gap-3">
                    <input type="email" placeholder="{{ __('messages.placeholder') }}"
                        class="px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#FFD700] flex-grow">
                    <button type="submit"
                        class="bg-[#800000] text-white font-bold px-6 py-3 rounded-lg hover:bg-[#600000] transition whitespace-nowrap">
                        {{ __('messages.button_2') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
