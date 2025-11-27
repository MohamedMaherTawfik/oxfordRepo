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

    <!-- Create Button -->
    <button onclick="document.getElementById('createModal').showModal()"
        class="bg-[#79131d] text-white px-4 py-2 w-[10%] ml-2 rounded-lg mb-4">
        + {{ __('main.create_category') }}
    </button>

    <!-- TABLE -->
    <table class="w-full text-left border mt-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">{{ __('main.name') }}</th>
                <th class="py-2 px-3">{{ __('main.photo') }}</th>
                <th class="py-2 px-3">{{ __('main.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diplomasCategorey as $cat)
                <tr class="border-b">
                    <td class="py-2 px-3">{{ $loop->iteration }}</td>
                    <td class="py-2 px-3">{{ $cat->name }}</td>
                    <td class="py-2 px-3">
                        <img src="{{ asset('storage/' . $cat->photo) }}" class="w-16 h-16 object-cover rounded" />
                    </td>
                    <td class="py-2 px-3 flex gap-2">
                        <!-- Edit -->
                        <button onclick="document.getElementById('editModal{{ $cat->id }}').showModal()"
                            class="px-3 py-1 bg-blue-600 text-white rounded">
                            {{ __('main.edit') }}
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('diplomas.categorey.delete', $cat->id) }}" method="POST"
                            onsubmit="return confirm('{{ __('main.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">{{ __('main.delete') }}</button>
                        </form>
                    </td>
                </tr>

                <!-- EDIT MODAL -->
                <dialog id="editModal{{ $cat->id }}" class="p-6 rounded-xl shadow-xl w-96">
                    <h2 class="text-xl mb-3 font-bold">{{ __('main.edit_category') }}</h2>

                    <form action="{{ route('diplomas.categorey.update', $cat->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <label class="block mb-2">{{ __('main.name') }}:</label>
                        <input type="text" name="name" value="{{ $cat->name }}"
                            class="w-full border p-2 rounded mb-4">

                        <label class="block mb-2">{{ __('main.photo') }}:</label>
                        <input type="file" name="photo" class="w-full border p-2 rounded mb-4">

                        <button class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('main.update') }}</button>
                        <button type="button"
                            onclick="document.getElementById('editModal{{ $cat->id }}').close()"
                            class="ml-2 px-4 py-2 border rounded">{{ __('main.cancel') }}</button>
                    </form>
                </dialog>
            @endforeach
        </tbody>
    </table>

    <!-- CREATE MODAL -->
    <dialog id="createModal" class="p-6 rounded-xl shadow-xl w-96">
        <h2 class="text-xl mb-3 font-bold">{{ __('main.create_category') }}</h2>

        <form action="{{ route('diplomas.categorey.create', 0) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block mb-2">{{ __('main.name') }}:</label>
            <input type="text" name="name" class="w-full border p-2 rounded mb-4">

            <label class="block mb-2">{{ __('main.photo') }}:</label>
            <input type="file" name="photo" class="w-full border p-2 rounded mb-4">

            <button class="bg-green-600 text-white px-4 py-2 rounded">{{ __('main.create') }}</button>
            <button type="button" onclick="document.getElementById('createModal').close()"
                class="ml-2 px-4 py-2 border rounded">{{ __('main.cancel') }}</button>
        </form>
    </dialog>

</x-panel>
