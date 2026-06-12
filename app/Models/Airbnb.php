<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Support\PublicUrl;

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

        return PublicUrl::asset($image, $fallback ?: 'assets/img/airbnb-card-1.svg');
    }

    public function galleryImageUrls(): array
    {
        return collect($this->gallery_images ?? [])
            ->map(fn ($image) => PublicUrl::asset($image))
            ->filter()
            ->values()
            ->all();
    }
}
