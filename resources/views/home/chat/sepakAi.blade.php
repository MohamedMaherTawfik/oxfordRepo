<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AI Chat</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js CDN -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        
        /* Smooth typing animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>

<body class="bg-gray-100">

    <x-navbar />


    <div class="mt-10">.</div>
    <div class="mt-10">.</div>
    <div x-data="chatApp()" class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-10 h-[80vh] flex flex-col">

        <!-- Chat Box -->
        <div id="chat-box" class="flex-1 overflow-y-auto border border-gray-200 rounded-lg p-4 space-y-3 bg-gray-50">
            <template x-for="msg in messages" :key="$id('msg')">
                <div :class="msg.sender === 'You' ? 'text-right' : 'text-left'" class="message">
                    <p class="inline-block max-w-xs md:max-w-md lg:max-w-lg px-4 py-2 rounded-lg shadow-sm"
                        :class="msg.sender === 'You' ?
                            'bg-[#79131d] text-[#e4ce96] rounded-br-none' :
                            'bg-gray-200 text-gray-800 rounded-bl-none'"
                        x-text="msg.sender + ': ' + msg.text"></p>
                </div>
            </template>

            <!-- Typing Indicator -->
            <div x-show="isTyping" class="flex items-center space-x-2 text-gray-500 text-sm">
                <span>ChatGPT is typing</span>
                <span class="flex space-x-1">
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></span>
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                </span>
            </div>
        </div>

        <!-- Input Form -->
        <form @submit.prevent="sendMessage" class="mt-4 flex gap-2">
            <input type="text" placeholder="Type your message..." x-model="inputMessage"
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] focus:border-transparent"
                autocomplete="off" :disabled="isTyping" />
            <button type="submit" :disabled="isTyping || !inputMessage.trim()"
                class="bg-[#79131d] text-[#e4ce96] px-6 py-2 rounded-lg hover:bg-[#5e0f17] transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                <span x-show="!isTyping">Send</span>
                <svg x-show="isTyping" class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </button>
        </form>

    </div>

    <script>
        function chatApp() {
            return {
                messages: [{
                    sender: 'ChatGPT',
                    text: 'Hello! How can I help you today?'
                }],
                inputMessage: '',
                isTyping: false,

                async sendMessage() {
                    const message = this.inputMessage.trim();
                    if (!message) return;

                    // Add user message
                    this.messages.push({
                        sender: 'You',
                        text: message
                    });
                    this.inputMessage = '';
                    this.isTyping = true;

                    try {
                        const response = await fetch('/message-ai', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': 'Bearer YOUR_TOKEN'
                            },
                            body: JSON.stringify({
                                message: 'Hello'
                            })
                        });

                        const data = await response.json();
                        this.isTyping = false;

                        if (data.reply) {
                            this.messages.push({
                                sender: 'ChatGPT',
                                text: data.reply
                            });
                        } else {
                            this.messages.push({
                                sender: 'ChatGPT',
                                text: 'Error: ' + (data.error || 'Something went wrong.')
                            });
                        }
                    } catch (err) {
                        this.isTyping = false;
                        this.messages.push({
                            sender: 'ChatGPT',
                            text: 'Network error: ' + err.message
                        });
                    }

                    this.scrollToBottom();
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const chatBox = document.getElementById('chat-box');
                        chatBox.scrollTop = chatBox.scrollHeight;
                    });
                }
            };
        }

        // Make sure CSRF token is available if Laravel is used
        // Add this meta tag in <head> if not already present:
        // <meta name="csrf-token" content="{{ csrf_token() }}">
    </script>

    <!-- Add CSRF Meta Tag if using Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mt-10"></div>
    <x-footer />
</body>

</html>
