<x-panel>
    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-yellow-100 border border-yellow-400 text-yellow-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <form action="{{ route('admin.course.update', $course) }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-8 rounded shadow-lg w-full max-w-4xl">
            @csrf

            <!-- User -->
            <div>
                <label for="user_id" class="block mb-2 font-medium">{{ __('main.user') }}</label>
                <p class="w-full border p-2 rounded bg-gray-100">
                    {{ $course->user->name }}
                </p>
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block mb-2 font-medium">{{ __('main.category') }}</label>
                <p class="w-full border p-2 rounded bg-gray-100">
                    {{ $course->category->name }}
                </p>
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block mb-2 font-medium">{{ __('main.title') }}</label>
                <input type="text" name="title" id="title" value="{{ $course->title }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label for="description" class="block mb-2 font-medium">{{ __('main.description') }}</label>
                <textarea name="description" id="description" rows="4" class="w-full border p-2 rounded">{{ $course->description }}</textarea>
            </div>

            <!-- Start Date -->
            <div>
                <label for="start_Date" class="block mb-2 font-medium">{{ __('main.start_date') }}</label>
                <input type="date" name="start_Date" id="start_Date" value="{{ $course->start_Date }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Duration -->
            <div>
                <label for="duration" class="block mb-2 font-medium">{{ __('main.duration_hours') }}</label>
                <input type="number" name="duration" id="duration" value="{{ $course->duration }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Cover Photo -->
            <div class="md:col-span-2">
                <label for="cover_photo" class="block mb-2 font-medium">{{ __('main.cover_photo') }}</label>
                <input type="file" name="cover_photo" id="cover_photo" class="w-full border p-2 rounded">
            </div>

            <!-- Teacher Price -->
            <div>
                <label for="teacher_price" class="block mb-2 font-medium">{{ __('main.teacher_price') }}</label>
                <input type="number" step="0.01" name="price" id="teacher_price" value="{{ $course->price }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Admin Price -->
            <div>
                <label for="admin_price" class="block mb-2 font-medium">{{ __('main.admin_price') }}</label>
                <input type="number" step="0.01" name="admin_price" id="admin_price"
                    value="{{ $course->admin_price }}" class="w-full border p-2 rounded">
            </div>

            <!-- Level -->
            <div>
                <label for="level" class="block mb-2 font-medium">{{ __('main.level') }}</label>
                <select name="level" id="level" class="w-full border p-2 rounded">
                    <option value="Beginner" {{ $course->level == 'Beginner' ? 'selected' : '' }}>
                        {{ __('main.levels.beginner') }}
                    </option>
                    <option value="Intermediate" {{ $course->level == 'Intermediate' ? 'selected' : '' }}>
                        {{ __('main.levels.intermediate') }}
                    </option>
                    <option value="Advanced" {{ $course->level == 'Advanced' ? 'selected' : '' }}>
                        {{ __('main.levels.advanced') }}
                    </option>
                </select>
            </div>

            <!-- Submit -->
            <div class="md:col-span-2 flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                    {{ __('main.save_course') }}
                </button>
            </div>
        </form>
    </div>
</x-panel>
