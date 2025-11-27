<x-teacher-panel>
    @php
        $slug = request('slug');
    @endphp

    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-6">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-[#79131d] mb-8">
            {{ __('teacher.create_certificate') }}
        </h1>

        <div class="max-w-2xl w-full bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">
                {{ __('teacher.assign_certificate_to_student') }}
            </h2>

            <form
                action="{{ route('teacherDashboard.certificates.store', ['slug' => $slug, 'id' => Auth::user()->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Certificate Name -->
                <div class="mb-4">
                    <label for="certificate_name" class="block text-sm font-medium text-gray-700">
                        {{ __('teacher.certificate_name') }}
                    </label>
                    <input type="text" id="certificate_name" name="certificate"
                        class="mt-1 block w-full border border-black rounded-md shadow-sm focus:border-black focus:ring-black">
                </div>

                <!-- Certificate Description -->
                <div class="mb-4">
                    <label for="certificate_description" class="block text-sm font-medium text-gray-700">
                        {{ __('teacher.certificate_description') }}
                    </label>
                    <textarea id="certificate_description" name="description" rows="4"
                        class="mt-1 block w-full border border-black rounded-md shadow-sm focus:border-black focus:ring-black"></textarea>
                </div>

                <!-- Certificate File -->
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">
                        {{ __('teacher.upload_certificate_file') }}
                    </label>
                    <input type="file" id="file" name="file"
                        class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-[#79131d] file:text-white
                            hover:file:bg-[#5e1017] transition">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-[#79131d] text-white rounded-md hover:bg-[#5e1017] transition">
                        {{ __('teacher.create_certificate') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-teacher-panel>
