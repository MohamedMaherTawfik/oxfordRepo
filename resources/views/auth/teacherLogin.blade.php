<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('messages.teacher_register') ?? 'تسجيل المعلم' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        
        [dir="rtl"] .ml-2 {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }
        
        [dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#79131d] via-[#5a0f16] to-[#79131d] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 md:p-12 space-y-8 border border-white/20">
        <!-- Header -->
        <div class="text-center space-y-4">
            <div class="inline-block p-4 bg-[#79131d]/10 rounded-full">
                <i class="fas fa-chalkboard-teacher text-4xl text-[#79131d]"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-900">{{ __('messages.teacher_register') ?? 'تسجيل المعلم' }}</h2>
            <p class="text-gray-600">{{ __('messages.teacher_register_desc') ?? 'انضم إلينا كمعلم وشارك معرفتك' }}</p>
        </div>

        <form class="space-y-6" action="{{ route('teacher') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                        {{ __('messages.phone') ?? 'الهاتف' }}
                    </label>
                    <div class="relative">
                        <input type="text" name="phone" placeholder="{{ __('messages.phone_placeholder') ?? '05xxxxxxxx' }}"
                            class="w-full px-4 py-3 pl-12 border-2 border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200">
                        <i class="fas fa-phone absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('phone')
                        <span class="text-red-500 text-sm flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Topic -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-book {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                        {{ __('messages.topic') ?? 'التخصص' }}
                    </label>
                    <div class="relative">
                        <input type="text" name="topic" placeholder="{{ __('messages.topic_placeholder') ?? 'مثال: البرمجة' }}"
                            class="w-full px-4 py-3 pl-12 border-2 border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200">
                        <i class="fas fa-book absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('topic')
                        <span class="text-red-500 text-sm flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Files Upload -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-file-upload text-[#79131d]"></i>
                    {{ __('messages.upload_documents') ?? 'رفع المستندات' }}
                </h3>
                
                <!-- CV -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-pdf {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                        {{ __('messages.upload_cv') ?? 'رفع السيرة الذاتية' }}
                    </label>
                    <div class="relative">
                        <input type="file" name="cv" accept=".pdf,.doc,.docx"
                            class="block w-full text-sm text-gray-700 file:{{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }} file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#79131d] file:text-white hover:file:bg-[#5a0f16] file:transition file:cursor-pointer border-2 border-gray-300 rounded-xl p-2 bg-gray-50">
                    </div>
                    @error('cv')
                        <span class="text-red-500 text-sm flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Certificate -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-certificate {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                        {{ __('messages.upload_certificate') ?? 'رفع الشهادة (إن وجدت)' }}
                    </label>
                    <div class="relative">
                        <input type="file" name="certificate" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                            class="block w-full text-sm text-gray-700 file:{{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }} file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#79131d] file:text-white hover:file:bg-[#5a0f16] file:transition file:cursor-pointer border-2 border-gray-300 rounded-xl p-2 bg-gray-50">
                    </div>
                    @error('certificate')
                        <span class="text-red-500 text-sm flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-[#79131d] to-[#5a0f16] hover:from-[#5a0f16] hover:to-[#79131d] text-white font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i>
                    {{ __('messages.submit_application') ?? 'إرسال الطلب' }}
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                </button>
            </div>
        </form>

        <!-- Info Box -->
        <div class="bg-[#79131d]/10 border border-[#79131d]/20 rounded-xl p-4 flex items-start gap-3 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
            <i class="fas fa-info-circle text-[#79131d] mt-1"></i>
            <p class="text-sm text-gray-700 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                {{ __('messages.teacher_register_info') ?? 'سيتم مراجعة طلبك والرد عليك في أقرب وقت ممكن' }}
            </p>
        </div>
    </div>

</body>

</html>
