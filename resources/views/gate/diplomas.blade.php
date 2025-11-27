@php
    use App\Models\DiplomasCategorey;
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    $categories = DiplomasCategorey::all();

    $diplomasForJs = ($diplomas ?? collect())
        ->map(function ($diploma) {
            return [
                'id' => $diploma->id,
                'slug' => $diploma->slug,
                'user_id' => $diploma->user_id,
                'title' => $diploma->name,
                'description' => $diploma->description,
                'description_short' => Str::limit($diploma->description, 50),
                'price' => (int) $diploma->price,
                'level' => ucfirst($diploma->level ?? 'Beginner'),
                'category_name' => $diploma->categorey->name ?? 'General',
                'cover_photo_url' => $diploma->image ? asset('storage/' . $diploma->image) : '',
                'duration' => $diploma->duration ?? 0,
                'instructor' => $diploma->user->name ?? '—',
                'rating' => $diploma->rating ?? 0,
                'reviews_count' => $diploma->reviews_count ?? 0,

                // 🔥 روابط العرض
                'guest_url' => route('gate.diplomas.show', $diploma->slug),
                'owner_url' => route('gate.diplomas.show.diploma', $diploma->slug),

                'start_date_formatted' => $diploma->start_date
                    ? Carbon::parse($diploma->start_date)->format('d M Y')
                    : null,
            ];
        })
        ->values()
        ->toArray();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.all_diplomas') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        
        [dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }
        
        [dir="rtl"] .space-x-2 > * + * {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }
    </style>
</head>

<body class="bg-gray-50" x-data="diplomaFilter()" x-cloak>
    <x-gate-navbar />

    <div class="mt-10"></div>
    <div class="mt-10"></div>

    <section class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="text-center lg:text-left mb-6">
                <h2 class="text-3xl font-bold text-gray-900">{{ __('messages.featured_diplomas') }}</h2>
                <p class="text-gray-600">{{ __('messages.boost_diplomas') }}</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Filters -->
                <div class="w-full lg:w-64 flex-shrink-0">
                    <div class="bg-white p-5 rounded-lg shadow sticky top-6">

                        <!-- Search -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.search_diplomas') }}
                            </label>
                            <input type="text" x-model="search" placeholder="{{ __('messages.search_placeholder') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-[#79131d]">
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <h3 class="text-gray-600 text-sm font-medium mb-3">{{ __('messages.categories') }}</h3>
                            <div class="space-y-2 max-h-60 overflow-y-auto pr-1">
                                @foreach ($categories as $item)
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" x-model="selectedCategories"
                                            :value="'{{ $item->name }}'"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                                        <span class="text-gray-700 text-sm">{{ $item->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.price_range') }}:
                                <span x-text="minPrice"></span> – <span x-text="maxPrice"></span> <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" alt="SAR" class="inline-block sar-symbol">
                            </label>
                            <div class="flex items-center gap-2 mb-1">
                                <input type="range" min="0" :max="globalMaxPrice" x-model="minPrice"
                                    class="w-full h-2 bg-gray-200 rounded-lg">
                                <input type="range" min="0" :max="globalMaxPrice" x-model="maxPrice"
                                    class="w-full h-2 bg-gray-200 rounded-lg">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Diplomas Grid -->
                <div class="flex-1">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" x-show="!isLoading">

                        <template x-for="diploma in filteredDiplomas" :key="diploma.id">

                            <div class="bg-white rounded-lg shadow-md hover:shadow-xl overflow-hidden flex flex-col">

                                <!-- Image -->
                                <div class="relative h-48 overflow-hidden">
                                    <img :src="diploma.cover_photo_url"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">

                                    <div class="absolute bottom-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded"
                                        x-text="diploma.start_date_formatted"></div>

                                    <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded"
                                        x-text="diploma.level"></div>
                                </div>

                                <!-- Body -->
                                <div class="p-6 flex flex-col justify-between flex-1">

                                    <div>
                                        <span
                                            class="inline-block mb-2 px-3 py-1 text-xs font-semibold text-[#e4ce96] bg-[#79131d] rounded-full"
                                            x-text="diploma.category_name"></span>

                                        <h3 class="text-xl font-semibold text-gray-900" x-text="diploma.title"></h3>

                                        <p class="text-gray-600 text-sm mb-3 line-clamp-3"
                                            x-text="diploma.description_short"></p>
                                    </div>

                                    <div class="mt-auto border-t pt-4 flex justify-between items-center text-sm">

                                        <div>
                                            <span class="font-bold">{{ __('messages.instructor') }}:</span>
                                            <span class="opacity-60" x-text="diploma.instructor"></span>
                                        </div>

                                        <div class="flex items-center">
                                            <span class="text-yellow-400">★</span>
                                            <span class="ml-1 text-gray-600"
                                                x-text="diploma.rating + ' (' + diploma.reviews_count + ')'"></span>
                                        </div>
                                    </div>

                                    <!-- Price + Link -->
                                    <div class="pt-4 flex justify-between items-center">
                                        <span class="text-lg font-bold text-[#79131d]"
                                            x-text="diploma.price"></span> <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" alt="SAR" class="inline-block sar-symbol">

                                        <!-- 🔥 الرابط حسب المالك -->
                                        <a :href="window.authId === diploma.user_id ? diploma.owner_url : diploma.guest_url"
                                            class="px-4 py-2 bg-[#79131dd2] text-[#e4ce96] rounded-md hover:bg-[#79131d] transition">
                                            <span
                                                x-text="window.authId === diploma.user_id
                                                ? '{{ __('messages.my_diploma') }}'
                                                : '{{ __('messages.subscribe_now') }}' "></span>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </template>

                        <template x-if="filteredDiplomas.length === 0">
                            <div class="col-span-full text-center py-12 text-gray-500">
                                {{ __('messages.no_diplomas_found') }}
                            </div>
                        </template>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <x-footer />

    <script>
        function diplomaFilter() {
            return {
                search: '',
                selectedCategories: [],
                minPrice: 0,
                maxPrice: 500,

                diplomas: {!! json_encode($diplomasForJs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!},

                globalMaxPrice: 500,
                isLoading: false,

                init() {
                    if (this.diplomas.length > 0) {
                        this.globalMaxPrice = Math.max(...this.diplomas.map(d => d.price));
                        this.maxPrice = this.globalMaxPrice;
                    }
                },

                get filteredDiplomas() {
                    return this.diplomas.filter(d => {
                        if (this.search && !d.title.toLowerCase().includes(this.search.toLowerCase()))
                        return false;
                        if (this.selectedCategories.length > 0 && !this.selectedCategories.includes(d
                                .category_name)) return false;
                        if (d.price < this.minPrice || d.price > this.maxPrice) return false;
                        return true;
                    });
                }
            };
        }

        window.authId = {{ auth()->id() ?? 'null' }};
    </script>

</body>

</html>
