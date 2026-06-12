<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AnalyticsEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'zone_id',
        'airbnb_id',
        'business_id',
        'public_ad_id',
        'premium_service_id',
        'destination',
        'code',
        'target_url',
        'url',
        'referrer',
        'ip_hash',
        'user_agent',
        'meta',
        'occurred_at',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'occurred_at' => 'datetime',
        ];
    }

    public static function record(string $eventType, Request $request, array $data = []): self
    {
        $ip = $request->ip();

        return self::create(array_merge([
            'event_type' => $eventType,
            'url' => $request->fullUrl(),
            'referrer' => $request->headers->get('referer'),
            'ip_hash' => $ip ? hash('sha256', $ip . config('app.key')) : null,
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
            'occurred_at' => now(),
        ], $data));
    }
}
