<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تم الدفع</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md text-center">
        <h1 class="text-3xl font-bold text-green-600">✅ تم الدفع بنجاح!</h1>
        <p class="mt-4">شكرًا لك، تمت عملية الدفع بنجاح.</p>
        <a href="{{ route('gate.diplomas.show.diploma', $course->slug) }}"
            class="inline-block mt-6 text-blue-600 hover:underline">الذهاب
            الي
            الدبلومه</a>
    </div>
</body>

</html>
