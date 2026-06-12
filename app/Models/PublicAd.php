<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
        'link_url',
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
        return $this->image_url ?: asset('assets/img/public-ad-placeholder.svg');
    }
}
