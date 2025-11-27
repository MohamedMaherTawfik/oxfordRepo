<x-gatelayout>

    <section class="py-16 px-4 max-w-7xl mx-auto">
        <!-- عرض الدبلومات الخاصة بالكاتيجوري -->
        @if ($categories && $categories->diplomas->count() > 0)
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('messages.diplomas_in_category') }} {{ $categories->name ?? __('messages.categories') }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($categories->diplomas as $diploma)
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                            <!-- Image Section -->
                            @if ($diploma->image)
                                <img src="{{ asset('storage/' . $diploma->image) }}" alt="{{ $diploma->name }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <!-- Placeholder Image -->
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">{{ __('messages.no_image') }}</span>
                                </div>
                            @endif

                            <!-- Content Section -->
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $diploma->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($diploma->description, 100) }}</p>
                                <a href="{{ route('gate.diplomas.show', $diploma->slug) }}"
                                    class="inline-block bg-[#79131d] hover:bg-[#5e1017] text-white font-medium py-2 px-4 rounded-md transition">
                                    {{ __('messages.view_details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="mt-8 text-center">
                <p class="text-gray-600">{{ __('messages.no_diplomas_found') }}</p>
            </div>
        @endif
    </section>

    <!-- باقي الأقسام -->
    <x-diplomascategoreycomponent />

    <section class="py-16 bg-gradient-to-r from-[#79131d] to-[#5a0f16]">
        <!-- النشرة البريدية -->
    </section>

</x-gatelayout>
