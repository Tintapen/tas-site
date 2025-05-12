<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Milestone extends Model
{
    use HasFactory, HasAuditTrail;

    protected $fillable = ['description', 'isactive', 'milestone_date'];
}
