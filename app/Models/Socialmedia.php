<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Socialmedia extends Model
{
    use HasFactory, HasAuditTrail;

    protected $fillable = ['link', 'isactive', 'url'];

    public function referenceDetail()
    {
        return $this->belongsTo(ReferenceDetail::class, 'link', 'value');
    }
}
