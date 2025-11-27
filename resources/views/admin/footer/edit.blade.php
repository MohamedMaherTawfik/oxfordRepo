<x-panel>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-center mb-6">إضافة بيانات الفوتر</h2>

            <form action="{{ route('admin.footers.update') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- WhatsApp -->
                    <div>
                        <label class="block text-gray-700">WhatsApp</label>
                        <input type="text" value="{{ $footer->whatsapp }}" name="whatsapp"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- Telegram -->
                    <div>
                        <label class="block text-gray-700">Telegram</label>
                        <input type="text" value="{{ $footer->telegram }}" name="telegram"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- Facebook -->
                    <div>
                        <label class="block text-gray-700">Facebook</label>
                        <input type="text" name="facebook" value="{{ $footer->facebook }}"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label class="block text-gray-700">Instagram</label>
                        <input type="text" name="instgram" value="{{ $footer->instgram }}"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- X (Twitter سابقاً) -->
                    <div>
                        <label class="block text-gray-700">X</label>
                        <input type="text" name="x" value="{{ $footer->x }}"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700">Email</label>
                        <input type="email" value="{{ $footer->email }}" name="email"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-gray-700">Address</label>
                        <input type="text" value="{{ $footer->address }}" name="address"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-gray-700">Phone</label>
                        <input type="text" value="{{ $footer->phone }}" name="phone"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- Google Play -->
                    <div>
                        <label class="block text-gray-700">Google Play</label>
                        <input type="text" value="{{ $footer->google_play }}" name="google_play"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <!-- App Store -->
                    <div>
                        <label class="block text-gray-700">App Store</label>
                        <input type="text" value="{{ $footer->app_store }}" name="app_store"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-6 py-2 rounded-lg">
                        حفظ البيانات
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-panel>
