<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Store extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = ['name', 'isactive', 'store', 'url'];

    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class, 'store', 'name');
    }
}
