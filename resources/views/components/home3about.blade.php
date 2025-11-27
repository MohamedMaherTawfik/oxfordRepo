<section class="bg-gray-100 py-20" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container mx-auto px-4 py-10">
        <div
            class="flex flex-col md:flex-row items-center justify-center gap-12 {{ app()->getLocale() === 'ar' ? 'md:flex-row-reverse' : '' }}">

            <!-- الصورة -->
            <div class="w-full md:w-1/2">
                <img src="https://www.futuristsspeakers.com/wp-content/uploads/2023/12/busnew40-scaled.jpg"
                    alt="{{ __('messages.image_alt') }}" class="rounded-lg shadow-lg">
            </div>

            <!-- النص -->
            <div class="w-full md:w-1/2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

                <h2 class="text-2xl font-bold text-gray-900 mb-6 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    {{ __('messages.title_1') }}
                </h2>

                <p class="text-gray-700 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    {{ __('messages.subtitle') }}
                </p>

                <ul class="text-gray-800 mb-4 text-[14px] space-y-2 {{ app()->getLocale() === 'ar' ? 'text-right list-inside' : 'text-left' }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    <li class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"><strong>{{ __('messages.brian_name') }}</strong> | {{ __('messages.brian_role') }}</li>
                    <li class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"><strong>{{ __('messages.rory_name') }}</strong> | {{ __('messages.rory_role') }}</li>
                    <li class="{{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"><strong>{{ __('messages.helen_name') }}</strong> | {{ __('messages.helen_role') }}</li>
                </ul>

                <p class="text-gray-700 mb-8 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    {{ __('messages.closing_text') }}
                </p>

            </div>
        </div>
    </div>
</section>
