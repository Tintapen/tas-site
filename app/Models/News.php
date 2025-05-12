<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class News extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = [
        'isactive',
        'title_id',
        'title_en',
        'content_id',
        'content_en',
        'posted_at',
        'thumbnail',
    ];
}
