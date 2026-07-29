<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'tracking_number', 'citizen_id', 'service_type', 'description',
        'file_path', 'status', 'employee_id', 'admin_response',
    ];

    const SERVICE_TYPES = [
        'license' => 'ترخيص',
        'certificate' => 'شهادة',
        'road_maintenance' => 'صيانة شارع',
        'waste_container' => 'حاوية نفايات',
        'tree_pruning' => 'تقليم أشجار',
    ];

    const STATUSES = [
        'pending' => 'قيد الانتظار',
        'under_study' => 'قيد الدراسة',
        'awaiting_review' => 'بانتظار المراجعة',
        'completed' => 'تم الإنجاز',
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }

    public function employee()
    {
        return $this->belongsTo(ServiceEmployee::class, 'employee_id');
    }

    public static function generateTrackingNumber()
    {
        $year = now()->year;
        $lastRequest = static::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        $nextNumber = $lastRequest ? ((int) substr($lastRequest->tracking_number, 5)) + 1 : 1;
        return $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
