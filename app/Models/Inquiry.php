<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'citizen_id', 'subject', 'message', 'employee_id', 'response',
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }

    public function employee()
    {
        return $this->belongsTo(ServiceEmployee::class, 'employee_id');
    }
}
