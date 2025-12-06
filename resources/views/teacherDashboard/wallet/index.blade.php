<x-teacher-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('teacher.wallet') }}</h1>
            <p class="text-gray-600">{{ __('teacher.view_course_sales_and_profits') }}</p>
        </div>

        <!-- Wallet Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-wallet text-2xl"></i>
                    </div>
                </div>
                <p class="text-blue-100 text-sm font-medium mb-2">{{ __('teacher.current_balance') }}</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol">
                    <h3 class="text-3xl font-bold">{{ number_format($teacher->wallet->balance ?? 0, 2) }}</h3>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-dollar-sign text-2xl"></i>
                    </div>
                </div>
                <p class="text-green-100 text-sm font-medium mb-2">{{ __('teacher.total_profits') }}</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol">
                    <h3 class="text-3xl font-bold">{{ number_format($teacher->wallet->total_earned ?? 0, 2) }}</h3>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-book-open text-2xl"></i>
                    </div>
                </div>
                <p class="text-purple-100 text-sm font-medium mb-2">{{ __('teacher.total_sales') }}</p>
                <h3 class="text-3xl font-bold">{{ $coursesSales->sum('sales_count') }}</h3>
            </div>
        </div>

        <!-- Withdrawal Request -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">{{ __('teacher.withdrawal_request') }}</h2>
            <form action="{{ route('teacher.wallet.requestWithdrawal') }}" method="POST" class="flex gap-4">
                @csrf
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('teacher.amount') }}</label>
                    <input type="number" name="amount" step="0.01" min="0.01" max="{{ $teacher->wallet->balance ?? 0 }}" required
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d]"
                        placeholder="{{ __('teacher.enter_withdrawal_amount') }}">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-lg hover:shadow-lg transition-all">
                        <i class="fas fa-paper-plane mr-2"></i> {{ __('teacher.send_withdrawal_request') }}
                    </button>
                </div>
            </form>
            <p class="text-sm text-gray-500 mt-2">{{ __('teacher.maximum_withdrawal') }}: 
                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                    alt="SAR" class="w-4 h-4 sar-symbol inline">
                {{ number_format($teacher->wallet->balance ?? 0, 2) }}
            </p>
        </div>

        <!-- Courses Sales -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-book-open"></i>
                    {{ __('teacher.course_sales') }}
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.course') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.teacher_price') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.sales_count') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.total_earned') }}</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($coursesSales as $sale)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <a href="{{ route('teacher.courses.show', $sale->slug) }}" class="text-[#79131d] hover:text-[#5a0f16] font-semibold">
                                    {{ $sale->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="w-4 h-4 sar-symbol inline">
                                {{ number_format($sale->teacher_price, 2) }}
                            </td>
                            <td class="px-6 py-4">{{ $sale->sales_count }}</td>
                            <td class="px-6 py-4 font-bold text-green-600">
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="w-4 h-4 sar-symbol inline">
                                {{ number_format($sale->total_earned, 2) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('teacher.courses.show', $sale->slug) }}"
                                    class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                                    <p>{{ __('teacher.no_sales_yet') }}</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Withdrawal Requests -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-history"></i>
                    {{ __('teacher.withdrawal_requests') }}
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.amount') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.status') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.notes') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.date') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($withdrawalRequests as $request)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-bold">
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="w-4 h-4 sar-symbol inline">
                                {{ number_format($request->amount, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($request->status === 'approved') bg-green-100 text-green-800
                                    @elseif($request->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    @if($request->status === 'approved') {{ __('teacher.approved') }}
                                    @elseif($request->status === 'rejected') {{ __('teacher.rejected') }}
                                    @else {{ __('teacher.pending') }}
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $request->notes ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $request->created_at->format('Y-m-d H:i') }}
                                @if($request->processed_at)
                                <div class="text-xs text-gray-400">{{ __('teacher.processed_at') }}: {{ $request->processed_at->format('Y-m-d H:i') }}</div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">{{ __('teacher.no_withdrawal_requests') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-gray-50">
                {{ $withdrawalRequests->links() }}
            </div>
        </div>

        <!-- Transactions History -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-history"></i>
                    {{ __('teacher.transaction_history') }}
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.type') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.amount') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.description') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('teacher.date') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $transaction->type === 'credit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $transaction->type === 'credit' ? __('teacher.credit') : __('teacher.debit') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold {{ $transaction->type === 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type === 'credit' ? '+' : '-' }}
                                <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                    alt="SAR" class="w-4 h-4 sar-symbol inline">
                                {{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="px-6 py-4">{{ $transaction->description }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $transaction->created_at->format('Y-m-d H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">{{ __('teacher.no_transactions') }}</td>
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
    </style>
</x-teacher-panel>

