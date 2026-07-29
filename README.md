# 🌐 بلدية النصيرات — نظام إلكتروني متكامل

نظام ويب متكامل لبلدية النصيرات في قطاع غزة، يهدف إلى رقمنة الخدمات البلدية وتوفير منصة إخبارية وإدارية متكاملة. مبني باستخدام **Laravel 12** مع نظام صلاحيات متقدم.

---

## 🚀 المميزات

### 👥 4 أنواع مستخدمين
| المستخدم | الصلاحيات |
|----------|-----------|
| **Admin** (مشرف) | إدارة كاملة: دول، مدن، تصنيفات، مقالات، مستخدمين، أدوار، صلاحيات |
| **Author** (كاتب) | كتابة وإدارة المقالات الإخبارية |
| **Citizen** (مواطن) | تقديم معاملات حكومية، متابعة الطلبات، استفسارات |
| **Service Employee** (موظف خدمات) | استلام ومعالجة طلبات المواطنين، الرد على الاستفسارات |

### 📰 الواجهة العامة
- صفحة رئيسية بشريط متحرك (Slider) وأحدث المقالات والتصنيفات
- تصنيفات أخبار مع slugs بالعربية
- صفحة مقال كامل مع مقالات ذات صلة
- صفحة اتصل بنا، من نحن، الخدمات
- قسم الإعلانات والإصدارات: تقارير مالية، أنظمة وقوانين، تقارير إدارية، خطة تشغيلية، قرارات مجلس بلدي

### 🏛️ بوابة المواطن
- تسجيل وإنشاء حساب
- 5 أنواع خدمات: ترخيص، شهادة، صيانة شارع، حاوية نفايات، تقليم أشجار
- تقديم طلب مع إرفاق ملفات
- رقم متابعة فريد لكل طلب (مثال: 2026-0001)
- متابعة حالة الطلب (قيد الانتظار ← قيد الدراسة ← بانتظار المراجعة ← تم الإنجاز)
- استفسارات عامة
- ملف شخصي

### ⚙️ لوحة التحكم (CMS)
- **Countries**: إدارة دول مع Soft Delete + سلة محذوفات
- **Cities**: إدارة مدن تابعة للدول
- **Categories**: تصنيفات الأخبار
- **Articles**: مقالات مع slugs عربي، صور، أوصاف
- **Admins / Authors**: إدارة المستخدمين مع الأدوار والصلاحيات
- **Sliders**: إدارة الشريط المتحرك للصفحة الرئيسية
- **Contacts**: قراءة رسائل الزوار
- **Roles / Permissions**: نظام صلاحيات Spatie كامل

### 👨‍💼 لوحة موظف الخدمات
- Dashboard بإحصائيات (قيد الانتظار، قيد الدراسة، منجز، استفسارات)
- إدارة طلبات المواطنين مع تغيير الحالة والرد
- الرد على الاستفسارات
- تعديل الملف الشخصي

---

## 🛠️ التقنيات المستخدمة

| التقنية | الغرض |
|---------|-------|
| **Laravel 12** | إطار العمل الرئيسي |
| **PHP 8.2+** | لغة البرمجة |
| **SQLite / MySQL** | قاعدة البيانات |
| **Spatie Laravel-Permission** | نظام الأدوار والصلاحيات |
| **Blade** | محرك القوالب |
| **Bootstrap** | واجهة المستخدم |
| **Axios** | طلبات AJAX |
| **SweetAlert2** | التنبيهات |

---

## 📦 التثبيت والتشغيل

```bash
git clone https://github.com/abdallahmoghari/nuseirat-ps.git
cd nuseirat-ps
composer install
copy .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan serve
```

ثم افتح المتصفح على: `http://127.0.0.1:8000`

---

## 🔐 بيانات الدخول الافتراضية

### Admin
- **الإيميل:** `admin@admin.com`
- **كلمة المرور:** `123456789`

### Author
- **الإيميل:** `author@author.com`
- **كلمة المرور:** `123456789`

### Citizen
- **الإيميل:** `citizen@test.com`
- **كلمة المرور:** `123456`

### Service Employee
- **الإيميل:** `emp1@nuseirat.ps`
- **كلمة المرور:** `123456`

---

## 📁 هيكل المشروع

```
├── app/
│   ├── Http/Controllers/          # المتحكمات
│   │   ├── Front/HomeController    # الواجهة العامة
│   │   ├── AdminController         # إدارة المشرفين
│   │   ├── ArticleController       # إدارة المقالات
│   │   ├── AuthorController        # إدارة الكتّاب
│   │   ├── CategoryController      # إدارة التصنيفات
│   │   ├── CityController          # إدارة المدن
│   │   ├── CountryController       # إدارة الدول
│   │   ├── SliderController        # إدارة الشريط المتحرك
│   │   ├── ContactController       # رسائل الزوار
│   │   ├── RoleController          # الأدوار
│   │   ├── PermissionController    # الصلاحيات
│   │   ├── RolePermissionController # توزيع الصلاحيات
│   │   ├── CitizenAuthController   # دخول المواطن
│   │   ├── CitizenServiceController# خدمات المواطن
│   │   └── ServiceEmployeeAuthController # موظف الخدمات
│   └── Models/                     # الموديلات
├── resources/views/
│   ├── news/                       # قوالب الواجهة العامة
│   ├── cms/                        # قوالب لوحة التحكم
│   └── citizen/                    # قوالب بوابة المواطن
├── routes/web.php                  # المسارات
└── database/migrations/            # هجرات قاعدة البيانات
```

---

## 🗺️ المسارات الرئيسية

### الواجهة العامة
| المسار | الوصف |
|--------|-------|
| `/` أو `/home` | الصفحة الرئيسية |
| `/home/category/{slug}` | تصنيف مقالات |
| `/home/article/{slug}` | صفحة مقال |
| `/home/contact-us` | اتصل بنا |
| `/home/about` | من نحن |
| `/home/services` | الخدمات |

### بوابة المواطن
| المسار | الوصف |
|--------|-------|
| `/citizen/register` | تسجيل حساب |
| `/citizen/login` | تسجيل دخول |
| `/citizen/services` | الخدمات المتاحة |
| `/citizen/services/create/{type}` | تقديم طلب |
| `/citizen/my-requests` | طلباتي |
| `/citizen/inquiry` | استفسار |
| `/citizen/profile` | الملف الشخصي |

### لوحة التحكم
| المسار | الوصف |
|--------|-------|
| `/cms/loginType` | اختيار نوع الدخول |
| `/cms/{guard}/login` | تسجيل دخول الإدارة / الكتّاب |
| `/cms/admin/countries` | إدارة الدول |
| `/cms/admin/cities` | إدارة المدن |
| `/cms/admin/categories` | التصنيفات |
| `/cms/admin/articles` | المقالات |
| `/cms/admin/admins` | المشرفين |
| `/cms/admin/authors` | الكتّاب |
| `/cms/admin/sliders` | الشريط المتحرك |
| `/cms/admin/contacts` | رسائل الزوار |
| `/cms/admin/roles` | الأدوار |
| `/cms/admin/permissions` | الصلاحيات |

### موظف الخدمات
| المسار | الوصف |
|--------|-------|
| `/cms/service-employee/login` | تسجيل دخول |
| `/cms/service-employee/dashboard` | لوحة الإحصائيات |
| `/cms/service-employee/requests` | الطلبات |
| `/cms/service-employee/inquiries` | الاستفسارات |
| `/cms/service-employee/profile` | الملف الشخصي |

---

## 📄 الترخيص

هذا المشروع مرخص تحت [MIT License](LICENSE).
