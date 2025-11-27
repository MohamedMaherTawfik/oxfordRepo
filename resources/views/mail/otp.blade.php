<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
            color: #333;
            padding: 40px;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .otp-box {
            background-color: #f1f5f9;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 3px;
            margin: 20px 0;
            border-radius: 6px;
            color: #176b98;
        }

        .footer {
            font-size: 14px;
            color: #999;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Password Reset OTP</h2>

        <p>Hello,</p>

        <p>You requested to reset your password. Please use the OTP code below to proceed:</p>

        <div class="otp-box">
            {{ $otp }}
        </div>

        <p>This OTP is valid for 10 minutes.</p>

        <p>If you didn't request a password reset, please ignore this email.</p>

        <p>Thanks,<br>Oxrford Team</p>

        <div class="footer">
            &copy; {{ date('Y') }} Oxford. All rights reserved.
        </div>
    </div>
</body>

</html>
