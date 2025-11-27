@php
    use App\Models\signphoto;
    $photo = signphoto::first();
    $registerPhoto = $photo && $photo->register ? asset('storage/' . $photo->register) : asset('web/teacher.jpg');
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('messages.register_title') }}</title>
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

<body class="w-screen h-screen m-0 p-0 overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100">

    <div class="flex w-full h-full flex-col md:flex-row {{ app()->getLocale() === 'ar' ? 'md:flex-row-reverse' : '' }}">

        <!-- Left Side: Enhanced Background -->
        <div class="md:w-1/2 w-full relative bg-cover bg-center h-64 md:h-auto overflow-hidden"
            style="background-image: url('{{ $registerPhoto }}');">
            <div class="absolute inset-0 bg-gradient-to-br from-[#79131d]/90 via-[#79131d]/80 to-[#5a0f16]/90 flex items-center justify-center p-10">
                <div class="text-white text-center max-w-md space-y-6">
                    <div class="mb-8">
                        <div class="inline-block p-4 bg-white/20 rounded-full backdrop-blur-sm mb-4">
                            <i class="fas fa-user-plus text-4xl"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold mb-4">{{ __('messages.register_left_1') }}</h3>
                    <p class="text-lg leading-relaxed opacity-90">
                        {{ __('messages.register_left_2') }}<br />
                        {{ __('messages.register_left_3') }}<br />
                        {{ __('messages.register_left_4') }}<br />
                        {{ __('messages.register_left_5') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side: Enhanced Register Form -->
        <div class="md:w-1/2 w-full flex items-center justify-center bg-white p-8 md:p-12 overflow-y-auto">
            <div class="w-full max-w-md space-y-6">
                <!-- Header -->
                <div class="text-center space-y-2">
                    <div class="inline-block p-3 bg-[#79131d]/10 rounded-full mb-4">
                        <i class="fas fa-user-plus text-3xl text-[#79131d]"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900">{{ __('messages.register_title') }}</h2>
                    <p class="text-gray-600">{{ __('messages.create_account') ?? 'أنشئ حسابك الآن' }}</p>
                </div>

                <form class="space-y-5" action="{{ route('signup') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                            {{ __('messages.username') }}
                        </label>
                        <div class="relative">
                            <input type="text" name="name" placeholder="{{ __('messages.username') }}"
                                class="w-full px-4 py-3 pl-12 border-2 border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200">
                            <i class="fas fa-user absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('name')
                            <span class="text-red-500 text-sm flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user-tag {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                            {{ __('messages.register_as') }}
                        </label>
                        <div class="relative">
                            <select name="role"
                                class="w-full px-4 py-3 pl-12 border-2 border-gray-300 rounded-xl bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200 appearance-none">
                                <option value="">{{ __('messages.select_role') }}</option>
                                <option value="user">{{ __('messages.student') }}</option>
                                <option value="teacher">{{ __('messages.teacher') }}</option>
                            </select>
                            <i class="fas fa-chevron-down absolute {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                        @error('role')
                            <span class="text-red-500 text-sm flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                            {{ __('messages.email') }}
                        </label>
                        <div class="relative">
                            <input type="email" name="email" placeholder="you@example.com"
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

                    <!-- Photo -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-image {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                            {{ __('messages.upload_photo') }}
                        </label>
                        <div class="relative">
                            <input type="file" name="photo" accept="image/*"
                                class="block w-full text-sm text-gray-700 file:{{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }} file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#79131d] file:text-white hover:file:bg-[#5a0f16] file:transition file:cursor-pointer border-2 border-gray-300 rounded-xl p-2 bg-gray-50">
                        </div>
                        @error('photo')
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
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="w-full px-4 py-3 pl-12 pr-12 border-2 border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200">
                            <i class="fas fa-lock absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" onclick="togglePassword('password')" class="absolute {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-[#79131d] transition">
                                <i class="fas fa-eye" id="eyeIcon1"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-[#79131d]"></i>
                            {{ __('messages.confirm_password') }}
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                                class="w-full px-4 py-3 pl-12 pr-12 border-2 border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200">
                            <i class="fas fa-lock absolute {{ app()->getLocale() === 'ar' ? 'right-4' : 'left-4' }} top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }} top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-[#79131d] transition">
                                <i class="fas fa-eye" id="eyeIcon2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-[#79131d] to-[#5a0f16] hover:from-[#5a0f16] hover:to-[#79131d] text-white font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            {{ __('messages.register_button') }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        {{ __('messages.have_account') }}
                        <a href="{{ route('login') }}" class="text-[#79131d] font-semibold hover:text-[#5a0f16] hover:underline transition">
                            {{ __('messages.login') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const password = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId === 'password' ? 'eyeIcon1' : 'eyeIcon2');
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
