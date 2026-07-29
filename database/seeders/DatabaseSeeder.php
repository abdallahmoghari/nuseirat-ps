<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Slider;
use App\Models\User;
use Database\Seeders\CitizenServiceSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $country = Country::create(['country_name' => 'فلسطين', 'code' => 'PS']);
        $city = City::create(['name' => 'غزة', 'country_id' => $country->id]);
        $city2 = City::create(['name' => 'النصيرات', 'country_id' => $country->id]);

        // --- Admin ---
        $admin = Admin::create(['email' => 'admin@admin.com', 'password' => Hash::make('123456789')]);
        User::create([
            'first_name' => 'مدير',
            'last_name' => 'النظام',
            'mobile' => '0592000000',
            'date' => '1990-01-01',
            'gender' => 'male',
            'status' => 'active',
            'city_id' => $city->id,
            'actor_type' => 'App\Models\Admin',
            'actor_id' => $admin->id,
        ]);

        $admin2 = Admin::create(['email' => 'admin2@admin.com', 'password' => Hash::make('123456789')]);
        User::create([
            'first_name' => 'أحمد',
            'last_name' => 'الجرجاوي',
            'mobile' => '0592000002',
            'date' => '1988-05-15',
            'gender' => 'male',
            'status' => 'active',
            'city_id' => $city->id,
            'actor_type' => 'App\Models\Admin',
            'actor_id' => $admin2->id,
        ]);

        // --- Authors ---
        $authorsData = [
            ['email' => 'author@author.com', 'first' => 'محرر', 'last' => 'أول', 'mobile' => '0592000001'],
            ['email' => 'author2@author.com', 'first' => 'سارة', 'last' => 'الشيخ', 'mobile' => '0592000003'],
            ['email' => 'author3@author.com', 'first' => 'محمد', 'last' => 'الدهشان', 'mobile' => '0592000004'],
        ];

        $authorIds = [];
        foreach ($authorsData as $a) {
            $author = Author::create(['email' => $a['email'], 'password' => Hash::make('123456789')]);
            User::create([
                'first_name' => $a['first'],
                'last_name' => $a['last'],
                'mobile' => $a['mobile'],
                'date' => '1992-03-10',
                'gender' => 'male',
                'status' => 'active',
                'city_id' => $city2->id,
                'actor_type' => 'App\Models\Author',
                'actor_id' => $author->id,
            ]);
            $authorIds[] = $author->id;
        }

        // --- Permissions ---
        $guards = ['admin', 'author'];
        $permBases = [
            'admin', 'author', 'role', 'permission',
            'country', 'city', 'category', 'article', 'slider', 'contact',
        ];
        $permActions = ['list', 'create', 'edit', 'show', 'delete'];

        foreach ($guards as $guard) {
            foreach ($permBases as $base) {
                foreach ($permActions as $action) {
                    $name = "$base-$action";
                    if ($base === 'contact' && !in_array($action, ['list', 'show', 'delete'])) continue;
                    Permission::firstOrCreate(['name' => $name, 'guard_name' => $guard]);
                }
            }
        }

        // --- Roles ---
        $superAdminRole = Role::create(['name' => 'super-admin', 'guard_name' => 'admin']);
        $superAdminRole->givePermissionTo(Permission::where('guard_name', 'admin')->get());

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $adminRole->givePermissionTo(Permission::where('guard_name', 'admin')
            ->whereNotIn('name', ['admin-create', 'admin-delete', 'role-delete', 'permission-delete'])
            ->get());

        $authorRole = Role::create(['name' => 'author', 'guard_name' => 'author']);
        $authorRole->givePermissionTo(Permission::where('guard_name', 'author')->get());

        $admin->assignRole('super-admin');
        $admin2->assignRole('admin');
        foreach (Author::all() as $i => $au) {
            $au->assignRole('author');
        }

        // --- Categories ---
        $cats = ['أخبار محلية', 'أخبار عالمية', 'رياضة', 'اقتصاد', 'تكنولوجيا', 'صحة', 'ثقافة وفن', 'تعليم'];
        $catIds = [];
        foreach ($cats as $c) {
            $cat = Category::create(['name' => $c, 'status' => 'active', 'description' => "جميع أخبار $c"]);
            $catIds[] = $cat->id;
        }

        // --- Sliders ---
        $sliderTitles = [
            'مرحبا بكم في بلدية النصيرات',
            'نحو مستقبل أفضل لمدينة النصيرات',
            'خدمات بلدية متطورة للمواطنين',
        ];
        foreach ($sliderTitles as $i => $title) {
            Slider::create([
                'title' => $title,
                'description' => 'نعمل معاً من أجل تطوير مدينة النصيرات وتقديم أفضل الخدمات لسكانها الكرام',
                'image' => null,
            ]);
        }

        // --- Articles (lots of sample data) ---
        $articleTemplates = [
            ['بلدية النصيرات تطلق مشروع تطوير البنية التحتية', 'أطلقت بلدية النصيرات اليوم مشروعاً لتطوير البنية التحتية في عدة مناطق بالمخيم، بتكلفة تقديرية تصل إلى نصف مليون دولار.', 'يشمل المشروع إعادة تأهيل شبكات المياه والصرف الصحي، وتبليط الشوارع الرئيسية، وإنشاء أرصفة للمشاة في المناطق المستهدفة. وأكد رئيس البلدية أن هذا المشروع يأتي ضمن خطة التطوير الشاملة للمخيم.'],
            ['اختتام دورة تدريبية في الإدارة المحلية', 'اختتمت بلدية النصيرات بالتعاون مع وزارة الحكم المحلي دورة تدريبية في مجال الإدارة المحلية.', 'شارك في الدورة 30 متدرباً من موظفي البلدية ومؤسسات المجتمع المدني، وتناولت موضوعات التخطيط الاستراتيجي وإدارة المشاريع والشفافية المالية.'],
            ['بلدية النصيرات تستقبل وفداً من البنك الدولي', 'استقبلت بلدية النصيرات وفداً من البنك الدولي لبحث سبل التعاون المشترك في مشاريع التنمية.', 'ناقش اللقاء إمكانية تمويل مشاريع بنية تحتية جديدة في المخيم، بالإضافة إلى برامج دعم القدرات المؤسسية للبلدية.' ],
            ['حملة نظافة شاملة في أحياء المخيم', 'نظمت بلدية النصيرات حملة نظافة شاملة في جميع أحياء المخيم بمشاركة المتطوعين.', 'شملت الحملة إزالة النفايات المتراكمة وتنظيف الشوارع الرئيسية والفرعية، ودهان الجدران المشوهة بالكتابات العشوائية.' ],
            ['بلدية النصيرات تعلن عن وظائف شاغرة', 'أعلنت بلدية النصيرات عن حاجتها لشغل عدة وظائف شاغرة في مختلف التخصصات.', 'على الراغبين التقدم بطلباتهم خلال أسبوعين من تاريخ الإعلان، والتخصصات المطلوبة تشمل الهندسة المدنية والمحاسبة وتكنولوجيا المعلومات.'],
            ['مشروع إنارة الشوارع بالطاقة الشمسية', 'وقعت بلدية النصيرات اتفاقية مع إحدى الشركات المتخصصة لتنفيذ مشروع إنارة الشوارع بالطاقة الشمسية.', 'يهدف المشروع إلى توفير الطاقة الكهربائية وخفض فاتورة الكهرباء للبلدية، وتحسين مستوى الإنارة في الشوارع الرئيسية.' ], 
            ['المنتخب الفلسطيني يحقق فوزاً كبيراً', 'حقق المنتخب الفلسطيني فوزاً كبيراً على نظيره في المباراة الودية التي أقيمت على ملعب الشهيد محمد الدرة.', 'انتهت المباراة بثلاثة أهداف مقابل هدف، وسط حضور جماهيري كبير. وأشاد المدرب بأداء اللاعبين وروحهم القتالية.'],
            ['اتفاقية تعاون بين البلدية والمؤسسات الأهلية', 'وقعت بلدية النصيرات اتفاقية تعاون مشترك مع عدد من المؤسسات الأهلية في المخيم.', 'تهدف الاتفاقية إلى تعزيز الشراكة المجتمعية وتنسيق الجهود في خدمة أبناء المخيم في مختلف المجالات التنموية والخدماتية.' ],
            ['افتتاح مركز الحاسوب في البلدية', 'افتتحت بلدية النصيرات مركزاً للحاسوب يهدف إلى تدريب الموظفين والمجتمع المحلي.', 'يوفر المركز دورات تدريبية في مجالات البرمجة وتصميم المواقع وقواعد البيانات بإشراف مدربين متخصصين.' ],
            ['بلدية النصيرات تشارك في مؤتمر الإسكان', 'شاركت بلدية النصيرات في المؤتمر السنوي للإسكان الذي عقد في مدينة رام الله.', 'عرضت البلدية تجربتها في مجال تنظيم الأراضي وتطوير المناطق السكنية ضمن جلسات المؤتمر.'],
            ['ورشة عمل حول فصل النفايات من المصدر', 'نظمت بلدية النصيرات ورشة عمل حول أهمية فصل النفايات من المصدر بالتعاون مع سلطة جودة البيئة.', 'حضر الورشة ممثلون عن المؤسسات المحلية والمواطنين، وتم التأكيد على أهمية فرز النفايات للحفاظ على البيئة.' ],
            ['جولة تفقدية لرئيس البلدية في أحياء المخيم', 'قام رئيس بلدية النصيرات بجولة تفقدية في أحياء المخيم للاطلاع على احتياجات المواطنين.', 'شملت الجولة زيارة المناطق المتضررة من المنخفض الجوي الأخير والاستماع لمطالب السكان بشكل مباشر.' ],
        ];

        foreach ($articleTemplates as $i => $item) {
            Article::create([
                'title' => $item[0],
                'short_description' => $item[1],
                'full_description' => $item[2],
                'category_id' => $catIds[$i % count($catIds)],
                'author_id' => $authorIds[$i % count($authorIds)],
                'created_at' => now()->subDays(count($articleTemplates) - $i),
                'updated_at' => now()->subDays(count($articleTemplates) - $i),
            ]);
        }

        // --- Sample Contacts ---
        Contact::create(['name' => 'علي حسن', 'phone' => '0599123456', 'email' => 'ali@example.com', 'message' => 'أود الاستفسار عن خدمة إصدار رخصة بناء']);
        Contact::create(['name' => 'مريم أحمد', 'phone' => '0599654321', 'email' => 'maryam@example.com', 'message' => 'شكراً لجهودكم في تطوير المخيم']);
        Contact::create(['name' => 'خالد عمر', 'phone' => '0599789123', 'email' => 'khaled@example.com', 'message' => 'أرجو التواصل معي بخصوص مشكلة في خط المياه أمام المنزل']);

        $this->call(CitizenServiceSeeder::class);
    }
}
