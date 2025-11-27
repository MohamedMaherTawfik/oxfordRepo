@php
    use App\Models\Categories;
    $categories = Categories::all();
    $isArabic = app()->getLocale() === 'ar';
@endphp

<section class="py-12 bg-gray-50" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
    <div class="container mx-auto px-4 text-center">
        <h3 class="text-sm font-medium text-gray-700 uppercase tracking-wider mb-8">
            {{ __('messages.browse_subjects') }}
        </h3>

        <div class="space-y-4">

            <!-- أول صف -->
            <div class="flex flex-wrap justify-center gap-3 {{ $isArabic ? 'flex-row-reverse' : 'flex-row' }}">
                @foreach ($categories->take(4) as $item)
                    <a href="{{ route('categories.show', $item) }}"
                        class="px-5 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>

            <!-- ثاني صف -->
            <div class="flex flex-wrap justify-center gap-3 {{ $isArabic ? 'flex-row-reverse' : 'flex-row' }}">
                @foreach ($categories->skip(4)->take(6) as $item)
                    <a href="{{ route('categories.show', $item) }}"
                        class="px-5 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>

            <!-- ثالث صف -->
            <div class="flex flex-wrap justify-center gap-3 {{ $isArabic ? 'flex-row-reverse' : 'flex-row' }}">
                @foreach ($categories->skip(10)->take(4) as $item)
                    <a href="{{ route('categories.show', $item) }}"
                        class="px-5 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</section>
