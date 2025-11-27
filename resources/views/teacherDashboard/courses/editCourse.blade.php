<x-teacher-panel>

    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-md">

            <h1 class="text-2xl font-bold mb-6 text-center text-[#79131d]">{{ __('teacher.update_course') }}</h1>

            <form method="POST" action="{{ route('teacher.courses.update', $course->slug) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Title -->
                    <div>
                        <label for="title"
                            class="block text-sm font-medium text-gray-700">{{ __('teacher.title') }}</label>
                        <input type="text" id="title" name="title" value="{{ $course->title ?? '' }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration"
                            class="block text-sm font-medium text-gray-700">{{ __('teacher.duration') }}</label>
                        <input type="text" id="duration" name="duration" value="{{ $course->duration ?? '' }}"
                            min="1"
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
                            value="{{ $course->price ?? '' }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date"
                            class="block text-sm font-medium text-gray-700">{{ __('teacher.start_date') }}</label>
                        <input type="text" id="start_date" name="start_date" value="{{ $course->start_Date ?? '' }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                        @error('start_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description (full width) -->
                    <div class="md:col-span-2">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700">{{ __('teacher.description') }}</label>
                        <textarea id="description" name="description"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]"
                            rows="4">{{ $course->description ?? '' }}</textarea>
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
                    <div class="md:col-span-2 flex justify-center">
                        <button type="submit"
                            class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#79131d] hover:bg-[#5e1017] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#79131d]">
                            {{ __('teacher.submit') }}
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</x-teacher-panel>
