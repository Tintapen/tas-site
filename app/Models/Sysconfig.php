<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;

class Sysconfig extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = [
        'value',
        'name',
        'description',
        'isactive'
    ];

    public static function getValue(string $name, $default = null)
    {
        return static::where('name', $name)->where('isactive', 'Y')->value('value') ?? $default;
    }
}
