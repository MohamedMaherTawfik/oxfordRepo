<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.page_title') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                        sans: ['Cairo', 'sans-serif'],
                    },
                    colors: {
                        'primary-maroon': '#79131d',
                        'primary-gold': '#e4ce96',
                    },
                },
            },
            plugins: [],
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('node_modules/flag-icons/css/flag-icons.min.css') }}">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            scroll-behavior: smooth;
        }
        
        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        
        [dir="rtl"] .mr-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }
        
        [dir="rtl"] .ml-2 {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }
        
        [dir="rtl"] .text-left {
            text-align: right !important;
        }
        
        [dir="rtl"] .text-right {
            text-align: left !important;
        }

        :root {
            --primary-maroon: #79131d;
            --primary-gold: #e4ce96;
        }

        .floating-chat-btn {
            position: fixed;
            bottom: calc(20px + env(safe-area-inset-bottom));
            {{ app()->getLocale() === 'ar' ? 'left' : 'right' }}: 20px;
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary-maroon) 0%, #5a0f16 100%);
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(121, 19, 29, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 99999;
            border: 3px solid rgba(228, 206, 150, 0.3);
        }

        .floating-chat-btn:hover {
            background: linear-gradient(135deg, #5a0f16 0%, var(--primary-maroon) 100%);
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 12px 35px rgba(121, 19, 29, 0.6);
        }

        .floating-chat-btn::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(228, 206, 150, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.7;
            }
            50% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .chat-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
        }

        .chat-modal.active {
            display: flex;
        }

        .chat-modal-content {
            background: #fff;
            width: 90%;
            max-width: 450px;
            height: 600px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(121, 19, 29, 0.1);
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px) scale(0.9);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-bounce {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        @media (max-width: 768px) {
            .floating-chat-btn {
                {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 20px;
                {{ app()->getLocale() === 'ar' ? 'left' : 'right' }}: auto;
                bottom: calc(20px + env(safe-area-inset-bottom));
                width: 56px;
                height: 56px;
            }
            
            .chat-modal-content {
                height: 85vh;
                max-height: 600px;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-800 min-h-screen flex flex-col">

    <!-- ✅ شريط التقدم -->
    <div class="progress-container fixed top-0 right-0 w-full h-1 bg-transparent z-50">
        <div class="progress-bar h-1 bg-[#e4ce96] w-0" id="progressBar"></div>
    </div>

    <!-- ✅ المكونات -->
    <div class="flex-grow">
        <x-navbar />
        <x-home-header />
        <x-homeabout />
        <x-home2about />
        <x-home3about />
        <x-home4about />
        <x-home5about />
        <x-home6about />
        <x-home7about />
        <x-home-testmionals />

        <!-- ✅ النشرة البريدية - Enhanced -->
    <section class="py-20 bg-gradient-to-br from-[#79131d] via-[#5a0f16] to-[#79131d] relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, rgba(228,206,150,0.3) 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-6xl mx-auto bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 md:p-12 border border-white/20">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-8 {{ app()->getLocale() === 'ar' ? 'lg:flex-row-reverse' : '' }}">
                    <div class="flex-1 text-center lg:text-start">
                        <div class="inline-block p-3 bg-[#79131d]/10 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-[#79131d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            {{ __('messages.subscribe_section_title') }}
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ __('messages.subscribe_section_desc') }}
                        </p>
                    </div>
                    <form class="flex flex-col sm:flex-row w-full lg:w-auto gap-3 flex-shrink-0">
                        <input type="email" 
                               placeholder="{{ __('messages.subscribe_placeholder') }}"
                               class="px-6 py-4 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] outline-none transition-all duration-200 text-lg flex-grow min-w-[250px]">
                        <button type="submit"
                            class="px-8 py-4 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white font-bold rounded-xl hover:from-[#5a0f16] hover:to-[#79131d] transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 text-lg whitespace-nowrap">
                            {{ __('messages.subscribe_button') }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </div>

    <x-footer />

    <!-- ✅ زر الشات - Enhanced -->
    <button id="chatButton" class="floating-chat-btn group" title="{{ __('messages.assistant_title') }}">
        <i class="fa-solid fa-robot text-2xl relative z-10 group-hover:scale-110 transition-transform"></i>
        <!-- Notification Badge -->
        <span class="absolute -top-1 -right-1 w-5 h-5 bg-[#e4ce96] rounded-full border-2 border-white flex items-center justify-center">
            <span class="w-2 h-2 bg-[#79131d] rounded-full animate-pulse"></span>
        </span>
    </button>

    <!-- ✅ نافذة الشات - Enhanced -->
    <div id="chatModal" class="chat-modal">
        <div class="chat-modal-content">
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white p-5 flex justify-between items-center shadow-lg">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                        <i class="fa-solid fa-robot text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">{{ __('messages.assistant_title') }}</h3>
                        <p class="text-xs text-white/80">متصل الآن</p>
                    </div>
                </div>
                <button id="closeModal" class="text-white hover:bg-white/20 rounded-full p-2 transition-all duration-200 hover:rotate-90">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Messages -->
            <div id="chatMessages" class="flex-1 p-6 overflow-y-auto bg-gradient-to-b from-gray-50 to-white">
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-4 bg-[#79131d]/10 rounded-full mb-4">
                        <i class="fa-solid fa-robot text-4xl text-[#79131d]"></i>
                    </div>
                    <p class="text-gray-500 text-lg font-medium mb-2">{{ __('messages.assistant_start') }}</p>
                    <p class="text-gray-400 text-sm">ابدأ المحادثة الآن</p>
                </div>
            </div>

            <!-- Input -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <div class="flex gap-3">
                    <input id="messageInput" 
                           type="text" 
                           placeholder="{{ __('messages.assistant_placeholder') }}"
                           class="flex-1 border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] outline-none transition-all duration-200">
                    <button id="sendMessage"
                        class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-xl hover:from-[#5a0f16] hover:to-[#79131d] transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ سكريبتات -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            AOS.init({
                duration: 800,
                once: true
            });

            // ✅ شريط التمرير
            window.onscroll = () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                document.getElementById("progressBar").style.width = (winScroll / height) * 100 + "%";
            };

            // ✅ شات المساعد
            const chatButton = document.getElementById("chatButton");
            const chatModal = document.getElementById("chatModal");
            const closeModal = document.getElementById("closeModal");
            const sendMessage = document.getElementById("sendMessage");
            const chatMessages = document.getElementById("chatMessages");
            const messageInput = document.getElementById("messageInput");

            chatButton.onclick = () => chatModal.classList.add("active");
            closeModal.onclick = () => chatModal.classList.remove("active");
            chatModal.onclick = e => {
                if (e.target === chatModal) chatModal.classList.remove("active");
            };

            sendMessage.onclick = sendChat;
            messageInput.addEventListener("keypress", e => {
                if (e.key === "Enter") sendChat();
            });

            async function sendChat() {
                const message = messageInput.value.trim();
                if (!message) return;
                addMessage("user", message);
                messageInput.value = "";

                const loader = showLoader();
                try {
                    const csrfToken = document.querySelector("meta[name='csrf-token']")?.content;
                    if (!csrfToken) {
                        console.error('CSRF token not found');
                        removeLoader(loader);
                        addMessage("assistant", "{{ __('messages.assistant_error') }}");
                        return;
                    }

                    const response = await fetch("/api/chat", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify({
                            message: message
                        })
                    });

                    if (!response.ok) {
                        const errorData = await response.json().catch(() => ({}));
                        throw new Error(errorData.response || `HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    removeLoader(loader);
                    
                    if (data.response) {
                        addMessage("assistant", data.response);
                    } else {
                        addMessage("assistant", "{{ __('messages.assistant_error') }}");
                    }
                } catch (error) {
                    console.error('Chat error:', error);
                    removeLoader(loader);
                    addMessage("assistant", error.message || "{{ __('messages.assistant_retry') }}");
                }
            }

            function addMessage(sender, text) {
                chatMessages.querySelector(".text-center")?.remove();
                const wrapper = document.createElement("div");
                const isRTL = {{ app()->getLocale() === 'ar' ? 'true' : 'false' }};
                if (sender === "user") {
                    wrapper.className = `mb-3 flex ${isRTL ? 'justify-end' : 'justify-start'}`;
                } else {
                    wrapper.className = `mb-3 flex ${isRTL ? 'justify-start' : 'justify-end'}`;
                }
                const bubble = document.createElement("div");
                bubble.className = `px-4 py-2 rounded-2xl max-w-xs ${
                    sender === "user" 
                        ? `bg-[#79131d] text-white ${isRTL ? 'rounded-br-none' : 'rounded-bl-none'}` 
                        : `bg-gray-200 text-gray-800 ${isRTL ? 'rounded-bl-none' : 'rounded-br-none'}`
                }`;
                bubble.textContent = text;
                wrapper.appendChild(bubble);
                chatMessages.appendChild(wrapper);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function showLoader() {
                const id = "loader-" + Date.now();
                const div = document.createElement("div");
                div.id = id;
                div.className = "mb-3 flex justify-end";
                div.innerHTML = `
                    <div class="bg-gray-200 px-3 py-2 rounded-2xl rounded-br-none flex gap-1">
                        <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: .1s"></div>
                        <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce" style="animation-delay: .2s"></div>
                    </div>`;
                chatMessages.appendChild(div);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                return id;
            }

            function removeLoader(id) {
                document.getElementById(id)?.remove();
            }
        });
    </script>
</body>

</html>
