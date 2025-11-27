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

    <div class="container mx-auto py-10">
        <h2 class="text-2xl font-bold text-center mb-6">عرض بيانات الفوتر</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($footers as $footer)
                <div class="bg-white shadow-md rounded-lg p-6 space-y-4">

                    {{-- WhatsApp --}}
                    @if ($footer->whatsapp)
                        <div class="flex items-center space-x-3">
                            <i class="fab fa-whatsapp text-green-500 text-xl"></i>
                            <span class="text-gray-700">{{ $footer->whatsapp }}</span>
                        </div>
                    @endif

                    {{-- Telegram --}}
                    @if ($footer->telegram)
                        <div class="flex items-center space-x-3">
                            <i class="fab fa-telegram text-sky-500 text-xl"></i>
                            <span class="text-gray-700">{{ $footer->telegram }}</span>
                        </div>
                    @endif

                    {{-- Facebook --}}
                    @if ($footer->facebook)
                        <div class="flex items-center space-x-3">
                            <i class="fab fa-facebook text-blue-600 text-xl"></i>
                            <span class="text-gray-700">{{ $footer->facebook }}</span>
                        </div>
                    @endif

                    {{-- Instagram --}}
                    @if ($footer->instgram)
                        <div class="flex items-center space-x-3">
                            <i class="fab fa-instagram text-pink-500 text-xl"></i>
                            <span class="text-gray-700">{{ $footer->instgram }}</span>
                        </div>
                    @endif

                    {{-- X (Twitter سابقاً) --}}
                    @if ($footer->x)
                        <div class="flex items-center space-x-3">
                            <i class="fab fa-x-twitter text-black text-xl"></i>
                            <span class="text-gray-700">{{ $footer->x }}</span>
                        </div>
                    @endif

                    {{-- Email --}}
                    @if ($footer->email)
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-red-500 text-xl"></i>
                            <span class="text-gray-700">{{ $footer->email }}</span>
                        </div>
                    @endif

                    {{-- Address --}}
                    @if ($footer->address)
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-yellow-500 text-xl"></i>
                            <span class="text-gray-700">{{ $footer->address }}</span>
                        </div>
                    @endif

                    {{-- Phone --}}
                    @if ($footer->phone)
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-green-700 text-xl"></i>
                            <span class="text-gray-700">{{ $footer->phone }}</span>
                        </div>
                    @endif

                    {{-- Google Play --}}
                    @if ($footer->google_play)
                        <div class="flex items-center space-x-3">
                            <i class="fab fa-google-play text-green-600 text-xl"></i>
                            <span class="text-gray-700">{{ $footer->google_play }}</span>
                        </div>
                    @endif

                    {{-- App Store --}}
                    @if ($footer->app_store)
                        <div class="flex items-center space-x-3">
                            <i class="fa-brands fa-app-store-ios text-xl"></i>
                            <span class="text-gray-700">{{ $footer->app_store }}</span>
                        </div>
                    @endif
                    <a href="{{ route('admin.footers.edit') }}"
                        class="inline-block text-right bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                        تعديل
                    </a>
                </div>
            @endforeach
        </div>
    </div>



</x-panel>
