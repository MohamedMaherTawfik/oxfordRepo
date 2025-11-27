    @php
        use App\Models\categories;
        $categories = categories::all();
    @endphp

    <x-teacher-panel>

        <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-md">

                <h1 class="text-2xl font-bold mb-6 text-center text-[#79131d]">{{ __('teacher.create_course') }}</h1>

                <form method="POST" action="{{ route('teacher.courses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Title -->
                        <div>
                            <label for="title"
                                class="block text-sm font-medium text-gray-700">{{ __('teacher.title') }}</label>
                            <input type="text" id="title" name="title"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div>
                            <label for="duration"
                                class="block text-sm font-medium text-gray-700">{{ __('teacher.duration') }}</label>
                            <input type="number" id="duration" name="duration" min="1"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                            @error('duration')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price"
                                class="block text-sm font-medium text-gray-700">{{ __('teacher.price') }}</label>
                            <input type="number" id="price" name="price" min="0" step="0.01"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                            @error('price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Level -->
                        <div>
                            <label for="level"
                                class="block text-sm font-medium text-gray-700">{{ __('teacher.level') }}</label>
                            <select id="level" name="level"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                                <option value="">{{ __('teacher.select_level') }}</option>
                                <option value="Beginner">{{ __('teacher.beginner') }}</option>
                                <option value="Mid">{{ __('teacher.mid') }}</option>
                                <option value="Advanced">{{ __('teacher.advanced') }}</option>
                            </select>
                            @error('level')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id"
                                class="block text-sm font-medium text-gray-700">{{ __('teacher.category') }}</label>
                            <select id="category_id" name="category_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                                <option value="" disabled selected>{{ __('teacher.select_category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date"
                                class="block text-sm font-medium text-gray-700">{{ __('teacher.start_date') }}</label>
                            <input type="date" id="start_date" name="start_date"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                            @error('start_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description (full width) -->
                        <div class="md:col-span-2">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700">{{ __('teacher.what_you_learn') }}</label>
                            <textarea id="description" name="description" rows="4"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]"></textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Upload (full width) -->
                        <div class="md:col-span-2">
                            <label for="image"
                                class="block text-sm font-medium text-gray-700">{{ __('teacher.image') }}</label>
                            <input type="file" id="image" name="cover_photo" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#79131d] file:text-white hover:file:bg-[#5e1017]">
                            @error('cover_photo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button (full width) -->
                        <div class="md:col-span-2">
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#79131d] hover:bg-[#5e1017] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#79131d]">
                                {{ __('teacher.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </x-teacher-panel>
