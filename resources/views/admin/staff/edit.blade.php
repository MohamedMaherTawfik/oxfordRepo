<x-panel>
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-right">تعديل موظف</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-right">المعلومات الأساسية</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 text-right">الاسم الكامل</label>
                            <input type="text" name="name" value="{{ old('name', $staff->name) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] text-right">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 text-right">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email', $staff->email) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] text-right">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 text-right">كلمة المرور (اتركه فارغاً إذا لم تريد تغييره)</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] text-right">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 text-right">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#79131d] text-right">
                        </div>
                    </div>
                </div>

                <!-- Permissions -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-right">الصلاحيات</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @php
                            $permissions = $staff->staffPermissions;
                        @endphp
                        
                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_users" value="1" 
                                {{ ($permissions && $permissions->manage_users) || old('manage_users') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة المستخدمين</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_teachers" value="1" 
                                {{ ($permissions && $permissions->manage_teachers) || old('manage_teachers') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة المعلمين</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_courses" value="1" 
                                {{ ($permissions && $permissions->manage_courses) || old('manage_courses') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة الدورات</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_categories" value="1" 
                                {{ ($permissions && $permissions->manage_categories) || old('manage_categories') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة التصنيفات</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_diplomas" value="1" 
                                {{ ($permissions && $permissions->manage_diplomas) || old('manage_diplomas') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة الدبلومات</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_payments" value="1" 
                                {{ ($permissions && $permissions->manage_payments) || old('manage_payments') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة المدفوعات</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_certificates" value="1" 
                                {{ ($permissions && $permissions->manage_certificates) || old('manage_certificates') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة الشهادات</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_applies" value="1" 
                                {{ ($permissions && $permissions->manage_applies) || old('manage_applies') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة طلبات المعلمين</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_homepage" value="1" 
                                {{ ($permissions && $permissions->manage_homepage) || old('manage_homepage') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة الصفحة الرئيسية</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_footer" value="1" 
                                {{ ($permissions && $permissions->manage_footer) || old('manage_footer') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة التذييل</span>
                        </label>

                        <label class="flex items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-[#79131d] cursor-pointer">
                            <input type="checkbox" name="manage_staff" value="1" 
                                {{ ($permissions && $permissions->manage_staff) || old('manage_staff') ? 'checked' : '' }}
                                class="ml-3 w-5 h-5 text-[#79131d] border-gray-300 rounded focus:ring-[#79131d]">
                            <span class="text-gray-700">إدارة الموظفين</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 space-x-reverse mt-8">
                    <a href="{{ route('admin.staff.index') }}" 
                       class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        إلغاء
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-[#79131d] text-white rounded-lg hover:bg-[#5a0f16] transition">
                        <i class="fas fa-save ml-2"></i>
                        حفظ التعديلات
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-panel>

