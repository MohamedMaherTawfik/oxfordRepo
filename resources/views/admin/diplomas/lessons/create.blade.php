<x-panel>

    <div class="min-h-screen flex items-center justify-center">

        <form action="{{ route('diplomas.store.lesson', $diploma->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-8 shadow-lg rounded-xl w-full max-w-xl">
            @csrf

            <h1 class="text-2xl font-bold mb-6 text-center">
                {{ __('main.add_lesson_to') }}: {{ $diploma->name }}
            </h1>

            <div class="mb-4">
                <label class="font-semibold block mb-1">{{ __('main.title') }}</label>
                <input type="text" name="title" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="font-semibold block mb-1">{{ __('main.description') }}</label>
                <textarea name="description" rows="4" class="w-full p-2 border rounded"></textarea>
            </div>

            <div class="mb-4">
                <label class="font-semibold block mb-1">{{ __('main.video') }}</label>
                <input type="file" name="video_url" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="font-semibold block mb-1">{{ __('main.image') }}</label>
                <input type="file" name="image" class="w-full p-2 border rounded">
            </div>

            <button
                class="w-[20%] px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 block mx-auto text-center">
                {{ __('main.save') }}
            </button>

        </form>

    </div>

</x-panel>
