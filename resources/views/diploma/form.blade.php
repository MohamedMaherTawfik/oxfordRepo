<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>Payment Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background: #f8f5f1;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e4ce96;
        }

        h2 {
            text-align: center;
            color: #79131d;
            margin-bottom: 25px;
            font-size: 26px;
        }

        .payment-info {
            background-color: #fdfaf4;
            border: 1px solid #e4ce96;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            font-size: 15px;
            line-height: 1.6;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .info-label {
            color: #79131d;
            font-weight: 600;
        }

        .info-value {
            color: #555;
        }

        .amount {
            font-size: 20px;
            font-weight: bold;
            color: #79131d;
            text-align: center;
            margin: 15px 0;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #79131d;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e4ce96;
            border-radius: 8px;
            background-color: #fdfaf4;
            color: #333;
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #79131d;
            outline: none;
            box-shadow: 0 0 5px rgba(121, 19, 29, 0.3);
        }

        button {
            background-color: #79131d;
            color: #e4ce96;
            border: none;
            padding: 14px 20px;
            width: 100%;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #5e0f17;
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #aaa;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Confirm Payment</h2>

        <!-- عرض البيانات -->
        <div class="payment-info">
            <div class="info-item">
                <span class="info-label">Amount:</span>
                <span
                    class="info-value">{{ $course->admin_price > 0 ? number_format($course->admin_price, 2) : number_format($course->price, 2) }}
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" alt="SAR" class="inline-block sar-symbol"></span>
            </div>
            <div class="info-item">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ Auth::user()->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ Auth::user()->email }}</span>
            </div>
        </div>

        <!-- نموذج الدفع -->
        <form action="{{ route('pay.initiate.diploma', $course) }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="address">العنوان</label>
                    <input type="text" name="address" id="address"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">رقم الهاتف</label>
                    <input type="text" name="phone" id="phone"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="city">المدينة</label>
                    <input type="text" name="city" id="city"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="country">الدولة</label>
                    <input type="text" name="country" id="country"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('country')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="state">المحافظة / الولاية</label>
                    <input type="text" name="state" id="state"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('state')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="zip">الرمز البريدي</label>
                    <input type="text" name="zip" id="zip"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('zip')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- بيانات مخفية -->
            <input type="hidden" name="amount"
                value="{{ $course->admin_price > 0 ? $course->admin_price : $course->price }}">
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="email" value="{{ Auth::user()->email }}">

            <button type="submit"
                class="mt-6 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300">
                💳 Pay Now
            </button>
        </form>


        <div class="footer">
            Secured by ClickPay
        </div>
    </div>
</body>

</html>
