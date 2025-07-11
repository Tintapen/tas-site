<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Portfolio extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = [
        'company',
        'description_id',
        'description_en',
        'user',
        'division',
        'isactive',
    ];
}
