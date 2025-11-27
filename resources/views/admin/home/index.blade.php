<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('main.login_register_images') }}</h1>
                <p class="text-gray-600">{{ __('main.upload_images_description') }}</p>
            </div>

            <form action="{{ route('admin.home.upload') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-xl shadow-lg p-8 space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- First Image (Login) -->
                    <div class="space-y-4">
                        <div>
                            <label for="login" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-sign-in-alt mr-2 text-[#79131d]"></i>
                                {{ __('main.first_image') }} ({{ __('main.login') }})
                            </label>
                            <div class="relative">
                                <input type="file" name="login" id="login" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#79131d] file:text-white hover:file:bg-[#5a0f16] transition-colors cursor-pointer"
                                    onchange="previewImage(this, 'loginPreview')">
                                <p class="mt-2 text-xs text-gray-500">{{ __('main.supported_formats') }}</p>
                            </div>
                        </div>

                        @php
                            $default = 'data:image/png;base64,...'; // اختصرنا الباس64 هنا
                            $imagePath = $home->login ? storage_path('app/public/' . $home->login) : null;
                            $imageUrl =
                                $home->login && file_exists($imagePath) ? asset('storage/' . $home->login) : $default;
                        @endphp

                        <div class="relative group">
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-xl p-4 bg-gray-50 hover:border-[#79131d] transition-colors">
                                <img id="loginPreview" src="{{ $imageUrl }}" alt="{{ __('main.current_photo') }}"
                                    class="w-full h-64 object-cover rounded-lg">
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold">{{ __('main.preview_image') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Image (Register) -->
                    <div class="space-y-4">
                        <div>
                            <label for="register" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user-plus mr-2 text-[#79131d]"></i>
                                {{ __('main.second_image') }} ({{ __('main.register') }})
                            </label>
                            <div class="relative">
                                <input type="file" name="register" id="register" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#79131d] file:text-white hover:file:bg-[#5a0f16] transition-colors cursor-pointer"
                                    onchange="previewImage(this, 'registerPreview')">
                                <p class="mt-2 text-xs text-gray-500">{{ __('main.supported_formats') }}</p>
                            </div>
                        </div>

                        @php
                            $imagePath = $home->register ? storage_path('app/public/' . $home->register) : null;
                            $imageUrl =
                                $home->register && file_exists($imagePath)
                                    ? asset('storage/' . $home->register)
                                    : $default;
                        @endphp

                        <div class="relative group">
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-xl p-4 bg-gray-50 hover:border-[#79131d] transition-colors">
                                <img id="registerPreview" src="{{ $imageUrl }}"
                                    alt="{{ __('main.current_photo') }}" class="w-full h-64 object-cover rounded-lg">
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold">{{ __('main.preview_image') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="flex items-center gap-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all font-semibold">
                        <i class="fas fa-upload"></i>
                        {{ __('main.upload') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-panel>
