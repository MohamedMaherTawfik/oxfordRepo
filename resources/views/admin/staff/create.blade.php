<x-panel>
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-right">{{ __('main.add_new_staff') }}</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.staff.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Basic Information -->
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-right">{{ __('main.basic_info') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2 text-right">{{ __('main.full_name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] text-right">
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2 text-right">{{ __('main.email') }}</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] text-right">
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2 text-right">{{ __('main.password') }}</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] text-right">
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2 text-right">{{ __('main.password_confirmation') }}</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] text-right">
                        </div>
                    </div>
                </div>

                <!-- Permissions -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-right">{{ __('main.permissions') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_users" value="1"
                                {{ old('manage_users') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_users') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_teachers" value="1"
                                {{ old('manage_teachers') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_teachers') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_courses" value="1"
                                {{ old('manage_courses') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_courses') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_categories" value="1"
                                {{ old('manage_categories') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_categories') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_diplomas" value="1"
                                {{ old('manage_diplomas') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_diplomas') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_payments" value="1"
                                {{ old('manage_payments') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_payments') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_certificates" value="1"
                                {{ old('manage_certificates') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_certificates') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_applies" value="1"
                                {{ old('manage_applies') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_applies') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_homepage" value="1"
                                {{ old('manage_homepage') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_homepage') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_footer" value="1"
                                {{ old('manage_footer') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_footer') }}</span>
                        </label>

                        <label
                            class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_staff" value="1"
                                {{ old('manage_staff') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">{{ __('main.manage_staff') }}</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 space-x-reverse mt-8">
                    <a href="{{ route('admin.staff.index') }}"
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        {{ __('main.cancel') }}
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-[#79131d] text-white rounded-lg hover:bg-[#5a0f16] transition">
                        <i class="fas fa-save ml-2"></i>
                        {{ __('main.save_staff') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-panel>
