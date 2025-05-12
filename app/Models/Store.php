<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Store extends Model
{
    use HasFactory, HasAuditTrail;

    protected $fillable = ['name', 'isactive', 'store', 'url'];

    public function referenceDetail()
    {
        return $this->belongsTo(ReferenceDetail::class, 'store', 'value');
    }
}
