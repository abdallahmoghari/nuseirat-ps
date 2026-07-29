<?php

namespace Database\Seeders;

use App\Models\Citizen;
use App\Models\ServiceEmployee;
use App\Models\ServiceRequest;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CitizenServiceSeeder extends Seeder
{
    public function run(): void
    {
        // --- Test Citizens ---
        $citizen1 = Citizen::create([
            'first_name' => 'أحمد',
            'last_name' => 'المواطن',
            'email' => 'citizen@test.com',
            'password' => Hash::make('123456'),
            'phone' => '0599000001',
            'id_number' => '800000001',
        ]);

        $citizen2 = Citizen::create([
            'first_name' => 'سارة',
            'last_name' => 'المواطنة',
            'email' => 'sara@test.com',
            'password' => Hash::make('123456'),
            'phone' => '0599000002',
            'id_number' => '800000002',
        ]);

        // --- Test Service Employees ---
        $emp1 = ServiceEmployee::create([
            'name' => 'محمد المسؤول',
            'email' => 'emp1@nuseirat.ps',
            'password' => Hash::make('123456'),
            'department' => 'قسم التراخيص',
            'phone' => '0599000011',
        ]);

        $emp2 = ServiceEmployee::create([
            'name' => 'علي المشرف',
            'email' => 'emp2@nuseirat.ps',
            'password' => Hash::make('123456'),
            'department' => 'قسم الصيانة',
            'phone' => '0599000012',
        ]);

        // --- Sample Service Requests ---
        $requests = [
            ['citizen_id' => 1, 'service_type' => 'license', 'description' => 'أريد ترخيصاً لمحل تجاري في شارع الوحدة', 'status' => 'under_study', 'tracking_number' => '2026-1001', 'employee_id' => $emp1->id],
            ['citizen_id' => 1, 'service_type' => 'certificate', 'description' => 'طلب شهادة إثبات سكن للمخيم', 'status' => 'pending', 'tracking_number' => '2026-1002'],
            ['citizen_id' => 2, 'service_type' => 'road_maintenance', 'description' => 'الشارع الرئيسي بحاجة إلى صيانة بسبب الحفر', 'status' => 'completed', 'tracking_number' => '2026-1003', 'employee_id' => $emp2->id, 'admin_response' => 'تمت الصيانة بتاريخ 2026-07-15'],
            ['citizen_id' => 2, 'service_type' => 'waste_container', 'description' => 'نحتاج حاوية نفايات إضافية في حي الشهداء', 'status' => 'awaiting_review', 'tracking_number' => '2026-1004'],
        ];

        foreach ($requests as $r) {
            ServiceRequest::create($r);
        }

        // --- Sample Inquiries ---
        Inquiry::create([
            'citizen_id' => 1,
            'subject' => 'مواعيد الدوام',
            'message' => 'ما هي مواعيد دوام البلدية في شهر رمضان؟',
        ]);

        Inquiry::create([
            'citizen_id' => 2,
            'subject' => 'فاتورة المياه',
            'message' => 'كيف يمكنني سداد فاتورة المياه إلكترونياً؟',
            'employee_id' => $emp1->id,
            'response' => 'يمكنك سداد الفاتورة عبر تطبيق فوري أو من خلال أي من فروع البنك',
        ]);
    }
}
