<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">رفع صور تسجيل الدخول والتسجيل</h1>
                <p class="text-gray-600">قم برفع الصور التي ستظهر في صفحات تسجيل الدخول والتسجيل</p>
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
                                {{ __('main.first_image') }} (تسجيل الدخول)
                            </label>
                            <div class="relative">
                                <input type="file" name="login" id="login" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#79131d] file:text-white hover:file:bg-[#5a0f16] transition-colors cursor-pointer"
                                    onchange="previewImage(this, 'loginPreview')">
                                <p class="mt-2 text-xs text-gray-500">الصيغ المدعومة: JPG, PNG, WEBP (حد أقصى 2MB)</p>
                            </div>
                        </div>

                        @php
                            $default = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMwAAADACAMAAAB/Pny7AAAAKlBMVEXMzMzy8vL19fXS0tLh4eHZ2dnr6+vv7+/JycnPz8/k5OTc3NzV1dXo6Og1EEG5AAAFxklEQVR4nO2b2XajMAxAjXfZ5v9/d7wRjAMpBCKSOboPnbbpFN/IktcyRhAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRBfj43c3YaLsEwE78Pv61gLyrvRcK7F3W05RexaIokMnA8R95OhgfQhhUQ+RBL67na9ibVCamOGBSbc3azDpMLlY0SakEz4H+tnOSSzR/6Xxy9L0tzdut2kRAE/dgHhg3EKgi5JA3c3cicglDO8NYmfmlGKNFxaltPHqB/oZyBC7lu8E1FsGvety6/5e9v5B7GtQqV07yPivGBNGKz/9qSxScTptnPFz4x2PgDrOhTkV791EmAhNIP7ZBJFlOhF8o8bnpMGv6F/EFM6ZvtyKInRSUkitupVThrDvyxpYkoHWUX45BFnkS6LbFYrq9IPc/c9xTmFJI4ki3EkhcS1EQHIk4A+Zyz/pqSJE8fgSv1t81371L626Ra8NqNfxgBsrnj8O5Im1FkKr9U357MLdSRpWm597oG8n1bKHBqJ2eaOPEcBkWcpi7JldHzvV5fCcvqhzkZkmfHOpIGgnOaLaUoSkWEr18Nj3t83vPzfu5ImTrdkWu+2MTGpAK+HpCDnnx0WCWJL5Wi/hzRTs0mkmziWd3aU3ssXmMZ8bF/wI++/h1ANLIvrXaeHoReZq3EZW1Z5KtzdC+23EGbRabq1JXIxn94VSF17OQX+JB+WgYWJGc306XbPOszjAeazLlbUR8VHjnFwF3rS0pdhImXs/axMnFeVsX0Yy0y+yHBnrwVKaftwZOpwwDWUQlMjc3nVyWPr52XqXL1+WWT05TL5935cplSAx1SkPvSMzOpxRsCRsaUD1DlUicwJmbxRoETnY7Fkcm5Oc6jTMsKZNDXt18tI3YyVpJEwP/R9GatqEe7PM7Bk6q7QJTLwGH65XPwOrALAdF5Iivmhb8tYyecxeLG6wYpMXeCq+aHvyzQnNMvlP5pMKMU5r5nPycDQyCyyBk1GlC378zLA2hmyv0WGufxOisdD35dp153qHhlfivM80Xw7Z3wz3b+nADBVivN5GfYIDY+BaW3wZPKTDL9AxoZp0Ox2//BkWD7nykmzIbP/Jkw6rx2Gsd+IQZTxw5Q0qzIgpNt/pg8hPJ90IMqotD2TJ/6rMnEuemibaCWOiDJCp8MXDrAqY3PgBnlmkYMoU5MmvvlrMnEBn2ZvcY7wPogythTncVUmnVmUaqvfvwyDKRPqjGZNJvXBOniUA9eS3cfOKjC7GZQt+2BXZHy7yylbB+V3hwpTpp5MyBUZ0V68iokjptfS4sXInQHClCkFKybNs4zsNvpNvXtp88rBjPuCgxqZugyAJxlhur10bspmRT1MisHZc4iEKsPywwbVyYCV/bkAL1diagFMH+aetw2qjHU1v7vIiGGNMdjQppL/c+6GK6NKK7vI1E215+CkvfbmpfGrZBjk3NAqt/4hI9ZcJqHFa3nqtl3acGXYmC+OyTYyYM3zLdINtXxN5ltkrMzv9NjK1L6308aoF2MOskzIjSp3k6dupvfFZfJx2zcYkLsZa8pTlfEHVIY8E9086UeWaQtXkYll+uDhc1z6w3pdw5ZRnYyV263eDs64viLF7mbQycChjHnYmNXgYMvYuVMlGavMi0ZvuaQPeuXPgNBlxqXMG71s4vnKHLYMC48RMncz9/7Vk+e7megybBGZMzLD0815dBmrr5NJS9J7ZfxV3az8kvZCLX43C0uZcy6RZk8XXwamYnxJZOYV9i0ybCrOWUaZC26aueU1FkwZ38qw8Oqi6U78fTKh7WYJOMn0iy26DFio+0o/e0WrBaaNpR2bR4eom4yo1YzVZQAfFIgr8QZdprnZf76QdWXtBhmYZ85X3nCeztNxZfpt8mvBljm4h3FQ5voq+RJwl6fLDPpfOkLw6lME+z1/HEgQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEH8D/wDnXg4+PJhj2oAAAAASUVORK5CYII=';
                            $imagePath = $home->login ? storage_path('app/public/' . $home->login) : null;
                            $imageUrl = $home->login && file_exists($imagePath) ? asset('storage/' . $home->login) : $default;
                        @endphp

                        <div class="relative group">
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 bg-gray-50 hover:border-[#79131d] transition-colors">
                                <img id="loginPreview" src="{{ $imageUrl }}" alt="{{ __('main.current_photo') }}"
                                    class="w-full h-64 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold">معاينة الصورة</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Image (Register) -->
                    <div class="space-y-4">
                        <div>
                            <label for="register" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user-plus mr-2 text-[#79131d]"></i>
                                {{ __('main.second_image') }} (التسجيل)
                            </label>
                            <div class="relative">
                                <input type="file" name="register" id="register" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#79131d] file:text-white hover:file:bg-[#5a0f16] transition-colors cursor-pointer"
                                    onchange="previewImage(this, 'registerPreview')">
                                <p class="mt-2 text-xs text-gray-500">الصيغ المدعومة: JPG, PNG, WEBP (حد أقصى 2MB)</p>
                            </div>
                        </div>

                        @php
                            $imagePath = $home->register ? storage_path('app/public/' . $home->register) : null;
                            $imageUrl = $home->register && file_exists($imagePath) ? asset('storage/' . $home->register) : $default;
                        @endphp

                        <div class="relative group">
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 bg-gray-50 hover:border-[#79131d] transition-colors">
                                <img id="registerPreview" src="{{ $imageUrl }}" alt="{{ __('main.current_photo') }}"
                                    class="w-full h-64 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold">معاينة الصورة</span>
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
