<section class="bg-white py-16" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div
        class="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center {{ app()->getLocale() === 'ar' ? 'lg:flex-row-reverse' : '' }}">

        <!-- Left Content -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 leading-tight mb-6">
                {{ __('messages.most_popular') }} <br> {{ __('messages.oxford_summer_school') }}
            </h2>

            <p class="text-gray-700 mb-6">
                {{ __('messages.description') }}
            </p>

            <ul class="list-disc list-inside space-y-3 text-gray-700 text-[14px] mb-6">
                <li>{{ __('messages.point1') }}</li>
                <li>{{ __('messages.point2') }}</li>
                <li>{{ __('messages.point3') }}</li>
                <li>{{ __('messages.point4') }}</li>
                <li>{{ __('messages.point5') }}</li>
                <li>{{ __('messages.point6') }}</li>
            </ul>

            <p class="text-gray-700 mb-6">
                {{ __('messages.over_20_years') }}
                <span class="font-semibold">{{ __('messages.students_count') }}</span>
                {{ __('messages.most_international') }}
            </p>

            <a href="{{ route('contact') }}"
                class="bg-[#79131d] hover:bg-[#640C14FF] text-white text-[12px] font-semibold px-6 py-3 rounded-full shadow">
                {{ __('messages.contact_us') }}
            </a>
        </div>

        <!-- Right Images -->
        <div class="grid grid-cols-2 gap-2">
            <div class="flex flex-col gap-2">
                <img src="https://www.universityofcalifornia.edu/sites/default/files/styles/article_default_banner/public/uc-irvine-students-tick.jpg?h=75334513&itok=GdwO3uwP"
                    alt="Students" class="rounded-xl object-cover w-full h-40">

                <div class="relative h-[420px] overflow-hidden rounded-xl shadow-lg">
                    <img src="https://burst.shopifycdn.com/photos/macbook-air-on-desk.jpg?width=1000&format=pjpg&exif=0&iptc=0"
                        alt="Students learning" class="w-full h-full object-cover" />
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <div class="relative h-[420px] overflow-hidden rounded-xl shadow-lg">
                    <img src="https://img.freepik.com/free-photo/friends-enjoying-lively-discussion-welldecorated-space_24972-2884.jpg?semt=ais_incoming&w=740&q=80"
                        alt="Students learning" class="w-full h-full object-cover" />
                </div>

                <img src="https://www.texasbarpractice.com/wp-content/uploads/2025/09/LawSchoolStudents.jpg"
                    alt="Oxford Summer School" class="rounded-xl object-cover w-full h-40">
            </div>
        </div>
    </div>
</section>
