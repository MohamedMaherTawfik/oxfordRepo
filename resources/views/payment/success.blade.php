<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.payment_success') ?? 'Payment Success' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .success-animation {
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .checkmark-circle {
            animation: checkmarkCircle 0.6s ease-in-out;
        }

        @keyframes checkmarkCircle {
            0% {
                stroke-dashoffset: 166;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }

        .checkmark {
            animation: checkmark 0.3s ease-in-out 0.4s backwards;
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 36;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden success-animation">
            <!-- Success Header -->
            <div class="bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500 px-8 py-12 text-center">
                <div class="inline-block relative">
                    <svg class="w-24 h-24 text-white" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="currentColor" stroke-width="3" stroke-dasharray="166" stroke-dashoffset="166" />
                        <path class="checkmark" fill="none" stroke="currentColor" stroke-width="3" stroke-dasharray="36" stroke-dashoffset="36" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mt-6 mb-2">
                    {{ __('messages.payment_success') ?? 'Payment Successful!' }}
                </h1>
                <p class="text-green-100 text-lg">
                    {{ __('messages.payment_success_message') ?? 'Thank you for your payment. Your enrollment has been confirmed.' }}
                </p>
            </div>

            <!-- Course Information -->
            <div class="p-8">
                <div class="bg-gradient-to-r from-[#79131d]/5 to-[#5a0f16]/5 rounded-xl p-6 mb-6 border border-[#79131d]/10">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                        {{ __('messages.course_details') ?? 'Course Details' }}
                    </h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                            <span class="text-gray-600 font-medium {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.course') ?? 'Course' }}:
                            </span>
                            <span class="text-gray-900 font-semibold {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ $course->title }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                            <span class="text-gray-600 font-medium {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.price') ?? 'Price' }}:
                            </span>
                            <span class="text-gray-900 font-semibold {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                @if(app()->getLocale() === 'ar')
                                    {{ number_format($course->admin_price > 0 ? $course->admin_price : $course->price, 2) }}
                                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" 
                                         alt="SAR" 
                                         class="inline-block w-5 h-5 ml-1" 
                                         style="vertical-align: middle;">
                                @else
                                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" 
                                         alt="SAR" 
                                         class="inline-block w-5 h-5 mr-1" 
                                         style="vertical-align: middle;">
                                    {{ number_format($course->admin_price > 0 ? $course->admin_price : $course->price, 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                            <span class="text-gray-600 font-medium {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ __('messages.student') ?? 'Student' }}:
                            </span>
                            <span class="text-gray-900 font-semibold {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 {{ app()->getLocale() === 'ar' ? 'sm:flex-row-reverse' : '' }}">
                    <a href="{{ route('myCourse', $course->slug) }}" 
                       class="flex-1 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white font-bold py-4 px-6 rounded-xl hover:from-[#5a0f16] hover:to-[#79131d] transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                        <i class="fas fa-graduation-cap {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.go_to_course') ?? 'Go to Course' }}
                    </a>
                    <a href="{{ route('myCourses') }}" 
                       class="flex-1 bg-white border-2 border-[#79131d] text-[#79131d] font-bold py-4 px-6 rounded-xl hover:bg-[#79131d] hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                        <i class="fas fa-list {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.my_courses') ?? 'My Courses' }}
                    </a>
                </div>

                <!-- Additional Info -->
                <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.payment_success_info') ?? 'You will receive a confirmation email shortly. You can now access your course from your dashboard.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
