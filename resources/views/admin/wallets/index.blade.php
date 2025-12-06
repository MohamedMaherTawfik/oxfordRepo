<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('main.wallets') }}</h1>
            <p class="text-gray-600">{{ __('main.manage_teacher_wallets') }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-dollar-sign text-2xl"></i>
                    </div>
                </div>
                <p class="text-blue-100 text-sm font-medium mb-2">{{ __('main.total_revenue') }}</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol">
                    <h3 class="text-3xl font-bold">{{ number_format($totalRevenue, 2) }}</h3>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-chalkboard-teacher text-2xl"></i>
                    </div>
                </div>
                <p class="text-green-100 text-sm font-medium mb-2">{{ __('main.total_teachers') }}</p>
                <div class="flex items-center gap-2">
                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                        alt="SAR" class="w-5 h-5 sar-symbol">
                    <h3 class="text-3xl font-bold">{{ number_format($totalTeacherEarnings, 2) }}</h3>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl shadow-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                        <i class="fas fa-hourglass-half text-2xl"></i>
                    </div>
                </div>
                <p class="text-orange-100 text-sm font-medium mb-2">{{ __('main.pending_withdrawals') }}</p>
                <h3 class="text-3xl font-bold">{{ $pendingWithdrawals->count() }}</h3>
            </div>
        </div>

        <!-- Pending Withdrawals -->
        @if($pendingWithdrawals->count() > 0)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-orange-500 to-red-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ __('main.withdrawal_requests') }}
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($pendingWithdrawals as $withdrawal)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $withdrawal->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $withdrawal->user->email }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900">
                                        <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                            alt="SAR" class="w-4 h-4 sar-symbol inline">
                                        {{ number_format($withdrawal->amount, 2) }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $withdrawal->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <form action="{{ route('admin.wallets.processWithdrawal', $withdrawal->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                                        <i class="fas fa-check mr-1"></i> {{ __('main.approve') }}
                                    </button>
                                </form>
                                <button onclick="showRejectModal({{ $withdrawal->id }})" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                    <i class="fas fa-times mr-1"></i> {{ __('main.reject') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Teachers Wallets -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-wallet"></i>
                    {{ __('main.wallets') }}
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('main.teacher_name') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('main.current_balance') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('main.total_earned') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase">{{ __('main.total_withdrawn') ?? 'إجمالي المسحوب' }}</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">{{ __('main.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($teachers as $teacher)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $teacher->photo ? asset('storage/' . $teacher->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->name) . '&background=79131d&color=fff' }}"
                                        alt="{{ $teacher->name }}"
                                        class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $teacher->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $teacher->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">
                                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                        alt="SAR" class="w-4 h-4 sar-symbol inline">
                                    {{ number_format($teacher->wallet->balance ?? 0, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                        alt="SAR" class="w-4 h-4 sar-symbol inline">
                                    {{ number_format($teacher->wallet->total_earned ?? 0, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                        alt="SAR" class="w-4 h-4 sar-symbol inline">
                                    {{ number_format($teacher->wallet->total_withdrawn ?? 0, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.wallets.show', $teacher->id) }}"
                                    class="bg-[#79131d] text-white px-4 py-2 rounded-lg hover:bg-[#5a0f16] transition-colors">
                                    <i class="fas fa-eye mr-1"></i> {{ __('main.view_details') }}
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                لا يوجد معلمين
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" style="display: none;">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('main.reject') }} {{ __('main.withdrawal_requests') }}</h3>
            <form id="rejectForm" method="POST">
                @csrf
                <input type="hidden" name="action" value="reject">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('main.notes') }}</label>
                    <textarea name="notes" rows="4" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d]" required></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeRejectModal()" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">{{ __('main.cancel') }}</button>
                    <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600">{{ __('main.reject') }}</button>
                </div>
            </form>
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

    <script>
        function showRejectModal(withdrawalId) {
            document.getElementById('rejectForm').action = `/admin/wallets/withdrawals/${withdrawalId}/process`;
            document.getElementById('rejectModal').style.display = 'flex';
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').style.display = 'none';
        }
    </script>
</x-panel>

