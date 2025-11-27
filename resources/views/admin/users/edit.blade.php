<x-panel>
    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-400 text-green-700">
            {{ __('main.success_message', ['message' => session('success')]) }}
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
            {{ __('main.error_message', ['message' => session('error')]) }}
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

    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-md p-8">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('main.edit_user_title') }}</h2>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('main.full_name') }}</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('main.email') }}</label>
                    <input type="email" name="email" value="{{ $user->email }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('main.role') }}</label>
                    <select name="role"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="{{ $user->role }}">{{ __('main.change_role') }}</option>
                        <option value="user">{{ __('main.user') }}</option>
                        <option value="admin">{{ __('main.admin') }}</option>
                        <option value="teacher">{{ __('main.teacher') }}</option>
                    </select>
                    @error('role')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="text-center">
                    <button type="submit"
                        class="w-50 py-2 px-4 rounded-md font-semibold text-white bg-[#73131DC2] hover:bg-[#73131d] transition">
                        {{ __('main.update_user_button') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-panel>
