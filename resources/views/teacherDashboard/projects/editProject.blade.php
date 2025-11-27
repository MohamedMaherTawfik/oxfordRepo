<x-teacher-panel>
    <div class="min-h-screen flex items-center justify-center">
        <form action="{{ route('teacher.project.update', $project->id) }}" method="POST" enctype="multipart/form-data"
            class="w-full max-w-md space-y-5">
            @csrf

            <!-- Title -->
            <div>
                <label for="title"
                    class="block text-sm font-medium text-gray-700 mb-1">{{ __('teacher.title') }}</label>
                <input type="text" name="title" id="title" value="{{ $project->title }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    required>
            </div>

            <!-- Description -->
            <div>
                <label for="description"
                    class="block text-sm font-medium text-gray-700 mb-1">{{ __('teacher.description') }}</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    required>{{ $project->description }}</textarea>
            </div>

            <!-- File Upload -->
            <div>
                <label for="file"
                    class="block text-sm font-medium text-gray-700 mb-1">{{ __('teacher.file') }}</label>
                <input type="file" name="file" id="file" value="{{ $project->file }}"
                    class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
                    {{ __('teacher.save_changes') }}
                </button>
            </div>
        </form>
    </div>
</x-teacher-panel>
