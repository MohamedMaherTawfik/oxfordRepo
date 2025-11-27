<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>كلمة - نحو مساحات مبتكرة للتعلّم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes wave {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-3deg);
            }

            50% {
                transform: rotate(0deg);
            }

            75% {
                transform: rotate(3deg);
            }
        }

        .star {
            animation: float 3s ease-in-out infinite;
            opacity: 0.8;
        }

        .astronaut {
            position: absolute;
            bottom: 60px;
            left: 50px;
            width: 120px;
            height: 180px;
            background-image: url('https://i.imgur.com/9XqZtFk.png');
            background-size: contain;
            background-repeat: no-repeat;
            z-index: 10;
            animation: walk 5s infinite linear;
        }

        @keyframes walk {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(10px);
            }

            50% {
                transform: translateX(0);
            }

            75% {
                transform: translateX(-10px);
            }
        }

        /* Updated Flag as SVG */
        .flag {
            position: absolute;
            bottom: 60px;
            right: 50px;
            width: 150px;
            height: 100px;
            z-index: 10;
            animation: float 4s ease-in-out infinite, wave 3s ease-in-out infinite;
        }

        .flag svg {
            width: 100%;
            height: 100%;
            fill: #79131d;
            /* Burgundy color */
            stroke: #555;
            stroke-width: 1;
        }

        .flag text {
            fill: white;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: bold;
            text-anchor: middle;
        }

        .crater {
            position: absolute;
            bottom: 40px;
            width: 100px;
            height: 30px;
            background-color: #2d5d6a;
            border-radius: 50%;
            opacity: 0.7;
            z-index: 5;
        }

        .crater:nth-child(1) {
            left: 30%;
        }

        .crater:nth-child(2) {
            left: 50%;
        }

        .crater:nth-child(3) {
            left: 70%;
        }

        .crater:nth-child(4) {
            left: 90%;
        }

        @keyframes slide {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }

            25% {
                opacity: 1;
            }

            75% {
                opacity: 1;
            }

            100% {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        .animate-slide {
            animation: slide 1.5s ease-in-out infinite;
            transform-origin: right;
        }
    </style>


</head>

<body class="bg-black text-white relative overflow-hidden">
    <!-- Stars Background -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-black">
        <!-- Dynamic Stars -->
        <script>
            const starContainer = document.createElement('div');
            starContainer.className = 'absolute inset-0';
            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.className = 'star w-1 h-1 bg-white rounded-full absolute';
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                star.style.animationDelay = `${Math.random() * 3}s`;
                starContainer.appendChild(star);
            }
            document.body.appendChild(starContainer);
        </script>
    </div>
    <!-- Header -->
    <header class="relative z-20 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">

            <button class="bg-[#79131d] text-white px-4 py-2 rounded-full text-sm font-medium ml-2">إنشاء حساب
                مجاني</button>
            <button class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium ">تسجيل
                الدخول</button>
            <button
                class="relative px-4 py-2 font-medium text-[#e4ce96] border-b-2 border-transparent hover:text-white transition">
                تَفاصيل الاشتراك
                <span class="absolute bottom-0 left-0 w-full h-1 bg-[#e4ce96] animate-slide"></span>
            </button>

        </div>

        <nav class="flex items-center space-x-6 text-white text-sm font-medium">
            <a href="#" class="hover:text-[#79131d] transition ml-2">من نحن؟</a>
            <a href="#" class="hover:text-[#79131d] transition">ميزاتنا</a>
            <a href="#" class="hover:text-[#79131d] transition">المدونة</a>
            <a href="#" class="hover:text-[#79131d] transition">فعالياتنا</a>
        </nav>

        <img src="{{ asset('images/logo.png') }}" alt="Oxford Logo" class="h-20 w-20">
    </header>
    <!-- Main Content -->
    <main class="relative text-[#e4ce96] z-10 flex flex-col items-center justify-center h-screen px-6 pt-20">
        <h1 class="text-5xl md:text-6xl font-bold text-center mb-6 leading-tight">
            نحو مساحات مبتكرة للتعلّم
        </h1>
        <p class="text-xl md:text-2xl text-center mb-10 max-w-3xl">
            نساعد المدارس اليوم في التعلّم باللّغة العربيّة.
        </p>

        <div class="flex gap-4">
            <a href="{{ route('home.index') }}"
                class="bg-[#79131DE1] hover:bg-[#79131DFF] text-white font-semibold px-6 py-3 rounded-full transition shadow-lg">
                اكتشاف المزيد
            </a>

            <a href="{{ route('home.index') }}"
                class="bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold px-6 py-3 rounded-full transition shadow-lg">
                بدء تجربة مجانية
            </a>
        </div>
    </main>
    <!-- Astronaut -->
    <div class="astronaut">
        <svg width="120" height="180" viewBox="0 0 120 180" xmlns="http://www.w3.org/2000/svg">
            <!-- Helmet -->
            <ellipse cx="60" cy="50" rx="30" ry="35" fill="#fff" stroke="#000"
                stroke-width="2" />
            <circle cx="60" cy="45" r="20" fill="#000" />
            <path d="M55 45 C55 40, 65 40, 65 45" fill="#000" />

            <!-- Face -->
            <circle cx="55" cy="47" r="2" fill="#fff" />
            <circle cx="65" cy="47" r="2" fill="#fff" />
            <path d="M55 50 Q60 55, 65 50" stroke="#000" stroke-width="1" fill="none" />

            <!-- Hair -->
            <path d="M50 40 C52 35, 68 35, 70 40" fill="#f9d03a" />

            <!-- Suit Body -->
            <rect x="45" y="50" width="30" height="50" fill="#fff" stroke="#000" stroke-width="2" />
            <rect x="55" y="100" width="10" height="10" fill="#000" />
            <rect x="45" y="110" width="30" height="10" fill="#fff" stroke="#000" stroke-width="2" />
            <rect x="45" y="120" width="30" height="20" fill="#fff" stroke="#000" stroke-width="2" />
            <rect x="45" y="140" width="30" height="10" fill="#fff" stroke="#000" stroke-width="2" />
            <rect x="45" y="150" width="30" height="10" fill="#fff" stroke="#000" stroke-width="2" />

            <!-- Arms -->
            <rect x="30" y="70" width="15" height="10" fill="#fff" stroke="#000" stroke-width="2" />
            <rect x="75" y="70" width="15" height="10" fill="#fff" stroke="#000" stroke-width="2" />

            <!-- Legs -->
            <rect x="40" y="150" width="10" height="30" fill="#fff" stroke="#000" stroke-width="2" />
            <rect x="70" y="150" width="10" height="30" fill="#fff" stroke="#000" stroke-width="2" />

            <!-- Boots -->
            <rect x="40" y="180" width="10" height="10" fill="#00ff00" rx="2" />
            <rect x="70" y="180" width="10" height="10" fill="#00ff00" rx="2" />

            <!-- Laptop -->
            <rect x="170" y="150" width="20" height="15" fill="#e0e0e0" stroke="#000" />
            <rect x="172" y="152" width="16" height="11" fill="#ffffff" stroke="#000" />

            <!-- Left Hand -->
            <path d="M45 70 C45 75, 50 80, 55 75" fill="#fff" stroke="#000" stroke-width="1" />
        </svg>
    </div>
    <div class="flag"
        style="bottom: 100px; right: 50px; width: 150px; height: 100px; z-index: 10; animation: float 4s ease-in-out infinite;">
        <svg viewBox="0 0 150 100" xmlns="http://www.w3.org/2000/svg">
            <!-- Flagpole -->
            <rect x="10" y="10" width="4" height="80" fill="#333" />
            <rect x="8" y="5" width="8" height="10" fill="#555" rx="2" />

            <!-- Flag Body (wavy) -->
            <path d="M14 20
             C20 25, 30 30, 40 30
             C50 30, 60 25, 70 20
             C80 15, 90 10, 100 15
             C110 20, 120 25, 130 20
             C140 15, 145 10, 140 15
             L140 70
             L14 70
             Z" fill="#79131d" stroke="#555" stroke-width="1" />

            <!-- Text on Flag -->
            <text x="75" y="45" fill="#e4ce96" font-family="Arial, sans-serif" font-size="14" font-weight="bold"
                text-anchor="middle">
                Oxford Platform
            </text>
        </svg>
    </div>

    <!-- Floating Button -->
    <button class="floating-btn" id="chatBtn">
        💬
    </button>

    <!-- Modal -->
    <div class="modal" id="chatModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>ChatGPT Assistant</h3>
                <span class="close-btn" id="closeModal">&times;</span>
            </div>
            <div class="chat-container">
                <div class="chat-messages" id="chatMessages">
                    <div class="message bot-message">
                        Hello! How can I help you today?
                    </div>
                </div>
                <div class="chat-input">
                    <input type="text" id="userInput" placeholder="Type your message...">
                    <button id="sendBtn">Send</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Chat Button -->
    <div class="fixed bottom-6 left-6 z-50">
        <button id="chatButton"
            class="bg-[#79131d] hover:bg-[#5a0f16] text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
        </button>
    </div>


</body>

</html>
