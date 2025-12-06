<x-teacher-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen" 
         dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                <i class="fas fa-life-ring text-[#79131d]"></i>
                {{ __('teacher.support_help') ?? 'المساعدة والدعم' }}
            </h1>
            <p class="text-gray-600">{{ __('teacher.contact_admin_for_support') ?? 'تواصل مع الإدارة للحصول على المساعدة' }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Contact Information Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-address-card text-[#79131d]"></i>
                        {{ __('teacher.contact_information') ?? 'معلومات التواصل' }}
                    </h2>

                    <div class="space-y-4">
                        @if($footer && $footer->phone)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="w-10 h-10 bg-[#79131d]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-[#79131d]"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">{{ __('teacher.phone') ?? 'الهاتف' }}</p>
                                    <a href="tel:{{ $footer->phone }}" class="text-gray-900 font-semibold hover:text-[#79131d] transition">
                                        {{ $footer->phone }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($footer && $footer->email)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="w-10 h-10 bg-[#79131d]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-[#79131d]"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">{{ __('teacher.email') ?? 'البريد الإلكتروني' }}</p>
                                    <a href="mailto:{{ $footer->email }}" class="text-gray-900 font-semibold hover:text-[#79131d] transition break-all">
                                        {{ $footer->email }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($footer && $footer->address)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="w-10 h-10 bg-[#79131d]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-[#79131d]"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-500 mb-1">{{ __('teacher.address') ?? 'العنوان' }}</p>
                                    <p class="text-gray-900 font-semibold">{{ $footer->address }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Social Media -->
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm font-semibold text-gray-700 mb-3">{{ __('teacher.follow_us') ?? 'تابعنا على' }}</p>
                            <div class="flex gap-3">
                                @if($footer && $footer->whatsapp)
                                    <a href="{{ $footer->whatsapp }}" target="_blank"
                                        class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center hover:bg-green-600 transition">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                @endif
                                @if($footer && $footer->telegram)
                                    <a href="{{ $footer->telegram }}" target="_blank"
                                        class="w-10 h-10 bg-blue-500 text-white rounded-lg flex items-center justify-center hover:bg-blue-600 transition">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                @endif
                                @if($footer && $footer->facebook)
                                    <a href="{{ $footer->facebook }}" target="_blank"
                                        class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                @endif
                                @if($footer && $footer->instgram)
                                    <a href="{{ $footer->instgram }}" target="_blank"
                                        class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg flex items-center justify-center hover:opacity-90 transition">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Form and History -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Send Message Form -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-paper-plane text-[#79131d]"></i>
                        {{ __('teacher.send_message') ?? 'إرسال رسالة' }}
                    </h2>

                    <form action="{{ route('teacher.support.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('teacher.subject') ?? 'الموضوع' }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   value="{{ old('subject') }}"
                                   required
                                   placeholder="{{ __('teacher.enter_subject') ?? 'أدخل موضوع الرسالة' }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('teacher.message') ?? 'الرسالة' }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="6"
                                      required
                                      placeholder="{{ __('teacher.enter_message') ?? 'أدخل رسالتك هنا...' }}"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">{{ __('teacher.message_min_characters') ?? 'الحد الأدنى 10 أحرف' }}</p>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 font-semibold">
                                <i class="fas fa-paper-plane mr-2"></i>
                                {{ __('teacher.send') ?? 'إرسال' }}
                            </button>
                            <button type="reset"
                                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-semibold">
                                <i class="fas fa-redo mr-2"></i>
                                {{ __('teacher.reset') ?? 'إعادة تعيين' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Messages History -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-history text-[#79131d]"></i>
                        {{ __('teacher.message_history') ?? 'سجل الرسائل' }}
                    </h2>

                    @if($messages->count() > 0)
                        <div class="space-y-4">
                            @foreach($messages as $message)
                                <div class="border-2 rounded-lg p-4 hover:shadow-md transition {{ $message->status === 'pending' ? 'border-yellow-200 bg-yellow-50' : ($message->status === 'replied' ? 'border-green-200 bg-green-50' : 'border-gray-200') }}">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <h3 class="font-bold text-gray-900 mb-1">{{ $message->subject }}</h3>
                                            <p class="text-sm text-gray-500">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ $message->created_at->format('Y-m-d H:i') }}
                                            </p>
                                        </div>
                                        <div>
                                            @if($message->status === 'pending')
                                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-lg text-xs font-semibold">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    {{ __('teacher.pending') ?? 'قيد الانتظار' }}
                                                </span>
                                            @elseif($message->status === 'read')
                                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-xs font-semibold">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    {{ __('teacher.read') ?? 'تم القراءة' }}
                                                </span>
                                            @elseif($message->status === 'replied')
                                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-xs font-semibold">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    {{ __('teacher.replied') ?? 'تم الرد' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
                                    </div>

                                    @if($message->admin_reply)
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <div class="flex items-start gap-3">
                                                <div class="w-8 h-8 bg-[#79131d] rounded-full flex items-center justify-center flex-shrink-0">
                                                    <i class="fas fa-user-shield text-white text-xs"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-semibold text-gray-900 mb-1">
                                                        {{ __('teacher.admin_reply') ?? 'رد الإدارة' }}
                                                    </p>
                                                    <p class="text-gray-700 whitespace-pre-wrap">{{ $message->admin_reply }}</p>
                                                    @if($message->replied_at)
                                                        <p class="text-xs text-gray-500 mt-2">
                                                            <i class="far fa-clock mr-1"></i>
                                                            {{ $message->replied_at->format('Y-m-d H:i') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="inline-block p-6 bg-gray-100 rounded-full mb-4">
                                <i class="fas fa-inbox text-6xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-500">{{ __('teacher.no_messages_yet') ?? 'لا توجد رسائل بعد' }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-teacher-panel>

