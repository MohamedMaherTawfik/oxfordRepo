<x-panel>
    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-yellow-100 border border-yellow-400 text-yellow-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-lg border border-yellow-300">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div x-data="{ openModal: false }" class="max-w-2xl mx-auto mt-10 bg-white rounded-2xl shadow-xl p-10 space-y-6">
        {{-- User Photo --}}
        <div class="flex justify-center">
            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-avatar.png') }}"
                alt="User Photo" class="w-40 h-40 rounded-full object-cover border-4 border-gray-200 shadow-lg">
        </div>

        {{-- User Info --}}
        <div class="text-center space-y-4">
            <h2 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h2>
            <p class="text-lg text-gray-600">{{ $user->email }}</p>
            <span class="px-4 py-2 text-base bg-blue-100 text-blue-800 rounded-full font-medium inline-block">
                {{ ucfirst($user->role) }}
            </span>
        </div>

        {{-- Send Notification Button --}}
        <div class="pt-6">
            <button @click="openModal = true"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold py-3 px-6 rounded-lg shadow-md">
                Send Notification
            </button>
        </div>

        {{-- Modal --}}
        <template x-if="openModal">
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white w-full max-w-lg mx-auto rounded-lg shadow-lg p-6">
                    {{-- عنوان المودال --}}
                    <h2 class="text-2xl font-bold mb-4">Send Notification</h2>

                    {{-- فورم الإرسال --}}
                    <form action="{{ route('admin.teachers.notify') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-medium mb-1">title</label>
                            <input type="text" name="title" id="title" required
                                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 font-medium mb-1">Message</label>
                            <input type="text" name="message" id="message" required
                                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        </div>
                        <input type="hidden" value="{{ $user->id }}" name="reciever_id">

                        <div class="flex justify-end space-x-3">
                            <button type="button" @click="openModal = false"
                                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </div>
</x-panel>

{{-- تأكد من إضافة Alpine.js في الصفحة --}}
<script src="//unpkg.com/alpinejs" defer></script>
