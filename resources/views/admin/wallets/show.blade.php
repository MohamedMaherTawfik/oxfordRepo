<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('admin.wallets.index') }}" class="text-[#79131d] hover:text-[#5a0f16]">
                    <i class="fas fa-arrow-right text-xl"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">محفظة {{ $teacher->name }}</h1>
            </div>
        </div>

        <!-- Wallet Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white">
                <p class="text-blue-100 text-sm font-medium mb-2">الرصيد الحالي</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol">
                    <h3 class="text-3xl font-bold">{{ number_format($teacher->wallet->balance ?? 0, 2) }}</h3>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-xl p-6 text-white">
                <p class="text-green-100 text-sm font-medium mb-2">إجمالي الأرباح</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol">
                    <h3 class="text-3xl font-bold">{{ number_format($teacher->wallet->total_earned ?? 0, 2) }}</h3>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl shadow-xl p-6 text-white">
                <p class="text-orange-100 text-sm font-medium mb-2">إجمالي المسحوب</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol">
                    <h3 class="text-3xl font-bold">{{ number_format($teacher->wallet->total_withdrawn ?? 0, 2) }}</h3>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white">
                <p class="text-purple-100 text-sm font-medium mb-2">عدد الدورات المباعة</p>
                <h3 class="text-3xl font-bold">{{ $coursesSales->sum('sales_count') }}</h3>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">إجراءات سريعة</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-colors">
                        <i class="fas fa-plus mr-2"></i> إضافة رصيد
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute mt-2 w-full bg-white rounded-lg shadow-xl p-4 z-10">
                        <form action="{{ route('admin.wallets.addBalance', $teacher->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">المبلغ</label>
                                <input type="number" name="amount" step="0.01" min="0.01" required
                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">الوصف</label>
                                <textarea name="description" rows="3"
                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">إضافة</button>
                        </form>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-minus mr-2"></i> خصم رصيد
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute mt-2 w-full bg-white rounded-lg shadow-xl p-4 z-10">
                        <form action="{{ route('admin.wallets.deductBalance', $teacher->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">المبلغ</label>
                                <input type="number" name="amount" step="0.01" min="0.01" required
                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">الوصف</label>
                                <textarea name="description" rows="3"
                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">خصم</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Sales -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-book-open"></i>
                    مبيعات الدورات
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">الدورة</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">سعر المعلم</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">عدد المبيعات</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">إجمالي الأرباح</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($coursesSales as $sale)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $sale->title }}</td>
                            <td class="px-6 py-4">
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="w-4 h-4 sar-symbol inline">
                                {{ number_format($sale->teacher_price, 2) }}
                            </td>
                            <td class="px-6 py-4">{{ $sale->sales_count }}</td>
                            <td class="px-6 py-4 font-bold">
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="w-4 h-4 sar-symbol inline">
                                {{ number_format($sale->total_earned, 2) }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">لا توجد مبيعات</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Transactions History -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-history"></i>
                    سجل المعاملات
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">النوع</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">المبلغ</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">الوصف</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">بواسطة</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $transaction->type === 'credit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $transaction->type === 'credit' ? 'إضافة' : 'خصم' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold {{ $transaction->type === 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type === 'credit' ? '+' : '-' }}
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="w-4 h-4 sar-symbol inline">
                                {{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="px-6 py-4">{{ $transaction->description }}</td>
                            <td class="px-6 py-4">{{ $transaction->createdBy->name ?? 'نظام' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $transaction->created_at->format('Y-m-d H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">لا توجد معاملات</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-gray-50">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

    <style>
        .sar-symbol {
            display: inline-block !important;
            width: 1em !important;
            height: 1em !important;
            vertical-align: middle !important;
        }
        [x-cloak] { display: none !important; }
    </style>
</x-panel>

