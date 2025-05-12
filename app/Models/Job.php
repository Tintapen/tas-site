<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Job extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = [
        'title_id',
        'title_en',
        'isactive',
        'location',
        'description_id',
        'description_en',
        'department_id',
        'expired_at',
        'isexpired'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
