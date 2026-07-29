<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ServiceEmployee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'department', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'employee_id');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'employee_id');
    }
}
