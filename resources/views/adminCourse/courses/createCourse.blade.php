<?php #
use App\Models\categories;
$categories = categories::all(); ?>

<x-panel>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-md">
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            {{ __('teacher.title') }}</label>
                        <input type="text" id="title" name="title"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700">
                            {{ __('teacher.duration') }} ( {{ __('messages.hours') }})</label>
                        <input type="number" id="duration" name="duration" min="1"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('duration')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700"> {{ __('teacher.price') }}
                            ({{ __('messages.riyal') }})</label>
                        <input type="number" id="price" name="price" min="0" step="0.01"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Level -->
                    <div>
                        <label for="level"
                            class="block text-sm font-medium text-gray-700">{{ __('messages.level') }}</label>
                        <select id="level" name="level"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">{{ __('messages.select_level') }}</option>
                            <option value="Beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>
                                {{ __('messages.Beginner') }}
                            </option>
                            <option value="Mid" {{ old('level') == 'Mid' ? 'selected' : '' }}>
                                {{ __('messages.mid') }}</option>
                            <option value="Advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>
                                {{ __('messages.advanced') }}
                            </option>
                        </select>
                        @error('level')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Category Dropdown -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">
                            {{ __('teacher.category') }}</label>
                        <select id="category_id" name="category_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#79131d] focus:border-[#79131d]">
                            <option value="" disabled selected> {{ __('teacher.select_category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">
                            {{ __('teacher.start_date') }}</label>
                        <input type="date" id="start_date" name="start_date"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('start_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description (full width) -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            {{ __('teacher.what_you_learn') }}</label>
                        <textarea id="description" name="description"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 h-32"></textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Upload (full width) -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            {{ __('teacher.image') }}</label>
                        <input type="file" id="image" name="cover_photo" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('cover_photo')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button (full width) -->
                    <div class="md:col-span-2">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('teacher.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-panel>
