<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'user_id',
        'name',
        'category',
        'distance',
        'description',
        'ad_slot',
        'image_url',
        'whatsapp',
        'maps_url',
        'instagram_username',
        'facebook_username',
        'tiktok_username',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
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

    public function whatsappUrl(): ?string
    {
        if (! $this->whatsapp) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $this->whatsapp);

        return $phone ? "https://wa.me/{$phone}" : null;
    }

    public function imageUrl(): string
    {
        return $this->image_url ?: asset('assets/img/business-placeholder.svg');
    }

    public function mapsUrl(): ?string
    {
        return $this->maps_url ?: null;
    }

    public function instagramUrl(): ?string
    {
        return $this->socialUrl('https://instagram.com/', $this->instagram_username);
    }

    public function facebookUrl(): ?string
    {
        return $this->socialUrl('https://facebook.com/', $this->facebook_username);
    }

    public function tiktokUrl(): ?string
    {
        return $this->socialUrl('https://www.tiktok.com/@', $this->tiktok_username);
    }

    private function socialUrl(string $baseUrl, ?string $username): ?string
    {
        $username = $this->cleanUsername($username);

        return $username ? $baseUrl . $username : null;
    }

    public function cleanUsername(?string $username): ?string
    {
        if (! $username) {
            return null;
        }

        $username = trim($username);
        $username = ltrim($username, '@');

        return $username !== '' ? $username : null;
    }
}
