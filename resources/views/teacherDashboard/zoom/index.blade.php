<x-panel>
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6 mt-3">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mr-2">{{ __('teacher.meetings') }}</h1>
            <a href="{{ route('zoom.create', $course) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow">
                + {{ __('teacher.new_meeting') }}
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border text-left">{{ __('teacher.topic') }}</th>
                        <th class="px-4 py-2 border">{{ __('teacher.date') }}</th>
                        <th class="px-4 py-2 border">{{ __('teacher.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($meetings as $m)
                        <tr class="text-center hover:bg-gray-50 transition">
                            <td class="px-4 py-2 border font-medium">{{ $m->id }}</td>
                            <td class="px-4 py-2 border text-left">{{ $m->class_topic }}</td>
                            <td class="px-4 py-2 border">
                                {{ \Carbon\Carbon::parse($m->class_date_and_time)->format('d M Y, h:i A') }}
                            </td>
                            <td class="px-4 py-2 border space-x-2">
                                <a href="{{ route('zoom.join', $m->id) }}"
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded shadow">
                                    {{ __('teacher.join_web') }}
                                </a>
                                <a href="{{ $m->join_url }}" target="_blank"
                                    class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded shadow">
                                    {{ __('teacher.open_app') }}
                                </a>
                                <a href="{{ route('zoom.delete', $m->id) }}"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow"
                                    onclick="return confirm('{{ __('teacher.confirm_delete') }}')">
                                    {{ __('teacher.delete') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                {{ __('teacher.no_meetings') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-panel>
