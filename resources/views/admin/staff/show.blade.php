<x-panel>
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 text-right">{{ __('main.staff_details') }}</h2>
                    <div class="flex space-x-3 space-x-reverse">
                        <a href="{{ route('admin.staff.edit', $staff->id) }}"
                            class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            <i class="fas fa-edit ml-2"></i>
                            {{ __('main.edit') }}
                        </a>
                        <a href="{{ route('admin.staff.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            <i class="fas fa-arrow-right ml-2"></i>
                            {{ __('main.back') }}
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4 text-right">{{ __('main.personal_info') }}
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-gray-600 text-sm">{{ __('main.name') }}:</span>
                                <p class="text-gray-900 font-medium text-right">{{ $staff->name }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600 text-sm">{{ __('main.email') }}:</span>
                                <p class="text-gray-900 font-medium text-right">{{ $staff->email }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600 text-sm">{{ __('main.role') }}:</span>
                                <p class="text-gray-900 font-medium text-right">{{ $staff->role }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600 text-sm">{{ __('main.created_at') }}:</span>
                                <p class="text-gray-900 font-medium text-right">
                                    {{ $staff->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4 text-right">{{ __('main.permissions') }}
                        </h3>
                        @if ($staff->staffPermissions)
                            <div class="grid grid-cols-2 gap-2">
                                @if ($staff->staffPermissions->manage_users)
                                    <span
                                        class="px-3 py-1 bg-blue-100 text-blue-800 rounded text-sm text-center">{{ __('main.users') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_teachers)
                                    <span
                                        class="px-3 py-1 bg-purple-100 text-purple-800 rounded text-sm text-center">{{ __('main.teachers') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_courses)
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-800 rounded text-sm text-center">{{ __('main.courses') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_categories)
                                    <span
                                        class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded text-sm text-center">{{ __('main.categories') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_diplomas)
                                    <span
                                        class="px-3 py-1 bg-pink-100 text-pink-800 rounded text-sm text-center">{{ __('main.diplomas') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_payments)
                                    <span
                                        class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded text-sm text-center">{{ __('main.payments') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_certificates)
                                    <span
                                        class="px-3 py-1 bg-teal-100 text-teal-800 rounded text-sm text-center">{{ __('main.certificates') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_applies)
                                    <span
                                        class="px-3 py-1 bg-orange-100 text-orange-800 rounded text-sm text-center">{{ __('main.teacher_requests') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_homepage)
                                    <span
                                        class="px-3 py-1 bg-red-100 text-red-800 rounded text-sm text-center">{{ __('main.homepage') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_footer)
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-800 rounded text-sm text-center">{{ __('main.footer') }}</span>
                                @endif
                                @if ($staff->staffPermissions->manage_staff)
                                    <span
                                        class="px-3 py-1 bg-cyan-100 text-cyan-800 rounded text-sm text-center">{{ __('main.staff') }}</span>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-500 text-right">{{ __('main.no_permissions_defined') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-panel>
