<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Department extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = [
        'name',
        'description',
        'isactive'
    ];
}
