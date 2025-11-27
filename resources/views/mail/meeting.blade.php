<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>رفض الطلب</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border: 1px solid #e0e6ed;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #004080;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #004080;
            margin: 0;
            font-size: 22px;
        }

        .content {
            line-height: 1.8;
            color: #333;
            font-size: 16px;
        }

        .content p {
            margin: 12px 0;
        }

        .label {
            font-weight: bold;
            color: #004080;
            display: inline-block;
            min-width: 120px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #777;
            border-top: 1px solid #e0e6ed;
            margin-top: 25px;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>📌 إشعار من Oxford Application</h2>
        </div>

        <div class="content">
            <p>عزيزي {{ $user->name }}</p>
            <span>
                نود اعلامك بانه تم تحديد مقابله لك من منصه اكسفورد
            </span>

            <p><span class="label">الوصف:</span> {{ $description }}</p>
            <p><span class="label">تاريخ المقابلة: {{ $meeting_date }} </span>
            <p><span class="label"> الساعه: {{ $time }} </span>
            </p>

            <p>نرجو منك التواجد في الميعاد المحدد إذا كان هناك متابعة، ونتمنى لك التوفيق.</p>
        </div>

        <div class="footer">
            © {{ date('Y') }} Oxford CIS - جميع الحقوق محفوظة
        </div>
    </div>
</body>

</html>
