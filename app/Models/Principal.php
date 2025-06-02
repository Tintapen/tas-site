<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;
use Illuminate\Support\Str;

class Principal extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = [
        'name',
        'isactive',
        'order',
        'description',
        'slug',
        'logo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($principal) {
            if ($principal->name) {
                $principal->slug = Str::slug($principal->name);
            }
        });
    }
}
