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

    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ __('main.manage_staff') }}</h1>
            <a href="{{ route('admin.staff.create') }}"
                class="bg-[#79131d] text-white px-6 py-3 rounded-lg shadow hover:bg-[#5a0f16] transition">
                <i class="fas fa-user-plus ml-2"></i>
                {{ __('main.add_new_staff') }}
            </a>
        </div>

        @if ($staff->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full">
                    <thead class="bg-[#79131d] text-white">
                        <tr>
                            <th class="px-6 py-4 text-right">{{ __('main.name') }}</th>
                            <th class="px-6 py-4 text-right">{{ __('main.email') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('main.permissions') }}</th>
                            <th class="px-6 py-4 text-right">{{ __('main.created_at') }}</th>
                            <th class="px-6 py-4 text-center">{{ __('main.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($staff as $member)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-300 rounded-full mr-3">
                                            <img src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('images/default-avatar.png') }}"
                                                alt="Photo" class="w-full h-full object-cover rounded-full">
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $member->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $member->email }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1 justify-center">
                                        @if ($member->staffPermissions)
                                            @if ($member->staffPermissions->manage_users)
                                                <span
                                                    class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">{{ __('main.users') }}</span>
                                            @endif
                                            @if ($member->staffPermissions->manage_courses)
                                                <span
                                                    class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">{{ __('main.courses') }}</span>
                                            @endif
                                            @if ($member->staffPermissions->manage_teachers)
                                                <span
                                                    class="px-2 py-1 text-xs bg-purple-100 text-purple-800 rounded">{{ __('main.teachers') }}</span>
                                            @endif
                                            @if ($member->staffPermissions->manage_payments)
                                                <span
                                                    class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">{{ __('main.payments') }}</span>
                                            @endif
                                        @else
                                            <span class="text-gray-400 text-sm">{{ __('main.no_permissions') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $member->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center space-x-3 space-x-reverse">
                                        <a href="{{ route('admin.staff.show', $member->id) }}"
                                            class="text-blue-600 hover:text-blue-800" title="{{ __('main.view') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.staff.edit', $member->id) }}"
                                            class="text-yellow-600 hover:text-yellow-800"
                                            title="{{ __('main.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.staff.destroy', $member->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('{{ __('main.confirm_delete_staff') }}');"
                                                class="text-red-600 hover:text-red-800"
                                                title="{{ __('main.delete') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <i class="fas fa-users text-gray-400 text-6xl mb-4"></i>
                <p class="text-gray-600 text-lg">{{ __('main.no_staff_yet') }}</p>
                <a href="{{ route('admin.staff.create') }}"
                    class="mt-4 inline-block bg-[#79131d] text-white px-6 py-3 rounded-lg hover:bg-[#5a0f16] transition">
                    {{ __('main.add_new_staff') }}
                </a>
            </div>
        @endif
    </div>
</x-panel>
