<x-teacher-panel>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow relative z-50">
        <h2 class="text-xl font-semibold mb-4">
            {{ __('teacher.assign_certificate_to') }} {{ $user->name }}
        </h2>

        <form
            action="{{ route('teacherDashboard.certificatesUser.store', ['slug' => $course->slug, 'user_id' => $user->id]) }}"
            method="POST">
            @csrf

            <!-- Dropdown + Button side by side -->
            <div class="mb-4">
                <label for="certificate" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('teacher.certificate') }}
                </label>

                <div class="flex gap-4 items-center">
                    <select id="certificate" name="certificate" required
                        class="flex-1 border border-black rounded-md shadow-sm focus:border-black focus:ring-black px-3 py-2">
                        @foreach ($certificates as $certificate)
                            <option value="{{ $certificate->id }}">{{ $certificate->certificate }}</option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="px-4 py-2 bg-[#79131d] text-white rounded-md hover:bg-[#5e1017] transition whitespace-nowrap">
                        {{ __('teacher.assign') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

</x-teacher-panel>
