@php
    use App\Models\Courses;
    $course_4 = Courses::inRandomOrder()->take(4)->get()->reverse();
    $newest = Courses::orderBy('created_at', 'desc')->take(4)->get();
    $isArabic = app()->getLocale() === 'ar';
@endphp

<!-- قسم الدورات الأكثر شهرة -->
<section class="py-16 bg-gray-50" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
    <div class="container mx-auto px-4">

        <!-- العنوان الرئيسي -->
        <div class="text-center mb-12">
            <p class="text-sm font-medium text-amber-700 uppercase tracking-wider">
                {{ __('messages.popular_this_year') }}
            </p>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-2 mb-6">
                {{ __('messages.dont_miss_out') }}
            </h2>
            <a href="{{ route('courses') }}"
                class="px-6 py-2 bg-[#79131DE8] border border-gray-300 rounded-full text-[#e4ce96] text-sm font-medium hover:bg-[#6D0C16FF] transition duration-200">
                {{ __('messages.browse_courses') }}
            </a>
        </div>

        <!-- العنوان الفرعي -->
        <div class="text-center mb-10">
            <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">
                {{ __('messages.limited_spaces') }}
            </p>
        </div>

        <!-- بطاقات الدورات -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($course_4 as $item)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                    <!-- الصورة -->
                    <img src="{{ $item->cover_photo
                        ? asset('storage/' . $item->cover_photo)
                        : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                        alt="{{ $item->title }}" class="w-full h-48 object-cover">

                    <!-- المحتوى -->
                    <div class="p-5">
                        <h3 class="font-semibold text-gray-900 text-center mb-4">{{ $item->title }}</h3>
                        <div class="flex justify-center {{ $isArabic ? 'space-x-reverse space-x-3' : 'space-x-3' }}">
                            <a href="{{ route('course.show', $item->slug) }}"
                                class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                                {{ __('messages.view_details') }}
                            </a>
                            @if ($item->user_id == auth()->id())
                                <a href="{{ route('myCourse', $item->slug) }}"
                                    class="px-4 py-2 bg-[#79131d] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#6D0C16FF] transition duration-200">
                                    {{ __('messages.mine') }}
                                </a>
                            @else
                                <a href="{{ route('course.show', $item->slug) }}"
                                    class="px-4 py-2 bg-[#79131d] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#6D0C16FF] transition duration-200">
                                    {{ __('messages.enroll') }}
                                </a>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- قسم أحدث الدورات -->
<section class="py-16 bg-gray-50" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
    <div class="container mx-auto px-4">
        <!-- العنوان الفرعي -->
        <div class="text-center mb-10">
            <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">
                {{ __('messages.newest_courses') }}
            </p>
        </div>

        <!-- بطاقات الدورات -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($newest as $item)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                    <!-- الصورة -->
                    <img src="{{ $item->cover_photo
                        ? asset('storage/' . $item->cover_photo)
                        : 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=' }}"
                        alt="{{ $item->title }}" class="w-full h-48 object-cover">

                    <!-- المحتوى -->
                    <div class="p-5">
                        <h3 class="font-semibold text-gray-900 text-center mb-4">{{ $item->title }}</h3>
                        <div class="flex justify-center {{ $isArabic ? 'space-x-reverse space-x-3' : 'space-x-3' }}">
                            <a href="{{ route('course.show', $item->slug) }}"
                                class="px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                                {{ __('messages.view_details') }}
                            </a>
                            @if ($item->user_id == auth()->id())
                                <a href="{{ route('myCourse', $item->slug) }}"
                                    class="px-4 py-2 bg-[#79131d] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#6D0C16FF] transition duration-200">
                                    {{ __('messages.mine') }}
                                </a>
                            @else
                                <a href="{{ route('course.show', $item->slug) }}"
                                    class="px-4 py-2 bg-[#79131d] text-[#e4ce96] rounded-full text-sm font-medium hover:bg-[#6D0C16FF] transition duration-200">
                                    {{ __('messages.enroll') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
