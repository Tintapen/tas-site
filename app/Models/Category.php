<?php

namespace App\Models;

use App\Traits\HasAuditTrail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = ['name', 'isactive', 'level', 'parent_id', 'principals_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function principal()
    {
        return $this->belongsTo(Principal::class, 'principals_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeLeaf($query)
    {
        return $query->whereDoesntHave('children');
    }

    public function topLevelCategory(): self
    {
        $current = $this;
        while ($current->parent) {
            $current = $current->parent;
        }
        return $current;
    }

    // Ambil nama principal dari kategori level 1
    public function getTopPrincipalName(): ?string
    {
        $top = $this->topLevelCategory();
        return $top->principal?->name;
    }

    public function fullNameWithPrincipal(): string
    {
        $names = [];
        $current = $this;
        while ($current) {
            array_unshift($names, $current->name);
            $current = $current->parent;
        }

        $label = implode(' > ', $names);

        $principalName = $this->getTopPrincipalName();
        return $principalName ? "$label — $principalName" : $label;
    }

    public static function getAllChildCategories($parentIds, &$collectedIds = [])
    {
        $children = Category::whereIn('parent_id', $parentIds)->pluck('id');

        if ($children->isEmpty()) {
            return;
        }

        // Simpan anak-anak ke daftar akhir
        foreach ($children as $childId) {
            if (!in_array($childId, $collectedIds)) {
                $collectedIds[] = $childId;
            }
        }

        // Rekursif lagi untuk cari anak dari anak
        self::getAllChildCategories($children, $collectedIds);
    }

    public function childrenRecursive()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('childrenRecursive');
    }
}
