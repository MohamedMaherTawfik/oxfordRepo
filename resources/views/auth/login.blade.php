@php
    use App\Models\signphoto;
    $photo = signphoto::first();
    
    // إرجاع قيمة افتراضية إذا لم تكن هناك بيانات
    $loginPhoto = $photo && $photo->login ? asset('storage/' . $photo->login) : asset('web/login.jpg');
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('messages.login_title') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('node_modules/flag-icons/css/flag-icons.min.css') }}">
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

<body class="w-screen h-screen m-0 p-0 overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100">

    <div class="flex w-full h-full flex-col md:flex-row {{ app()->getLocale() === 'ar' ? 'md:flex-row-reverse' : '' }}">

        <!-- Left Side: Background Image with Enhanced Overlay -->
        <div class="md:w-1/2 w-full relative bg-cover bg-center h-64 md:h-auto overflow-hidden"
            style="background-image: url('{{ $loginPhoto }}');">
            <div class="absolute inset-0 bg-gradient-to-br from-[#79131d]/90 via-[#79131d]/80 to-[#5a0f16]/90 flex items-center justify-center p-10">
                <div class="text-white text-center max-w-md space-y-6">
                    <div class="mb-8">
                        <div class="inline-block p-4 bg-white/20 rounded-full backdrop-blur-sm mb-4">
                            <i class="fas fa-graduation-cap text-4xl"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold mb-4">{{ __('messages.login_left_text1') }}</h3>
                    <p class="text-lg leading-relaxed opacity-90">
                        {{ __('messages.login_left_text2') }}<br />
                        {{ __('messages.login_left_text3') }}<br />
                        {{ __('messages.login_left_text4') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side: Enhanced Login Form -->
        <div class="md:w-1/2 w-full flex items-center justify-center bg-white p-8 md:p-12">
            <div class="w-full max-w-md space-y-8">
                <!-- Header -->
                <div class="text-center space-y-2">
                    <div class="inline-block p-3 bg-[#79131d]/10 rounded-full mb-4">
                        <i class="fas fa-sign-in-alt text-3xl text-[#79131d]"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900">{{ __('messages.login_title') }}</h2>
                    <p class="text-gray-600">{{ __('messages.welcome_back') }}</p>
                </div>

                <form class="space-y-6" action="{{ route('signin') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                            {{ __('messages.email') }}
                        </label>
                        <div class="relative">
                            <input type="email" name="email" placeholder="{{ __('messages.email_placeholder') }}"
                                class="w-full px-4 py-3 pl-12 border-2 border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200">
                            <i class="fas fa-envelope absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                            {{ __('messages.password') }}
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="{{ __('messages.password_placeholder') }}"
                                class="w-full px-4 py-3 pl-12 pr-12 border-2 border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200">
                            <i class="fas fa-lock absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" onclick="togglePassword()" class="absolute {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-[#79131d] transition">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-[#79131d] to-[#5a0f16] hover:from-[#5a0f16] hover:to-[#79131d] text-white font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i>
                            {{ __('messages.login_button') }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                        </button>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        {{ __('messages.no_account') }}
                        <a href="{{ route('register') }}" class="text-[#79131d] font-semibold hover:text-[#5a0f16] hover:underline transition">
                            {{ __('messages.register') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>
