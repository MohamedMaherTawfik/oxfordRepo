<x-panel>

    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-yellow-100 border border-yellow-400 text-yellow-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        // user_ids اللي استلموا شهادة بالفعل
        $sentUserIds = $send->pluck('user_id')->toArray();
    @endphp

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">{{ __('messages.name') }}</th>
                    <th class="border px-4 py-2">{{ __('messages.email') }}</th>
                    <th class="border px-4 py-2">{{ __('messages.requested_at') }}</th>
                    <th class="border px-4 py-2">{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    {{-- ✅ لو المستخدم استلم شهادة قبل كده نخفي الصف --}}
                    @if (in_array($request->user_id, $sentUserIds))
                        @continue
                    @endif

                    <tr class="border-b" x-data="{ open: false }">
                        <td class="border px-4 py-2">{{ $request->user->name }}</td>
                        <td class="border px-4 py-2">{{ $request->user->email }}</td>
                        <td class="border px-4 py-2">{{ $request->created_at->format('d-m-Y H:i') }}</td>
                        <td class="border px-4 py-2 text-center">

                            <button @click="open = true"
                                class="px-4 py-2 bg-[#79131d] text-white rounded hover:bg-[#5C0810FF]">
                                {{ __('messages.send') }}
                            </button>

                            <!-- مودال إرسال الشهادة -->
                            <div x-show="open" x-transition
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white rounded-lg w-96 p-6 relative">
                                    <button @click="open = false"
                                        class="absolute top-2 right-2 text-gray-500 text-xl font-bold">&times;</button>

                                    <h2 class="text-xl font-semibold mb-4">
                                        {{ __('messages.send_certificate') }}
                                    </h2>

                                    <form action="{{ route('diplomas.send', $request->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-4">
                                            <label class="block mb-2">{{ __('messages.file') }}</label>
                                            <input type="file" name="certificate_file" required
                                                class="w-full border px-3 py-2 rounded" />
                                        </div>

                                        <div class="flex justify-end gap-2">
                                            <button type="button" @click="open = false"
                                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                                {{ __('messages.cancel') }}
                                            </button>

                                            <button type="submit"
                                                class="px-4 py-2 bg-[#79131d] text-white rounded hover:bg-[#5C0810FF]">
                                                {{ __('messages.send') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-panel>
