<x-panel>

    <form class="md-5 px-5" action="{{ route('diplomas.update', $diploma->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.name') }}</label>
            <input type="text" name="name" value="{{ $diploma->name }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.category') }}</label>
            <select name="diplomas_categorey_id" class="w-full border p-2 rounded">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $cat->id == $diploma->diplomas_categorey_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.price') }}</label>
            <input type="number" name="price" value="{{ $diploma->price }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.description') }}</label>
            <textarea name="description" rows="5" class="w-full border p-2 rounded">{{ $diploma->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.duration_hours') }}</label>
            <input type="number" name="duration" class="w-full border p-2 rounded" min="0"
                value="{{ $diploma->duration ?? 0 }}">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.start_date') }}</label>
            <input type="date" name="start_date" class="w-full border p-2 rounded"
                value="{{ $diploma->start_date ?? now()->format('Y-m-d') }}">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.image') }}</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
            @if ($diploma->image)
                <img src="{{ asset('storage/' . $diploma->image) }}" class="w-24 h-24 object-cover mt-2 rounded">
            @endif
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">{{ __('main.update') }}</button>

    </form>

</x-panel>
