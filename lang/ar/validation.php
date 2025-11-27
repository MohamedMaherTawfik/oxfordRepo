<?php

return [

    /*
    |--------------------------------------------------------------------------
    | سطور لغة التحقق
    |--------------------------------------------------------------------------
    |
    | تحتوي الأسطر التالية على رسائل الخطأ الافتراضية المستخدمة من قبل
    | فئة المُتحقق. تحتوي بعض هذه القواعد على عدة نسخ مثل قواعد الحجم.
    | لا تتردد في تعديل أي من هذه الرسائل بما يتناسب مع تطبيقك.
    |
    */

    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما يكون :other يساوي :value.',
    'active_url' => ':attribute يجب أن يكون رابطاً صحيحاً.',
    'after' => 'يجب أن يكون :attribute تاريخاً بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخاً بعد أو يساوي :date.',
    'alpha' => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على أحرف، أرقام، شرطات وشرطات سفلية فقط.',
    'alpha_num' => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'ascii' => 'يجب أن يحتوي :attribute على رموز وأحرف لاتينية فقط.',
    'before' => 'يجب أن يكون :attribute تاريخاً قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخاً قبل أو يساوي :date.',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
        'file' => 'يجب أن يكون :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'string' => 'يجب أن يكون :attribute بين :min و :max حرفاً.',
    ],
    'boolean' => 'يجب أن يكون :attribute إما true أو false.',
    'can' => 'يحتوي :attribute على قيمة غير مسموح بها.',
    'confirmed' => 'تأكيد :attribute غير مطابق.',
    'contains' => ':attribute مفقود فيه قيمة مطلوبة.',
    'current_password' => 'كلمة المرور الحالية غير صحيحة.',
    'date' => ':attribute ليس تاريخاً صحيحاً.',
    'date_equals' => 'يجب أن يكون :attribute تاريخاً مساوياً لـ :date.',
    'date_format' => 'يجب أن يتطابق :attribute مع الشكل :format.',
    'decimal' => 'يجب أن يحتوي :attribute على :decimal منازل عشرية.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما يكون :other يساوي :value.',
    'different' => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits' => 'يجب أن يكون :attribute مكوناً من :digits أرقام.',
    'digits_between' => 'يجب أن يكون :attribute بين :min و :max رقماً.',
    'dimensions' => 'أبعاد صورة :attribute غير صالحة.',
    'distinct' => 'قيمة :attribute مكررة.',
    'doesnt_end_with' => ':attribute لا يجب أن ينتهي بأحد القيم التالية: :values.',
    'doesnt_start_with' => ':attribute لا يجب أن يبدأ بأحد القيم التالية: :values.',
    'email' => 'يجب أن يكون :attribute بريد إلكتروني صحيح.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'enum' => 'القيمة المختارة في :attribute غير صحيحة.',
    'exists' => 'القيمة المحددة لـ :attribute غير موجودة.',
    'extensions' => 'يجب أن يكون لـ :attribute امتداد من التالي: :values.',
    'file' => 'يجب أن يكون :attribute ملفاً.',
    'filled' => 'يجب إدخال قيمة في :attribute.',
    'gt' => [
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'string' => 'يجب أن يكون :attribute أطول من :value حرفاً.',
    ],
    'gte' => [
        'array' => 'يجب أن يحتوي :attribute على :value عناصر أو أكثر.',
        'file' => 'يجب أن يكون :attribute أكبر أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أكبر أو يساوي :value.',
        'string' => 'يجب أن يكون :attribute أكبر أو يساوي :value حرفاً.',
    ],
    'hex_color' => 'يجب أن يكون :attribute لوناً هكس صحيحاً.',
    'image' => 'يجب أن يكون :attribute صورة.',
    'in' => 'القيمة المحددة لـ :attribute غير صحيحة.',
    'in_array' => 'القيمة المحددة لـ :attribute غير موجودة في :other.',
    'integer' => 'يجب أن يكون :attribute عدداً صحيحاً.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيح.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيح.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيح.',
    'json' => 'يجب أن يكون :attribute سلسلة JSON صالحة.',
    'list' => 'يجب أن يكون :attribute قائمة.',
    'lowercase' => 'يجب أن تكون كل حروف :attribute صغيرة.',
    'lt' => [
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
        'file' => 'يجب أن يكون :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'string' => 'يجب أن يكون :attribute أقل من :value حرفاً.',
    ],
    'lte' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون :attribute أقل أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute أقل أو يساوي :value.',
        'string' => 'يجب أن يكون :attribute أقل أو يساوي :value حرفاً.',
    ],
    'mac_address' => 'يجب أن يكون :attribute عنوان MAC صحيح.',
    'max' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :max عنصر.',
        'file' => 'يجب ألا يزيد :attribute عن :max كيلوبايت.',
        'numeric' => 'يجب ألا يكون :attribute أكبر من :max.',
        'string' => 'يجب ألا يزيد :attribute عن :max حرفاً.',
    ],
    'max_digits' => 'يجب ألا يحتوي :attribute على أكثر من :max رقم.',
    'mimes' => 'يجب أن يكون :attribute ملفاً من النوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملفاً من النوع: :values.',
    'min' => [
        'array' => 'يجب أن يحتوي :attribute على الأقل :min عناصر.',
        'file' => 'يجب أن يكون :attribute على الأقل :min كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute على الأقل :min.',
        'string' => 'يجب أن يكون :attribute على الأقل :min حرفاً.',
    ],
    'min_digits' => 'يجب أن يحتوي :attribute على الأقل :min أرقام.',
    'missing' => 'الحقل :attribute يجب أن يكون مفقوداً.',
    'missing_if' => 'يجب أن يكون :attribute مفقوداً إذا كان :other يساوي :value.',
    'missing_unless' => 'يجب أن يكون :attribute مفقوداً ما لم يكن :other يساوي :value.',
    'missing_with' => 'يجب أن يكون :attribute مفقوداً عند وجود :values.',
    'missing_with_all' => 'يجب أن يكون :attribute مفقوداً عند وجود جميع :values.',
    'multiple_of' => 'يجب أن يكون :attribute من مضاعفات :value.',
    'not_in' => 'القيمة المختارة لـ :attribute غير صالحة.',
    'not_regex' => 'تنسيق :attribute غير صالح.',
    'numeric' => 'يجب أن يكون :attribute رقماً.',
    'password' => [
        'letters' => 'يجب أن تحتوي كلمة المرور على الأقل :letters حرف.',
        'mixed' => 'يجب أن تحتوي كلمة المرور على الأقل :mixed حرف كبير وصغير.',
        'numbers' => 'يجب أن تحتوي كلمة المرور على الأقل :numbers رقم.',
        'symbols' => 'يجب أن تحتوي كلمة المرور على الأقل :symbols رمز.',
        'uncompromised' => 'ظهرت كلمة المرور هذه في تسريب بيانات. الرجاء اختيار كلمة مرور مختلفة.',
    ],
    'present' => 'يجب تقديم :attribute.',
    'prohibited' => 'الحقل :attribute ممنوع.',
    'prohibited_if' => 'الحقل :attribute ممنوع عندما يكون :other يساوي :value.',
    'prohibited_unless' => 'الحقل :attribute ممنوع إلا إذا كان :other ضمن :values.',
    'prohibits' => 'الحقل :attribute يمنع :other من الظهور.',
    'regex' => 'تنسيق :attribute غير صالح.',
    'required' => ':attribute مطلوب.',
    'required_if' => ':attribute مطلوب عندما يكون :other يساوي :value.',
    'required_unless' => ':attribute مطلوب إلا إذا كان :other ضمن :values.',
    'required_with' => ':attribute مطلوب عندما يكون :values موجود.',
    'required_with_all' => ':attribute مطلوب عندما تكون :values موجودة.',
    'required_without' => ':attribute مطلوب عندما لا تكون :values موجودة.',
    'required_without_all' => ':attribute مطلوب عندما لا توجد أي من :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other.',
    'size' => [
        'array' => 'يجب أن يحتوي :attribute على :size عنصر.',
        'file' => 'يجب أن يكون :attribute :size كيلوبايت.',
        'numeric' => 'يجب أن يكون :attribute يساوي :size.',
        'string' => 'يجب أن يحتوي :attribute على :size حرف.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون :attribute نصاً.',
    'timezone' => 'يجب أن يكون :attribute منطقة زمنية صحيحة.',
    'unique' => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل في تحميل :attribute.',
    'uppercase' => 'يجب أن تكون كل حروف :attribute كبيرة.',
    'url' => 'يجب أن يكون :attribute رابطاً صحيحاً.',
    'ulid' => 'يجب أن يكون :attribute ULID صحيحاً.',
    'uuid' => 'يجب أن يكون :attribute UUID صحيحاً.',

    /*
    |--------------------------------------------------------------------------
    | الرسائل المخصصة للتحقق
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة مخصصة',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ترجمة أسماء الحقول
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'name' => 'الاسم',
        'username' => 'اسم المستخدم',
        'image' => 'الصورة',
        'phone' => 'رقم الهاتف',
        'title' => 'العنوان',
        'description' => 'الوصف',
        'content' => 'المحتوى',
        'price' => 'السعر',
        'quantity' => 'الكمية',
        'address' => 'العنوان',
        'country' => 'الدولة',
        'city' => 'المدينة',
        'first_name' => 'الاسم الأول',
        'last_name' => 'الاسم الأخير',
        'current_password' => 'كلمة المرور الحالية',
        'new_password' => 'كلمة المرور الجديدة',
        'new_password_confirmation' => 'تأكيد كلمة المرور الجديدة',
    ],
];