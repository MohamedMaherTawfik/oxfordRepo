@php
    use App\Models\DiplomasCategorey;
    use Illuminate\Support\Facades\Storage;
    $categories = DiplomasCategorey::all();
    $isArabic = app()->getLocale() === 'ar';
    $defaultPhoto =
        'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg';
@endphp

<section class="py-12 bg-gray-50" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
    <div class="container mx-auto px-4 {{ $isArabic ? 'text-right' : 'text-center' }}">
        <h3 class="text-sm font-medium text-gray-700 uppercase tracking-wider mb-8 {{ $isArabic ? 'text-right' : 'text-center' }}">
            {{ __('messages.browse_subjects') ?? 'Browse Subjects' }}
        </h3>

        <div class="space-y-4">

            <!-- أول صف -->
            <div class="flex flex-wrap {{ $isArabic ? 'justify-end' : 'justify-center' }} gap-3 {{ $isArabic ? 'flex-row-reverse' : 'flex-row' }}">
                @foreach ($categories->take(4) as $item)
                    <a href="{{ route('gate.diplomas.categorey.show', $item->slug) }}"
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200 {{ $isArabic ? 'flex-row-reverse' : '' }}">

                        <img src="{{ $item->photo ? asset('storage/' . $item->photo) : $defaultPhoto }}"
                            alt="{{ $item->name }}" class="w-6 h-6 rounded-full object-cover">

                        {{ $item->name }}
                    </a>
                @endforeach
            </div>

            <!-- ثاني صف -->
            <div class="flex flex-wrap {{ $isArabic ? 'justify-end' : 'justify-center' }} gap-3 {{ $isArabic ? 'flex-row-reverse' : 'flex-row' }}">
                @foreach ($categories->skip(4)->take(6) as $item)
                    <a href="{{ route('gate.diplomas.categorey.show', $item->slug) }}"
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200 {{ $isArabic ? 'flex-row-reverse' : '' }}">

                        @php

                            $imagePath =
                                $item->photo && Storage::disk('public')->exists($item->photo)
                                    ? asset('storage/' . $item->photo)
                                    : $defaultPhoto;
                        @endphp

                        <img src="{{ $imagePath }}" alt="{{ $item->name }}" class="w-6 h-6 rounded-full object-cover">

                        {{ $item->name }}
                    </a>
                @endforeach
            </div>

            <!-- ثالث صف -->
            <div class="flex flex-wrap {{ $isArabic ? 'justify-end' : 'justify-center' }} gap-3 {{ $isArabic ? 'flex-row-reverse' : 'flex-row' }}">
                @foreach ($categories->skip(10)->take(4) as $item)
                    <a href="{{ route('gate.diplomas.categorey.show', $item->slug) }}"
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-200 {{ $isArabic ? 'flex-row-reverse' : '' }}">

                        @php
                            $imagePath =
                                $item->photo && Storage::disk('public')->exists($item->photo)
                                    ? asset('storage/' . $item->photo)
                                    : $defaultPhoto;
                        @endphp

                        <img src="{{ $imagePath }}" alt="{{ $item->name }}" class="w-6 h-6 rounded-full object-cover">

                        {{ $item->name }}
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</section>
