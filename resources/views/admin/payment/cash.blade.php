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



    <div class="p-6">
        <h2 class="text-xl font-bold mb-6">الدفع عند الحضور</h2>

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-3 text-center">#</th>
                        <th class="border px-4 py-3 text-center">اسم الطالب</th>
                        <th class="border px-4 py-3 text-center">البريد الإلكتروني</th>
                        <th class="border px-4 py-3 text-center">السعر</th>
                        <th class="border px-4 py-3 text-center">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enrollments as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2 text-center">
                                {{ $item->user->name ?? '---' }}
                            </td>
                            <td class="border px-4 py-2 text-center">
                                {{ $item->user->email ?? '---' }}
                            </td>
                            <td class="border px-4 py-2 text-center font-semibold text-[#79131d]">
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg" alt="SAR" class="inline-block sar-symbol"> {{ $item->price }}
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <form action="{{ route('admin.payments.success', $item) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 rounded-lg font-semibold bg-[#79131d] text-white hover:bg-[#5a0f16] transition">
                                        تم الدفع
                                    </button>
                                </form>
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                لا توجد مدفوعات كاش حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-panel>
