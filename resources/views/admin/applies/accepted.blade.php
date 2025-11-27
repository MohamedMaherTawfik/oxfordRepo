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




    <div class="p-6 bg-white min-h-screen">
        <!-- Search & Add Button -->
        <div class="flex justify-between items-center mb-4">
            <div></div>
            <div class="flex justify-end">
                <a href="{{ route('admin.users.create') }}"
                    class="bg-[#79131DC2] text-right text-white px-4 py-2 rounded-lg shadow hover:bg-[#79131d]">
                    {{ __('main.add_user') }} +
                </a>
            </div>
        </div>

        <!-- User List Headers -->
        <div class="hidden md:grid grid-cols-7 gap-4 font-semibold text-gray-700 mb-2">
            <div class="text-[#79131d]">{{ __('main.user') }}</div>
            <div class="text-[#79131d]">{{ __('main.email') }}</div>
            <div class="text-[#79131d]">{{ __('main.role') }}</div>
            <div class="text-[#79131d]">{{ __('main.join_date') }}</div>
            <div class="text-right mr-10 text-[#79131d]">{{ __('main.status') }}</div>
        </div>
        <!-- User List Container -->
        @foreach ($applies as $apply)
            <div class="grid grid-cols-7 gap-4 items-center bg-[#e4ce96] p-4 rounded-lg shadow mb-2">
                <!-- apply Info -->
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gray-300 rounded-full">
                        <img src="{{ $apply->user->photo ? asset('storage/' . $apply->user->photo) : asset('images/default-avatar.png') }}"
                            alt="User Photo" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div>
                        <div class="font-medium">{{ $apply->user->name }}</div>
                    </div>
                </div>


                <!-- Email -->
</x-panel>
