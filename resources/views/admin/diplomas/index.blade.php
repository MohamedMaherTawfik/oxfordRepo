<x-panel>

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('main.all_diplomas') }}</h1>

        <div class="flex items-center gap-3">
            <!-- Create Diploma Button -->
            <a href="{{ route('diplomas.create', 0) }}" class="px-4 py-2 bg-[#79131d] mt-2 mr-2 text-white rounded-lg">
                + {{ __('main.create_diploma') }}
            </a>
        </div>
    </div>


    <table class="w-full text-left border rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-3">#</th>
                <th class="py-2 px-3">{{ __('main.image') }}</th>
                <th class="py-2 px-3">{{ __('main.name') }}</th>
                <th class="py-2 px-3">{{ __('main.duration_hours') }}</th>
                <th class="py-2 px-3">{{ __('main.start_date') }}</th>
                <th class="py-2 px-3">{{ __('main.category') }}</th>
                <th class="py-2 px-3">{{ __('main.price') }}</th>
                <th class="py-2 px-3">{{ __('main.actions') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($diplomas as $diploma)
                <tr class="border-b">
                    <td class="py-2 px-3">{{ $loop->iteration }}</td>

                    <td class="py-2 px-3">
                        @if ($diploma->image && file_exists(public_path('storage/' . $diploma->image)))
                            <img src="{{ asset('storage/' . $diploma->image) }}"
                                class="w-16 h-16 rounded object-cover">
                        @else
                            <img src="https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM="
                                class="w-16 h-16 rounded object-cover">
                        @endif
                    </td>

                    <td class="py-2 px-3 font-bold">{{ $diploma->name ?? '---' }}</td>
                    <td class="py-2 px-3">{{ $diploma->duration ?? '---' }} {{ __('main.hours') }}</td>
                    <td class="py-2 px-3">{{ $diploma->start_date ?? '---' }}</td>
                    <td class="py-2 px-3">{{ $diploma->categorey->name ?? '---' }}</td>
                    <td class="py-2 px-3">{{ $diploma->price }} <img
                            src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                            alt="SAR" class="inline-block sar-symbol"></td>

                    <td class="py-2 px-3 flex items-center gap-2">
                        <!-- Notification Bell -->
                        <div class="relative">
                            <a href="{{ route('diplomas.requests', $diploma->id) }}"
                                class="text-gray-700 hover:text-[#79131d] transition text-2xl">
                                <i class="fa-solid fa-bell"></i>
                            </a>

                            @php
                                $notificationCount = $requests->where('diplomas_id', $diploma->id)->count();
                            @endphp

                            @if ($notificationCount > 0)
                                <span
                                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                                    {{ $notificationCount }}
                                </span>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('diplomas.edit', $diploma->id) }}"
                                class="px-3 py-1 bg-blue-600 text-white rounded">
                                {{ __('main.edit') }}
                            </a>
                            <a href="{{ route('diplomas.lesson', $diploma->id) }}"
                                class="px-3 py-1 bg-green-600 text-white rounded">
                                {{ __('main.show') }}
                            </a>
                            <a href="{{ route('admin.zoom.diploma.index', $diploma->id) }}"
                                class="px-3 py-1 bg-[#79131d] text-white rounded">
                                {{ __('main.meetings') }}
                            </a>
                            <a href="{{ route('diplomas.schedule', $diploma->id) }}"
                                class="px-3 py-1 bg-black text-white rounded">
                                {{ __('main.schedules') }}
                            </a>
                            <form action="{{ route('diplomas.delete', $diploma->id) }}" method="POST"
                                onsubmit="return confirm('{{ __('main.delete_confirm') }}')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">
                                    {{ __('main.delete') }}
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

</x-panel>
