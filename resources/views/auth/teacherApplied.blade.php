<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('messages.success') ?? 'نجاح' }}</title>
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
        
        @keyframes checkmark {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .checkmark-animation {
            animation: checkmark 0.6s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 via-white to-green-50 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-2xl rounded-3xl p-8 md:p-12 text-center max-w-md w-full border border-green-100">
        <!-- Success Icon -->
        <div class="mb-6">
            <div class="inline-block p-6 bg-green-100 rounded-full checkmark-animation">
                <i class="fas fa-check-circle text-6xl text-green-600"></i>
            </div>
        </div>
        
        <!-- Title -->
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            {{ __('messages.success') ?? 'تم بنجاح!' }}
        </h2>
        
        <!-- Message -->
        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
            {{ __('messages.application_submitted') ?? 'تم إرسال طلبك بنجاح. سيتم مراجعة طلبك والرد عليك في أقرب وقت ممكن.' }}
        </p>
        
        <!-- Action Button -->
        <a href="{{ route('home') }}"
            class="inline-flex items-center justify-center gap-2 w-full py-4 px-6 rounded-xl bg-gradient-to-r from-[#79131d] to-[#5a0f16] hover:from-[#5a0f16] hover:to-[#79131d] text-white font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300">
            <i class="fas fa-home"></i>
            {{ __('messages.go_to_home') ?? 'العودة للصفحة الرئيسية' }}
            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
        </a>
        
        <!-- Additional Info -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex items-center justify-center gap-2 text-gray-500 text-sm">
                <i class="fas fa-clock"></i>
                <span>{{ __('messages.response_time') ?? 'متوسط وقت الرد: 24-48 ساعة' }}</span>
            </div>
        </div>
    </div>
</body>

</html>
