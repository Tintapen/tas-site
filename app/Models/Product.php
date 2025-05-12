<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Product extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = [
        'name',
        'isactive',
        'categories_id',
        'logo',
        'content_id',
        'content_en',
        'isfeatured'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function scopeFeatured($query)
    {
        return $query->where('isfeatured', 'Y');
    }
}
