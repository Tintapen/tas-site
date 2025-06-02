<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAuditTrail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;
    use HasAuditTrail;

    protected $fillable = [
        'isactive',
        'title_id',
        'title_en',
        'content_id',
        'content_en',
        'posted_at',
        'thumbnail',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($news) {
            if ($news->title_en) {
                $news->slug = Str::slug($news->title_en);
            }
        });

        static::updating(function ($model) {
            $oldFiles = collect([
                ...self::getAttachmentsFromContent($model->getOriginal('content_id') ?? ''),
                ...self::getAttachmentsFromContent($model->getOriginal('content_en') ?? ''),
            ]);

            $newFiles = collect([
                ...self::getAttachmentsFromContent($model->content_id ?? ''),
                ...self::getAttachmentsFromContent($model->content_en ?? ''),
            ]);

            $unusedFiles = $oldFiles->diff($newFiles);

            foreach ($unusedFiles as $file) {
                Storage::disk('public')->delete('attachments/' . $file);
            }
        });

        static::deleting(function ($model) {
            $files = collect([
                ...self::getAttachmentsFromContent($model->content_id ?? ''),
                ...self::getAttachmentsFromContent($model->content_en ?? ''),
            ]);

            foreach ($files as $file) {
                Storage::disk('public')->delete('attachments/' . $file);
            }
        });
    }

    private static function getAttachmentsFromContent(string $content): array
    {
        preg_match_all('/storage\/attachments\/([^\"]+)/', $content, $matches);
        return $matches[1] ?? [];
    }
}
