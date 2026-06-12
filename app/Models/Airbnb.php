<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airbnb extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'user_id',
        'name',
        'host',
        'code',
        'airbnb_url',
        'tower',
        'headline',
        'description',
        'gallery_images',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'gallery_images' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coverImageUrl(?string $fallback = null): string
    {
        $image = $this->gallery_images[0] ?? null;

        return $image ?: ($fallback ?: asset('assets/img/airbnb-card-1.svg'));
    }
}
