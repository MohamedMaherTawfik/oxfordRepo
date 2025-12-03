<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">دوراتي</h1>
                <p class="text-gray-600">عرض وإدارة الدورات الخاصة بي</p>
            </div>
            <a href="{{ route('admin.courses.create') }}"
                class="flex items-center gap-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                <i class="fas fa-plus"></i>
                <span class="font-semibold">إضافة دورة جديدة</span>
            </a>
        </div>

        <!-- Stats Card -->
        <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-[#79131d] mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">إجمالي دوراتي</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $courses->count() }}</h3>
                </div>
                <div class="bg-[#79131d]/10 rounded-full p-3">
                    <i class="fas fa-book-open text-[#79131d] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Courses Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center">
                    <i class="fas fa-list mr-3"></i>
                    قائمة دوراتي
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                الصورة</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                الدورة</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                التصنيف</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                المدة</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                السعر</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                سعر الأدمن</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($courses as $course)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Image -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                        <img src="{{ $course->cover_photo && file_exists(public_path('storage/' . $course->cover_photo))
                                            ? asset('storage/' . $course->cover_photo)
                                            : asset('images/coursePlace.png') }}"
                                            alt="{{ $course->title }}" class="w-full h-full object-cover">
                                    </div>
                                </td>

                                <!-- Course Info -->
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <h3 class="text-sm font-bold text-gray-900 mb-1">{{ $course->title }}</h3>
                                        <p class="text-xs text-gray-500 mb-2 line-clamp-2">
                                            {{ Str::limit($course->description, 60) }}</p>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-[#79131d]/10 text-[#79131d]">
                                                {{ ucfirst($course->level ?? 'Beginner') }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                {{ \Carbon\Carbon::parse($course->start_Date)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $course->category->name ?? 'General' }}
                                    </span>
                                </td>

                                <!-- Duration -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center text-sm text-gray-600">
                                        <i class="far fa-clock mr-1"></i>
                                        <span>{{ $course->duration ?? 0 }} {{ __('messages.hours') }}</span>
                                    </div>
                                </td>

                                <!-- Price -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                            alt="SAR" class="sar-symbol"
                                            style="width: 1em; height: 1em; vertical-align: middle; display: inline-block;"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                        <span style="display: none;">ر.س</span>
                                        <span
                                            class="text-sm font-bold text-gray-900">{{ number_format($course->price ?? 0, 2) }}</span>
                                    </div>
                                </td>

                                <!-- Admin Price -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                            alt="SAR" class="sar-symbol"
                                            style="width: 1em; height: 1em; vertical-align: middle; display: inline-block;"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                        <span style="display: none;">ر.س</span>
                                        <span
                                            class="text-sm font-bold text-[#79131d]">{{ number_format($course->admin_price ?? 0, 2) }}</span>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openModal('{{ $course->id }}')"
                                            class="text-[#e4ce96] hover:text-[#d4be86] p-2 rounded-lg hover:bg-[#79131d]/10 transition-colors"
                                            title="تعديل سعر الأدمن">
                                            <i class="fas fa-dollar-sign"></i>
                                        </button>
                                        <a href="{{ route('admin.courses.show', $course->slug) }}"
                                            class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                            title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.courses.edit', $course->slug) }}"
                                            class="text-yellow-600 hover:text-yellow-800 p-2 rounded-lg hover:bg-yellow-50 transition-colors"
                                            title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('هل أنت متأكد من حذف هذه الدورة؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                                title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal for Admin Price -->
                            <div id="modal-{{ $course->id }}"
                                class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
                                <div class="bg-white rounded-xl shadow-2xl w-96 p-6 relative transform transition-all">
                                    <button onclick="closeModal('{{ $course->id }}')"
                                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-xl">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h3 class="text-xl font-bold text-[#79131d] mb-4 flex items-center">
                                        <i class="fas fa-dollar-sign mr-2"></i>
                                        {{ __('messages.admin_price') }}
                                    </h3>

                                    <form method="POST" action="{{ route('admin.courses.adminPrice', $course->id) }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="admin_price_{{ $course->id }}"
                                                class="block text-sm font-semibold text-gray-700 mb-2">
                                                {{ __('messages.price') }}
                                            </label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <img src="https://www.sama.gov.sa/ar-sa/Currency/Documents/Saudi_Riyal_Symbol-2.svg"
                                                        alt="SAR" class="w-4 h-4 sar-symbol"
                                                        style="display: inline-block;">
                                                </div>
                                                <input type="number" step="0.01" name="admin_price"
                                                    id="admin_price_{{ $course->id }}"
                                                    value="{{ $course->admin_price ?? 0 }}"
                                                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 pr-10 focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] text-right"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="flex justify-end gap-3">
                                            <button type="button" onclick="closeModal('{{ $course->id }}')"
                                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                                                {{ __('teacher.cancel') }}
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white rounded-lg hover:shadow-lg transition-all font-medium">
                                                <i class="fas fa-save mr-2"></i>
                                                {{ __('teacher.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500 text-lg font-medium">لا توجد دورات</p>
                                        <a href="{{ route('admin.courses.create') }}"
                                            class="mt-4 text-[#79131d] hover:text-[#5a0f16] font-semibold">
                                            إضافة دورة جديدة
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal on outside click
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('bg-black/50')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
            }
        });
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sar-symbol {
            display: inline-block !important;
            width: 1em !important;
            height: 1em !important;
            vertical-align: middle !important;
            margin-left: 2px;
        }

        .sar-symbol img {
            width: 100% !important;
            height: 100% !important;
            display: block !important;
        }
    </style>
</x-panel>
