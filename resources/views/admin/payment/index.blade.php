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
        <h2 class="text-xl font-bold mb-6">إعدادات الدفع</h2>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Visa -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col gap-4">
                <h3 class="text-lg font-semibold">Visa</h3>
                <span
                    class="inline-block px-4 py-2 rounded-full text-sm font-bold w-fit
{{ $visa->visa_enable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $visa->visa_enable ? 'فعال' : 'غير فعال' }}
                </span>
                <button onclick="openModal('visa')"
                    class="mt-2 bg-[#79131d] w-[10%] text-white px-4 py-2 rounded-lg hover:bg-[#5a0f16] transition">
                    تعديل
                </button>
            </div>


            <!-- Cash -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col gap-4">
                <h3 class="text-lg font-semibold">Cash</h3>
                <span
                    class="inline-block px-4 py-2 rounded-full text-sm font-bold w-fit
                    {{ $visa->cash_enable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $visa->cash_enable ? 'فعال' : 'غير فعال' }}
                </span>

                <div class="flex items-center gap-3">
                    <button onclick="openModal('cash')"
                        class="mt-2 bg-[#79131d] text-white px-4 py-2 rounded-lg hover:bg-[#5a0f16] transition">
                        تعديل
                    </button>

                    <a href="{{ route('admin.payments.cash') }}"
                        class="mt-2  bg-[#79131d]  text-white px-4 py-2 rounded-lg hover:bg-[#5a0f16] transition">
                        عرض الطلاب
                    </a>
                </div>
            </div>

        </div>
        <!-- Modal -->
        <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">تعديل حالة الدفع</h3>


                <form action="{{ route('admin.payments.edit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" id="paymentType">


                    <label class="block mb-2 font-semibold">الحالة</label>
                    <select name="status" class="w-full border rounded-lg p-2">
                        <option value="1">فعال</option>
                        <option value="0">غير فعال</option>
                    </select>


                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-lg bg-gray-300">
                            إلغاء
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-[#79131d] text-white">
                            حفظ
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <script>
            function openModal(type) {
                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editModal').classList.add('flex');
                document.getElementById('paymentType').value = type;
            }


            function closeModal() {
                document.getElementById('editModal').classList.add('hidden');
                document.getElementById('editModal').classList.remove('flex');
            }
        </script>
</x-panel>
