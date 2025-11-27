@php
    use App\Models\studentReviews;
    $homepage = studentReviews::where('seen', 1)->get()->skip(1);
@endphp

<div class="container mx-auto px-4 py-12 max-w-7xl">
    <!-- Header Section -->
    <div class="mb-10">
        <h2 class="text-3xl text-center font-bold text-gray-900 mb-3">
            {{ __('messages.title') }}
        </h2>
        <p class="text-center text-gray-600">
            {{ __('messages.subtitle') }}
        </p>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($homepage as $item)
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <p class="text-gray-700 text-sm leading-relaxed mb-6">
                    {{ $item->message }}
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-800 font-medium text-sm">{{ $item->name }}</span>
                    </div>
                    <button
                        class="text-gray-600 text-sm font-medium hover:text-gray-800 transition-colors duration-200">
                        {{ $item->subject }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Tailwind CDN --}}
<script src="https://cdn.tailwindcss.com"></script>
