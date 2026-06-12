<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\PublicUrl;

class PremiumService extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'label',
        'description',
        'image_url',
        'link_url',
        'whatsapp',
        'position',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }

    public function imageUrl(): string
    {
        return PublicUrl::asset($this->image_url, 'assets/img/public-ad-placeholder.svg');
    }

    public function whatsappUrl(): ?string
    {
        if (! $this->whatsapp) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $this->whatsapp);

        return $phone ? "https://wa.me/{$phone}" : null;
    }
}
