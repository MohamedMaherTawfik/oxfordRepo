<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.payment_confirmation') ?? 'Payment Confirmation' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .form-input:focus {
            border-color: #79131d;
            box-shadow: 0 0 0 3px rgba(121, 19, 29, 0.1);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-12 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] rounded-2xl shadow-2xl mb-6 p-8 text-white">
            <div class="flex items-center justify-center mb-4">
                <div class="bg-white/20 rounded-full p-4 backdrop-blur-sm">
                    <i class="fas fa-credit-card text-4xl"></i>
                </div>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-center mb-2">
                {{ __('messages.payment_confirmation') ?? 'Payment Confirmation' }}
            </h1>
            <p class="text-center text-white/90">
                {{ __('messages.complete_payment_info') ?? 'Please complete your payment information below' }}
            </p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Payment Summary -->
            <div class="bg-gradient-to-r from-[#79131d]/5 to-[#5a0f16]/5 p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-4 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    {{ __('messages.payment_summary') ?? 'Payment Summary' }}
                </h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                        <span class="text-gray-600 font-medium">
                            {{ __('messages.course') ?? 'Course' }}:
                        </span>
                        <span class="text-gray-900 font-semibold">
                            {{ $course->title }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                        <span class="text-gray-600 font-medium">
                            {{ __('messages.student') ?? 'Student' }}:
                        </span>
                        <span class="text-gray-900 font-semibold">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                        <span class="text-gray-600 font-medium">
                            {{ __('messages.email') ?? 'Email' }}:
                        </span>
                        <span class="text-gray-900 font-semibold">
                            {{ Auth::user()->email }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} pt-3 border-t border-gray-300">
                        <span class="text-lg font-bold text-[#79131d]">
                            {{ __('messages.total_amount') ?? 'Total Amount' }}:
                        </span>
                        <span class="text-2xl font-bold text-[#79131d]">
                            @if(app()->getLocale() === 'ar')
                                {{ number_format($course->admin_price > 0 ? $course->admin_price : $course->price, 2) }}
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" 
                                     alt="SAR" 
                                     class="inline-block w-6 h-6 ml-1" 
                                     style="vertical-align: middle;">
                            @else
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" 
                                     alt="SAR" 
                                     class="inline-block w-6 h-6 mr-1" 
                                     style="vertical-align: middle;">
                                {{ number_format($course->admin_price > 0 ? $course->admin_price : $course->price, 2) }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <form action="{{ route('pay.initiate', $course) }}" method="POST" class="p-8">
                @csrf

                <h2 class="text-2xl font-bold text-gray-900 mb-6 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    {{ __('messages.billing_information') ?? 'Billing Information' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.address') ?? 'Address' }}
                        </label>
                        <input type="text" 
                               name="address" 
                               id="address"
                               required
                               class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition-all duration-200 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                               placeholder="{{ __('messages.enter_address') ?? 'Enter your address' }}">
                        @error('address')
                            <span class="text-red-500 text-sm mt-1 block {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.phone') ?? 'Phone Number' }}
                        </label>
                        <input type="text" 
                               name="phone" 
                               id="phone"
                               required
                               class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition-all duration-200 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                               placeholder="{{ __('messages.enter_phone') ?? 'Enter your phone number' }}">
                        @error('phone')
                            <span class="text-red-500 text-sm mt-1 block {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="city" class="block text-sm font-semibold text-gray-700 mb-2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.city') ?? 'City' }}
                        </label>
                        <input type="text" 
                               name="city" 
                               id="city"
                               required
                               class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition-all duration-200 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                               placeholder="{{ __('messages.enter_city') ?? 'Enter your city' }}">
                        @error('city')
                            <span class="text-red-500 text-sm mt-1 block {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="country" class="block text-sm font-semibold text-gray-700 mb-2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.country') ?? 'Country' }}
                        </label>
                        <input type="text" 
                               name="country" 
                               id="country"
                               required
                               class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition-all duration-200 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                               placeholder="{{ __('messages.enter_country') ?? 'Enter your country' }}">
                        @error('country')
                            <span class="text-red-500 text-sm mt-1 block {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="state" class="block text-sm font-semibold text-gray-700 mb-2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.state') ?? 'State / Province' }}
                        </label>
                        <input type="text" 
                               name="state" 
                               id="state"
                               required
                               class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition-all duration-200 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                               placeholder="{{ __('messages.enter_state') ?? 'Enter your state' }}">
                        @error('state')
                            <span class="text-red-500 text-sm mt-1 block {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="zip" class="block text-sm font-semibold text-gray-700 mb-2 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                            {{ __('messages.zip_code') ?? 'Zip Code' }}
                        </label>
                        <input type="text" 
                               name="zip" 
                               id="zip"
                               required
                               class="form-input w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none transition-all duration-200 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                               placeholder="{{ __('messages.enter_zip') ?? 'Enter your zip code' }}">
                        @error('zip')
                            <span class="text-red-500 text-sm mt-1 block {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" name="amount" value="{{ $course->admin_price > 0 ? $course->admin_price : $course->price }}">
                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white font-bold py-4 px-6 rounded-xl hover:from-[#5a0f16] hover:to-[#79131d] transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-lock {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.proceed_to_payment') ?? 'Proceed to Payment' }}
                    </button>
                </div>

                <!-- Security Notice -->
                <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-xl {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    <p class="text-sm text-green-800">
                        <i class="fas fa-shield-alt {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.secure_payment') ?? 'Your payment is secured by ClickPay. All transactions are encrypted and secure.' }}
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
