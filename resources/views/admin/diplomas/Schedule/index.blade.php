<x-panel>

    <h1 class="text-2xl font-bold mb-4">
        {{ __('main.schedule_for') }}: {{ $diploma->name }}
    </h1>

    <!-- Create Button -->
    <button onclick="openCreateModal()" class="px-4 py-2 bg-blue-600 text-white rounded mb-4 w-[10%] ml-2">
        + {{ __('main.add_schedule') }}
    </button>

    <!-- Table -->
    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-3 text-left">{{ __('main.day') }}</th>
                <th class="p-3 text-left">{{ __('main.start_time') }}</th>
                <th class="p-3 text-left">{{ __('main.end_time') }}</th>
                <th class="p-3 text-left">{{ __('main.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diploma->courseSchedule as $schedule)
                <tr class="border-b">
                    <td class="p-3">{{ $schedule->day }}</td>
                    <td class="p-3">{{ $schedule->start_time }}</td>
                    <td class="p-3">{{ $schedule->end_time }}</td>
                    <td class="p-3 flex gap-2">

                        <!-- Edit -->
                        <button
                            onclick="openEditModal('{{ $schedule->id }}','{{ $schedule->day }}','{{ $schedule->start_time }}','{{ $schedule->end_time }}')"
                            class="px-3 py-1 bg-yellow-500 text-white rounded">
                            {{ __('main.edit') }}
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('diplomas.schedule.delete', $diploma->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                            <button class="px-3 py-1 bg-red-600 text-white rounded"
                                onclick="return confirm('{{ __('main.delete_confirm') }}')">
                                {{ __('main.delete') }}
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Create Modal -->
    <div id="createModal" class="fixed inset-0 bg-black/50 hidden flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">{{ __('main.add_schedule') }}</h2>

            <form action="{{ route('diplomas.schedule.store', $diploma->id) }}" method="POST">
                @csrf

                <label class="block mb-2">{{ __('main.day') }}</label>
                <input type="date" name="day" class="w-full p-2 border rounded mb-3">

                <label class="block mb-2">{{ __('main.start_time') }}</label>
                <input type="time" name="start_time" class="w-full p-2 border rounded mb-3">

                <label class="block mb-2">{{ __('main.end_time') }}</label>
                <input type="time" name="end_time" class="w-full p-2 border rounded mb-3">

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeCreateModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded">{{ __('main.cancel') }}</button>
                    <button class="px-4 py-2 bg-green-600 text-white rounded">{{ __('main.save') }}</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">{{ __('main.edit_schedule') }}</h2>

            <form action="{{ route('diplomas.schedule.update', $diploma->id) }}" method="POST">
                @csrf
                <input type="hidden" name="schedule_id" id="edit_id">

                <label class="block mb-2">{{ __('main.day') }}</label>
                <input type="date" name="day" id="edit_day" class="w-full p-2 border rounded mb-3">

                <label class="block mb-2">{{ __('main.start_time') }}</label>
                <input type="time" name="start_time" id="edit_start_time" class="w-full p-2 border rounded mb-3">

                <label class="block mb-2">{{ __('main.end_time') }}</label>
                <input type="time" name="end_time" id="edit_end_time" class="w-full p-2 border rounded mb-3">

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded">{{ __('main.cancel') }}</button>
                    <button class="px-4 py-2 bg-green-600 text-white rounded">{{ __('main.update') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        function openEditModal(id, day, start, end) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_day').value = day;
            document.getElementById('edit_start_time').value = start;
            document.getElementById('edit_end_time').value = end;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

</x-panel>
