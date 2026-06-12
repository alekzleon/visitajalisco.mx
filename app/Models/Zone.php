<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'area',
        'summary',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function airbnbs(): HasMany
    {
        return $this->hasMany(Airbnb::class);
    }

    public function businesses(): HasMany
    {
        return $this->hasMany(Business::class);
    }
}
