<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class ReferenceDetail extends Model
{
    use HasFactory, HasAuditTrail;

    protected $fillable = ['value', 'name', 'description', 'isactive'];

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'references_id');
    }
}
