<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen" 
         dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                <i class="fas fa-video text-[#79131d]"></i>
                {{ __('main.registration_video_settings') }}
            </h1>
            <p class="text-gray-600">{{ __('main.manage_registration_video') }}</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form action="{{ route('admin.registration-video.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- YouTube URL -->
                    <div>
                        <label for="youtube_url" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fab fa-youtube text-red-600 mr-2"></i>
                            {{ __('main.youtube_url') }}
                        </label>
                        <input type="url" 
                               id="youtube_url" 
                               name="youtube_url" 
                               value="{{ old('youtube_url', $setting->youtube_url) }}"
                               placeholder="https://www.youtube.com/watch?v=..."
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition">
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            أدخل رابط فيديو يوتيوب الكامل (مثال: https://www.youtube.com/watch?v=VIDEO_ID)
                        </p>
                        @error('youtube_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Enable/Disable -->
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                        <input type="checkbox" 
                               id="is_enabled" 
                               name="is_enabled" 
                               value="1"
                               {{ old('is_enabled', $setting->is_enabled) ? 'checked' : '' }}
                               class="w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                        <label for="is_enabled" class="text-sm font-semibold text-gray-700 cursor-pointer">
                            {{ __('main.enable_video') }}
                        </label>
                    </div>

                    <!-- Preview -->
                    @if($setting->youtube_url && $setting->youtube_id)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3">{{ __('main.video_preview') }}:</h3>
                            <div class="aspect-video rounded-lg overflow-hidden">
                                <iframe 
                                    width="100%" 
                                    height="100%" 
                                    src="{{ $setting->embed_url }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="flex gap-4">
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 font-semibold">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('main.save_changes') }}
                        </button>
                        <a href="{{ route('admin.index') }}"
                           class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('main.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-panel>

