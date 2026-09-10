<?php

namespace App\Models;

use App\Support\HtmlSanitizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'location',
        'starts_at',
        'ends_at',
        'link',
        'link_text',
        'is_published',
    ];

    protected static function booted(): void
    {
        static::saving(function (Event $event) {
            if (empty($event->slug)) {
                $event->slug = static::uniqueSlug($event->title);
            }

            $event->title = htmlspecialchars(strip_tags($event->title), ENT_QUOTES, 'UTF-8');
            $event->description = HtmlSanitizer::clean($event->description);
        });
    }

    protected static function uniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/'.$this->image);
        }

        return '';
    }

    /**
     * Render the description safely. Descriptions entered via the rich text
     * editor are HTML; older plain-text entries are escaped with line breaks.
     */
    public function getDescriptionHtmlAttribute(): string
    {
        if (empty($this->description)) {
            return '';
        }

        if (preg_match('/<\s*[a-zA-Z]/', $this->description)) {
            return HtmlSanitizer::clean($this->description);
        }

        return nl2br(e($this->description));
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('starts_at', '>=', now()->startOfDay());
    }
}
