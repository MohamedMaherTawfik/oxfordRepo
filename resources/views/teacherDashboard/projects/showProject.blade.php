<x-teacher-panel>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <!-- Table Header -->
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('teacher.username') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('teacher.title') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('teacher.pdf') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('teacher.status') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('teacher.actions') }}
                    </th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="divide-y divide-gray-200 mt-2">
                @if ($projects->isEmpty())
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            {{ __('teacher.no_projects') }}
                        </td>
                    </tr>
                @else
                    @foreach ($projects as $project)
                        <tr class="hover:bg-gray-50 transition">
                            <!-- اسم المستخدم -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ Auth::user()->name }}
                            </td>

                            <!-- عنوان المشروع -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $project->title }}
                            </td>

                            <!-- رابط الملف -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ asset('storage/' . $project->file) }}" target="_blank"
                                    class="inline-flex items-center justify-center w-10 h-10 bg-[#79131DD0] text-white rounded-md hover:bg-[#79131d] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
                                    title="{{ __('teacher.view_pdf') }}">
                                    <i class="fa-solid fa-file-pdf text-[#e4ce96] text-xl"></i>
                                </a>
                            </td>

                            <!-- الحالة -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $project->status }}
                            </td>

                            <!-- الإجراءات -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex items-center gap-2">
                                <!-- تعديل -->
                                <a href="{{ route('teacher.project.edit', $project->slug) }}"
                                    class="p-2 text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 rounded-full transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                                    title="{{ __('teacher.edit') }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>

                                <!-- حذف -->
                                <form action="{{ route('teacher.project.delete', $project->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('teacher.confirm_delete') }}')"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 rounded-full transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
                                        title="{{ __('teacher.delete') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
</x-teacher-panel>
