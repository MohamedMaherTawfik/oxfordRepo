<x-panel>
    @include('components.messages')

    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">جميع الدورات</h1>
                <p class="text-gray-600">عرض وإدارة جميع الدورات المتاحة</p>
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
                    <p class="text-gray-500 text-sm font-medium">إجمالي الدورات</p>
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
                    قائمة الدورات
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
                                المدرب</th>
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
                                            : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMwAAADACAMAAAB/Pny7AAAAKlBMVEXMzMzy8vL19fXS0tLh4eHZ2dnr6+vv7+/JycnPz8/k5OTc3NzV1dXo6Og1EEG5AAAFxklEQVR4nO2b2XajMAxAjXfZ5v9/d7wRjAMpBCKSOboPnbbpFN/IktcyRhAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRBfj43c3YaLsEwE78Pv61gLyrvRcK7F3W05RexaIokMnA8R95OhgfQhhUQ+RBL67na9ibVCamOGBSbc3azDpMLlY0SakEz4H+tnOSSzR/6Xxy9L0tzdut2kRAE/dgHhg3EKgi5JA3c3cicglDO8NYmfmlGKNFxaltPHqB/oZyBC7lu8E1FsGvety6/5e9v5B7GtQqV07yPivGBNGKz/9qSxScTptnPFz4x2PgDrOhTkV791EmAhNIP7ZBJFlOhF8o8bnpMGv6F/EFM6ZvtyKInRSUkitupVThrDvyxpYkoHWUX45BFnkS6LbFYrq9IPc/c9xTmFJI4ki3EkhcS1EQHIk4A+Zyz/pqSJE8fgSv1t81371L626Ra8NqNfxgBsrnj8O5Im1FkKr9U357MLdSRpWm597oG8n1bKHBqJ2eaOPEcBkWcpi7JldHzvV5fCcvqhzkZkmfHOpIGgnOaLaUoSkWEr18Nj3t83vPzfu5ImTrdkWu+2MTGpAK+HpCDnnx0WCWJL5Wi/hzRTs0mkmziWd3aU3ssXmMZ8bF/wI++/h1ANLIvrXaeHoReZq3EZW1Z5KtzdC+23EGbRabq1JXIxn94VSF17OQX+JB+WgYWJGc306XbPOszjAeazLlbUR8VHjnFwF3rS0pdhImXs/axMnFeVsX0Yy0y+yHBnrwVKaftwZOpwwDWUQlMjc3nVyWPr52XqXL1+WWT05TL5935cplSAx1SkPvSMzOpxRsCRsaUD1DlUicwJmbxRoETnY7Fkcm5Oc6jTMsKZNDXt18tI3YyVpJEwP/R9GatqEe7PM7Bk6q7QJTLwGH65XPwOrALAdF5Iivmhb8tYyecxeLG6wYpMXeCq+aHvyzQnNMvlP5pMKMU5r5nPycDQyCyyBk1GlC378zLA2hmyv0WGufxOisdD35dp153qHhlfivM80Xw7Z3wz3b+nADBVivN5GfYIDY+BaW3wZPKTDL9AxoZp0Ox2//BkWD7nykmzIbP/Jkw6rx2Gsd+IQZTxw5Q0qzIgpNt/pg8hPJ90IMqotD2TJ/6rMnEuemibaCWOiDJCp8MXDrAqY3PgBnlmkYMoU5MmvvlrMnEBn2ZvcY7wPogythTncVUmnVmUaqvfvwyDKRPqjGZNJvXBOniUA9eS3cfOKjC7GZQt+2BXZHy7yylbB+V3hwpTpp5MyBUZ0V68iokjptfS4sXInQHClCkFKybNs4zsNvpNvXtp88rBjPuCgxqZugyAJxlhur10bspmRT1MisHZc4iEKsPywwbVyYCV/bkAL1diagFMH+aetw2qjHU1v7vIiGGNMdjQppL/c+6GK6NKK7vI1E215+CkvfbmpfGrZBjk3NAqt/4hI9ZcJqHFa3nqtl3acGXYmC+OyTYyYM3zLdINtXxN5ltkrMzv9NjK1L6308aoF2MOskzIjSp3k6dupvfFZfJx2zcYkLsZa8pTlfEHVIY8E9086UeWaQtXkYll+uDhc1z6w3pdw5ZRnYyV263eDs64viLF7mbQycChjHnYmNXgYMvYuVMlGavMi0ZvuaQPeuXPgNBlxqXMG71s4vnKHLYMC48RMncz9/7Vk+e7megybBGZMzLD0815dBmrr5NJS9J7ZfxV3az8kvZCLX43C0uZcy6RZk8XXwamYnxJZOYV9i0ybCrOWUaZC26aueU1FkwZ38qw8Oqi6U78fTKh7WYJOMn0iy26DFio+0o/e0WrBaaNpR2bR4eom4yo1YzVZQAfFIgr8QZdprnZf76QdWXtBhmYZ85X3nCeztNxZfpt8mvBljm4h3FQ5voq+RJwl6fLDPpfOkLw6lME+z1/HEgQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEEQBEH8D/wDnXg4+PJhj2oAAAAASUVORK5CYII=' }}"
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

                                <!-- Instructor -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 mr-2 overflow-hidden">
                                            <img src="{{ $course->user->photo ? asset('storage/' . $course->user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($course->user->name) . '&background=79131d&color=fff' }}"
                                                alt="{{ $course->user->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <span class="text-sm text-gray-900">{{ $course->user->name ?? 'N/A' }}</span>
                                    </div>
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
                                        @if ($course->user_id == auth()->user()->id)
                                            <a href="{{ route('admin.courses.show', $course->slug) }}"
                                                class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors"
                                                title="عرض">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
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

                                    <form method="POST"
                                        action="{{ route('admin.courses.adminPrice', $course->id) }}">
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
                                                        alt="SAR" class="w-4 h-4">
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
                                <td colspan="8" class="px-6 py-12 text-center">
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
