<x-panel>
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 text-right">تفاصيل الموظف</h2>
                    <div class="flex space-x-3 space-x-reverse">
                        <a href="{{ route('admin.staff.edit', $staff->id) }}" 
                           class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            <i class="fas fa-edit ml-2"></i>
                            تعديل
                        </a>
                        <a href="{{ route('admin.staff.index') }}" 
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            <i class="fas fa-arrow-right ml-2"></i>
                            رجوع
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4 text-right">المعلومات الشخصية</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-gray-600 text-sm">الاسم:</span>
                                <p class="text-gray-900 font-medium text-right">{{ $staff->name }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600 text-sm">البريد الإلكتروني:</span>
                                <p class="text-gray-900 font-medium text-right">{{ $staff->email }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600 text-sm">الدور:</span>
                                <p class="text-gray-900 font-medium text-right">{{ $staff->role }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600 text-sm">تاريخ الإنشاء:</span>
                                <p class="text-gray-900 font-medium text-right">{{ $staff->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4 text-right">الصلاحيات</h3>
                        @if($staff->staffPermissions)
                            <div class="grid grid-cols-2 gap-2">
                                @if($staff->staffPermissions->manage_users)
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded text-sm text-center">المستخدمين</span>
                                @endif
                                @if($staff->staffPermissions->manage_teachers)
                                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded text-sm text-center">المعلمين</span>
                                @endif
                                @if($staff->staffPermissions->manage_courses)
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded text-sm text-center">الدورات</span>
                                @endif
                                @if($staff->staffPermissions->manage_categories)
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded text-sm text-center">التصنيفات</span>
                                @endif
                                @if($staff->staffPermissions->manage_diplomas)
                                    <span class="px-3 py-1 bg-pink-100 text-pink-800 rounded text-sm text-center">الدبلومات</span>
                                @endif
                                @if($staff->staffPermissions->manage_payments)
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded text-sm text-center">المدفوعات</span>
                                @endif
                                @if($staff->staffPermissions->manage_certificates)
                                    <span class="px-3 py-1 bg-teal-100 text-teal-800 rounded text-sm text-center">الشهادات</span>
                                @endif
                                @if($staff->staffPermissions->manage_applies)
                                    <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded text-sm text-center">طلبات المعلمين</span>
                                @endif
                                @if($staff->staffPermissions->manage_homepage)
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded text-sm text-center">الصفحة الرئيسية</span>
                                @endif
                                @if($staff->staffPermissions->manage_footer)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded text-sm text-center">التذييل</span>
                                @endif
                                @if($staff->staffPermissions->manage_staff)
                                    <span class="px-3 py-1 bg-cyan-100 text-cyan-800 rounded text-sm text-center">الموظفين</span>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-500 text-right">لا توجد صلاحيات محددة</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-panel>

