<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'confirmation_token',
        'is_active',
        'is_confirmed',
        'subscribed_at',
        'confirmed_at',
    ];

    protected static function booted(): void
    {
        static::creating(function (Subscriber $subscriber) {
            if (empty($subscriber->confirmation_token)) {
                $subscriber->confirmation_token = Str::random(64);
            }
        });
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_confirmed' => 'boolean',
            'subscribed_at' => 'datetime',
            'confirmed_at' => 'datetime',
        ];
    }
}
