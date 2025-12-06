<x-teacher-panel>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4" 
         dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ __('teacher.add_schedule') }}</h2>
                        <p class="text-gray-600">{{ $course->title }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white px-6 py-3 rounded-lg">
                        <span class="text-lg font-semibold">
                            @php
                                $dayNames = [
                                    'saturday' => __('teacher.saturday'),
                                    'sunday' => __('teacher.sunday'),
                                    'monday' => __('teacher.monday'),
                                    'tuesday' => __('teacher.tuesday'),
                                    'wednesday' => __('teacher.wednesday'),
                                    'thursday' => __('teacher.thursday'),
                                ];
                            @endphp
                            {{ $dayNames[$day] ?? $day }}
                        </span>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('course-schedules.store', $course) }}" method="POST" id="scheduleForm" 
                  x-data="scheduleSelector()" class="bg-white rounded-xl shadow-lg p-8">
                @csrf
                <input type="hidden" name="day" value="{{ $day }}">

                <!-- Quick Time Presets -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-700 mb-4">
                        <i class="fas fa-clock mr-2 text-[#79131d]"></i>
                        {{ __('teacher.quick_time_presets') ?? 'اختر وقت سريع' }}
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @php
                            $presets = [
                                ['start' => '09:00', 'end' => '11:00', 'label' => '9:00 - 11:00'],
                                ['start' => '11:00', 'end' => '13:00', 'label' => '11:00 - 1:00'],
                                ['start' => '14:00', 'end' => '16:00', 'label' => '2:00 - 4:00'],
                                ['start' => '16:00', 'end' => '18:00', 'label' => '4:00 - 6:00'],
                                ['start' => '18:00', 'end' => '20:00', 'label' => '6:00 - 8:00'],
                                ['start' => '20:00', 'end' => '22:00', 'label' => '8:00 - 10:00'],
                            ];
                        @endphp
                        @foreach ($presets as $preset)
                            <button type="button" 
                                    @click="setTime('{{ $preset['start'] }}', '{{ $preset['end'] }}')"
                                    class="preset-btn px-4 py-3 border-2 border-gray-200 rounded-lg hover:border-[#79131d] hover:bg-[#79131d]/5 transition-all duration-200 text-sm font-medium text-gray-700 hover:text-[#79131d]">
                                <i class="far fa-clock mr-2"></i>{{ $preset['label'] }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Time Selection -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <!-- Start Time -->
                    <div>
                        <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-play-circle mr-2 text-green-600"></i>
                            {{ __('teacher.start_time') }}
                        </label>
                        <div class="relative">
                            <input type="time" 
                                   id="start_time" 
                                   name="start_time" 
                                   x-model="startTime"
                                   value="{{ old('start_time') }}"
                                   @change="validateTimes()"
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200 text-lg font-medium">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500" x-show="startTime">
                            <span x-text="formatTime(startTime)"></span>
                        </p>
                    </div>

                    <!-- End Time -->
                    <div>
                        <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-stop-circle mr-2 text-red-600"></i>
                            {{ __('teacher.end_time') }}
                        </label>
                        <div class="relative">
                            <input type="time" 
                                   id="end_time" 
                                   name="end_time" 
                                   x-model="endTime"
                                   value="{{ old('end_time') }}"
                                   @change="validateTimes()"
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#79131d] focus:border-[#79131d] transition-all duration-200 text-lg font-medium">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500" x-show="endTime">
                            <span x-text="formatTime(endTime)"></span>
                        </p>
                    </div>
                </div>

                <!-- Duration Display -->
                <div class="mb-6 p-4 bg-gradient-to-r from-[#79131d]/10 to-[#5a0f16]/10 rounded-lg border border-[#79131d]/20" 
                     x-show="startTime && endTime && isValidDuration">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">{{ __('teacher.duration') ?? 'المدة' }}</p>
                            <p class="text-2xl font-bold text-[#79131d]" x-text="calculateDuration()"></p>
                        </div>
                        <div class="text-4xl">
                            <i class="fas fa-hourglass-half text-[#79131d]"></i>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg" 
                     x-show="errorMessage" 
                     x-cloak>
                    <p class="text-red-700 font-medium" x-text="errorMessage"></p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit" 
                            :disabled="!isValidDuration"
                            class="flex-1 bg-gradient-to-r from-[#79131d] to-[#5a0f16] text-white py-3 px-6 rounded-lg font-semibold hover:from-[#5a0f16] hover:to-[#79131d] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                        <i class="fas fa-save mr-2"></i>
                        {{ __('teacher.save_schedule') }}
                    </button>
                    <a href="{{ route('course-schedules.index', $course) }}" 
                       class="flex-1 bg-gray-200 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-300 transition-all duration-200 text-center">
                        <i class="fas fa-times mr-2"></i>
                        {{ __('teacher.cancel') ?? 'إلغاء' }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function scheduleSelector() {
            return {
                startTime: '{{ old("start_time") }}',
                endTime: '{{ old("end_time") }}',
                errorMessage: '',

                setTime(start, end) {
                    this.startTime = start;
                    this.endTime = end;
                    this.validateTimes();
                    // Highlight the clicked button
                    document.querySelectorAll('.preset-btn').forEach(btn => {
                        btn.classList.remove('border-[#79131d]', 'bg-[#79131d]/10', 'text-[#79131d]');
                    });
                    event.target.closest('.preset-btn')?.classList.add('border-[#79131d]', 'bg-[#79131d]/10', 'text-[#79131d]');
                },

                validateTimes() {
                    this.errorMessage = '';
                    
                    if (!this.startTime || !this.endTime) {
                        return false;
                    }

                    const start = new Date('2000-01-01T' + this.startTime + ':00');
                    const end = new Date('2000-01-01T' + this.endTime + ':00');

                    if (end <= start) {
                        this.errorMessage = '{{ __("teacher.end_time_must_be_after_start") ?? "وقت النهاية يجب أن يكون بعد وقت البداية" }}';
                        return false;
                    }

                    // Check minimum duration (30 minutes)
                    const diffMinutes = (end - start) / 1000 / 60;
                    if (diffMinutes < 30) {
                        this.errorMessage = '{{ __("teacher.minimum_duration_30_minutes") ?? "الحد الأدنى للمدة هو 30 دقيقة" }}';
                        return false;
                    }

                    return true;
                },

                get isValidDuration() {
                    return this.validateTimes();
                },

                formatTime(time) {
                    if (!time) return '';
                    const [hours, minutes] = time.split(':');
                    const hour12 = hours % 12 || 12;
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    return `${hour12}:${minutes} ${ampm}`;
                },

                calculateDuration() {
                    if (!this.startTime || !this.endTime || !this.isValidDuration) {
                        return '';
                    }

                    const start = new Date('2000-01-01T' + this.startTime + ':00');
                    const end = new Date('2000-01-01T' + this.endTime + ':00');
                    const diffMinutes = (end - start) / 1000 / 60;
                    
                    const hours = Math.floor(diffMinutes / 60);
                    const minutes = diffMinutes % 60;

                    if (hours > 0 && minutes > 0) {
                        return `${hours} {{ __("teacher.hours") ?? "ساعة" }} ${minutes} {{ __("teacher.minutes") ?? "دقيقة" }}`;
                    } else if (hours > 0) {
                        return `${hours} {{ __("teacher.hours") ?? "ساعة" }}`;
                    } else {
                        return `${minutes} {{ __("teacher.minutes") ?? "دقيقة" }}`;
                    }
                }
            }
        }

        // Form validation on submit
        document.getElementById('scheduleForm').addEventListener('submit', function(e) {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;

            if (!startTime || !endTime) {
                e.preventDefault();
                alert('{{ __("teacher.please_select_both_times") ?? "يرجى اختيار وقت البداية والنهاية" }}');
                return false;
            }

            const start = new Date('2000-01-01T' + startTime + ':00');
            const end = new Date('2000-01-01T' + endTime + ':00');

            if (end <= start) {
                e.preventDefault();
                alert('{{ __("teacher.end_time_must_be_after_start") ?? "وقت النهاية يجب أن يكون بعد وقت البداية" }}');
                return false;
            }
        });
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        input[type="time"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            opacity: 0.6;
        }

        input[type="time"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        .preset-btn {
            transition: all 0.2s ease;
        }

        .preset-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</x-teacher-panel>
