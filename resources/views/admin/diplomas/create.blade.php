<x-panel>

    <h1 class="text-2xl font-bold mb-4">{{ __('main.create_diploma') }}</h1>

    <form class="py-4 px-4" action="{{ route('diplomas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.name') }}</label>
            <input type="text" name="name" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.category') }}</label>
            <select name="diplomas_categorey_id" class="w-full border p-2 rounded">
                <option disabled selected>{{ __('main.choose_category') }}</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.price') }}</label>
            <input type="number" name="price" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.description') }}</label>
            <textarea name="description" rows="5" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.duration_hours') }}</label>
            <input type="number" name="duration" class="w-full border p-2 rounded" min="0">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.start_date') }}</label>
            <input type="date" name="start_date" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">{{ __('main.image') }}</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <button class="px-4 py-2 bg-green-600 text-white rounded">{{ __('main.create') }}</button>

    </form>

</x-panel>
