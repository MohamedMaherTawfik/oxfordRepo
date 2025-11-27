<?php

namespace Database\Seeders;

use App\Models\categories;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء الفئات
        $categories = [
            ['name' => 'البرمجة', 'slug' => 'programming'],
            ['name' => 'علوم البيانات', 'slug' => 'data-science'],
            ['name' => 'تطوير الويب', 'slug' => 'web-development'],
            ['name' => 'تطوير الموبايل', 'slug' => 'mobile-development'],
            ['name' => 'التصميم', 'slug' => 'design'],
            ['name' => 'التسويق', 'slug' => 'marketing'],
            ['name' => 'الأعمال', 'slug' => 'business'],
            ['name' => 'التطوير الشخصي', 'slug' => 'personal-development'],
        ];

        $categoryIds = [];
        foreach ($categories as $category) {
            $cat = categories::firstOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']]
            );
            $categoryIds[] = $cat->id;
        }

        // إنشاء مستخدمين (معلمين)
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = User::firstOrCreate(
                ['email' => "teacher{$i}@oxford.com"],
                [
                    'name' => "المعلم {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'teacher',
                ]
            );
            $users[] = $user->id;
        }

        // إنشاء دورات متنوعة
        $courses = [
            [
                'title' => 'تعلم Laravel من الصفر',
                'description' => 'دورة شاملة لتعلم إطار عمل Laravel PHP من البداية إلى الاحتراف. ستتعلم كيفية بناء تطبيقات ويب قوية وآمنة باستخدام Laravel.',
                'price' => 299.99,
                'admin_price' => 249.99,
                'duration' => '60',
                'start_Date' => date('Y-m-d', strtotime('+7 days')),
                'level' => 'Beginner',
                'categorey_id' => $categoryIds[2] ?? 1, // تطوير الويب
                'user_id' => $users[0] ?? 1,
            ],
            [
                'title' => 'Vue.js للمبتدئين',
                'description' => 'تعلم Vue.js من الصفر وبناء تطبيقات ويب تفاعلية حديثة. ستحصل على فهم عميق لأساسيات Vue.js والمكونات.',
                'price' => 199.99,
                'admin_price' => 149.99,
                'duration' => '45',
                'start_Date' => date('Y-m-d', strtotime('+10 days')),
                'level' => 'Beginner',
                'categorey_id' => $categoryIds[2] ?? 1,
                'user_id' => $users[1] ?? 1,
            ],
            [
                'title' => 'Flutter لتطوير تطبيقات الموبايل',
                'description' => 'دورة متقدمة لتعلم Flutter وبناء تطبيقات موبايل احترافية لنظامي Android و iOS باستخدام لغة Dart.',
                'price' => 399.99,
                'admin_price' => 349.99,
                'duration' => '80',
                'start_Date' => date('Y-m-d', strtotime('+14 days')),
                'level' => 'Mid',
                'categorey_id' => $categoryIds[3] ?? 1,
                'user_id' => $users[2] ?? 1,
            ],
            [
                'title' => 'Python لعلوم البيانات',
                'description' => 'تعلم Python وتحليل البيانات باستخدام مكتبات مثل Pandas و NumPy و Matplotlib. دورة شاملة لعلوم البيانات.',
                'price' => 349.99,
                'admin_price' => 299.99,
                'duration' => '70',
                'start_Date' => date('Y-m-d', strtotime('+5 days')),
                'level' => 'Mid',
                'categorey_id' => $categoryIds[1] ?? 1,
                'user_id' => $users[0] ?? 1,
            ],
            [
                'title' => 'تصميم UI/UX الاحترافي',
                'description' => 'تعلم أساسيات تصميم واجهات المستخدم وتجربة المستخدم باستخدام أدوات مثل Figma و Adobe XD.',
                'price' => 249.99,
                'admin_price' => 199.99,
                'duration' => '50',
                'start_Date' => date('Y-m-d', strtotime('+12 days')),
                'level' => 'Beginner',
                'categorey_id' => $categoryIds[4] ?? 1,
                'user_id' => $users[3] ?? 1,
            ],
            [
                'title' => 'React.js المتقدم',
                'description' => 'دورة متقدمة لتعلم React.js وبناء تطبيقات معقدة باستخدام Hooks و Context API و Redux.',
                'price' => 449.99,
                'admin_price' => 399.99,
                'duration' => '90',
                'start_Date' => date('Y-m-d', strtotime('+20 days')),
                'level' => 'Advanced',
                'categorey_id' => $categoryIds[2] ?? 1,
                'user_id' => $users[1] ?? 1,
            ],
            [
                'title' => 'التسويق الرقمي الشامل',
                'description' => 'تعلم جميع جوانب التسويق الرقمي من SEO و SEM إلى التسويق عبر وسائل التواصل الاجتماعي.',
                'price' => 299.99,
                'admin_price' => 249.99,
                'duration' => '55',
                'start_Date' => date('Y-m-d', strtotime('+8 days')),
                'level' => 'Beginner',
                'categorey_id' => $categoryIds[5] ?? 1,
                'user_id' => $users[4] ?? 1,
            ],
            [
                'title' => 'Node.js و Express.js',
                'description' => 'تعلم بناء تطبيقات Backend باستخدام Node.js و Express.js. ستتعلم كيفية إنشاء APIs و RESTful services.',
                'price' => 379.99,
                'admin_price' => 329.99,
                'duration' => '65',
                'start_Date' => date('Y-m-d', strtotime('+15 days')),
                'level' => 'Mid',
                'categorey_id' => $categoryIds[2] ?? 1,
                'user_id' => $users[2] ?? 1,
            ],
            [
                'title' => 'إدارة المشاريع الاحترافية',
                'description' => 'تعلم إدارة المشاريع باستخدام منهجيات Agile و Scrum. دورة شاملة لإدارة المشاريع التقنية.',
                'price' => 279.99,
                'admin_price' => 229.99,
                'duration' => '40',
                'start_Date' => date('Y-m-d', strtotime('+6 days')),
                'level' => 'Beginner',
                'categorey_id' => $categoryIds[6] ?? 1,
                'user_id' => $users[3] ?? 1,
            ],
            [
                'title' => 'Machine Learning بالعربية',
                'description' => 'دورة شاملة لتعلم Machine Learning من الصفر باستخدام Python. ستتعلم الخوارزميات الأساسية والمتقدمة.',
                'price' => 499.99,
                'admin_price' => 449.99,
                'duration' => '100',
                'start_Date' => date('Y-m-d', strtotime('+25 days')),
                'level' => 'Advanced',
                'categorey_id' => $categoryIds[1] ?? 1,
                'user_id' => $users[0] ?? 1,
            ],
        ];

        foreach ($courses as $courseData) {
            $slug = Str::slug($courseData['title']) . '-' . time() . '-' . rand(1000, 9999);
            
            Courses::firstOrCreate(
                ['slug' => $slug],
                array_merge($courseData, ['slug' => $slug])
            );
        }

        $this->command->info('تم إنشاء البيانات التجريبية بنجاح!');
        $this->command->info('تم إنشاء ' . count($categories) . ' فئة');
        $this->command->info('تم إنشاء ' . count($users) . ' مستخدم');
        $this->command->info('تم إنشاء ' . count($courses) . ' دورة');
    }
}

