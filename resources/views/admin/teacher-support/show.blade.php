<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen" 
         dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.teacher-support.index') }}" 
               class="inline-flex items-center gap-2 text-[#79131d] hover:text-[#5a0f16] mb-4 transition">
                <i class="fas fa-arrow-right"></i>
                <span>{{ __('main.back_to_list') }}</span>
            </a>
            <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                <i class="fas fa-envelope-open text-[#79131d]"></i>
                {{ __('main.message_details') }}
            </h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Message Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Teacher Info -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-user text-[#79131d]"></i>
                        {{ __('main.teacher_info') }}
                    </h2>
                    <div class="flex items-center gap-4">
                        <img class="h-16 w-16 rounded-full object-cover border-2 border-[#79131d]" 
                             src="{{ $message->teacher->photo ? asset('storage/' . $message->teacher->photo) : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png' }}" 
                             alt="{{ $message->teacher->name }}">
                        <div>
                            <p class="text-lg font-bold text-gray-900">{{ $message->teacher->name }}</p>
                            <p class="text-sm text-gray-500">{{ $message->teacher->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Message Content -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-comment text-[#79131d]"></i>
                            {{ __('main.message') }}
                        </h2>
                        <div>
                            @if($message->status === 'pending')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ __('main.pending') }}
                                </span>
                            @elseif($message->status === 'read')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ __('main.read') }}
                                </span>
                            @elseif($message->status === 'replied')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ __('main.replied') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-2">{{ __('main.subject') }}:</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $message->subject }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-2">{{ __('main.message_content') }}:</p>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
                        </div>
                    </div>

                    <div class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ __('main.sent_at') }}: {{ $message->created_at->format('Y-m-d H:i') }}
                    </div>
                </div>

                <!-- Admin Reply -->
                @if($message->admin_reply)
                    <div class="bg-green-50 border-l-4 border-green-500 rounded-xl shadow-lg p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <i class="fas fa-reply text-green-600"></i>
                            <h3 class="text-lg font-bold text-gray-900">{{ __('main.admin_reply') }}</h3>
                        </div>
                        <div class="bg-white rounded-lg p-4 mb-4">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $message->admin_reply }}</p>
                        </div>
                        <div class="text-sm text-gray-500">
                            <i class="far fa-clock mr-1"></i>
                            تم الرد: {{ $message->replied_at->format('Y-m-d H:i') }}
                            @if($message->repliedBy)
                                بواسطة: {{ $message->repliedBy->name }}
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Reply Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-reply text-[#79131d]"></i>
                        {{ __('main.reply_to_message') }}
                    </h2>

                    @if(!$message->admin_reply)
                        <form action="{{ route('admin.teacher-support.reply', $message) }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label for="admin_reply" class="block text-sm font-semibold text-gray-700 mb-2">
                                    {{ __('main.reply') }} <span class="text-red-500">*</span>
                                </label>
                                <textarea id="admin_reply" 
                                          name="admin_reply" 
                                          rows="8"
                                          required
                                          placeholder="{{ __('main.enter_reply') }}"
                                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition">{{ old('admin_reply') }}</textarea>
                                @error('admin_reply')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">{{ __('main.minimum_characters') }}</p>
                            </div>

                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 font-semibold">
                                <i class="fas fa-paper-plane mr-2"></i>
                                {{ __('main.send_reply') }}
                            </button>
                        </form>
                    @else
                        <div class="text-center py-8">
                            <div class="inline-block p-4 bg-green-100 rounded-full mb-4">
                                <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                            </div>
                            <p class="text-gray-700 font-semibold mb-2">تم الرد على هذه الرسالة</p>
                            <p class="text-sm text-gray-500">يمكنك تعديل الرد من خلال تحديث الرسالة</p>
                        </div>
                    @endif

                    <!-- Mark as Read Button -->
                    @if($message->status === 'pending')
                        <form action="{{ route('admin.teacher-support.markAsRead', $message) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit"
                                    class="w-full bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition font-semibold">
                                <i class="fas fa-eye mr-2"></i>
                                {{ __('main.mark_as_read') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-panel>

