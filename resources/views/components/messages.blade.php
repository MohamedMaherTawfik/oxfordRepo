{{-- Success Message --}}
@if (session('success'))
    <div class="mb-4 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 shadow-md">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-xl mr-3"></i>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    </div>
@endif

{{-- Error Message --}}
@if (session('error'))
    <div class="mb-4 p-4 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 shadow-md">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-xl mr-3"></i>
            <span class="font-semibold">{{ session('error') }}</span>
        </div>
    </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="mb-4 p-4 rounded-xl bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 text-yellow-800 shadow-md">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-xl mr-3 mt-1"></i>
            <div>
                <p class="font-semibold mb-2">يرجى تصحيح الأخطاء التالية:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

