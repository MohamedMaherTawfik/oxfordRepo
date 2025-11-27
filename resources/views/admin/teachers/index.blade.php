<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('main.manage_teachers') }}</h1>
                <p class="text-gray-600">{{ __('main.manage_teachers_desc') }}</p>

            </div>
            <a href="{{ route('admin.users.create') }}"
                class="flex items-center gap-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                <i class="fas fa-user-plus"></i>
                <span class="font-semibold">{{ __('main.add_user') }} +</span>
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">{{ __('main.total_teachers') }}</p>

                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $teachers->count() }}</h3>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <i class="fas fa-chalkboard-teacher text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center">
                    <i class="fas fa-chalkboard-teacher mr-3"></i>
                    قائمة المعلمين
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.user') }}</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.email') }}</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.role') }}</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.join_date') }}</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                {{ __('main.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($teachers as $teacher)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ $teacher->photo ? asset('storage/' . $teacher->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->name) . '&background=79131d&color=fff' }}"
                                            alt="{{ $teacher->name }}"
                                            class="w-10 h-10 rounded-full mr-3 border-2 border-gray-200">
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900">{{ $teacher->name }}</div>
                                            <div class="text-xs text-gray-500">ID: {{ $teacher->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $teacher->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $teacher->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $teacher->created_at->format('Y-m-d') }}
                                    <div class="text-xs text-gray-400">{{ $teacher->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.users.show', $teacher) }}"
                                            class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                            title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $teacher->id) }}"
                                            class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50 transition-colors"
                                            title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.users.delete', $teacher->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('{{ __('main.confirm_delete_teacher') }}');"
                                                class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                                title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-chalkboard-teacher text-6xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500 text-lg font-medium">لا يوجد معلمين</p>
                                        <a href="{{ route('admin.users.create') }}"
                                            class="mt-4 text-[#79131d] hover:text-[#5a0f16] font-semibold">
                                            إضافة معلم جديد
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-panel>
