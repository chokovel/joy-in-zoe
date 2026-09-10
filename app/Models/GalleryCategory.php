<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'cover_image', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function publishedImages(): HasMany
    {
        return $this->hasMany(GalleryImage::class)->where('is_published', true);
    }

    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_image) {
            return asset('storage/'.$this->cover_image);
        }

        $cover = $this->publishedImages()->first();

        return $cover ? $cover->url : asset('images/gallery/preview-1.jpg');
    }

    public function getImageCountAttribute(): int
    {
        return $this->publishedImages()->count();
    }
}
