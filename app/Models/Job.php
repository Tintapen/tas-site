<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;
use Illuminate\Support\Str;

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
        'isexpired',
        'vacancy',
        'job_nature',
        'job_type',
        'salary',
        'application_deadline',
        'slug',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($job) {
            if ($job->title_en) {
                $job->slug = Str::slug($job->title_en);
            }
        });
    }
}
