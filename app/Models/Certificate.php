<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Certificate extends Model
{
    use HasFactory, HasAuditTrail;

    protected $fillable = [
        'name',
        'isactive',
        'logo',
    ];
}
