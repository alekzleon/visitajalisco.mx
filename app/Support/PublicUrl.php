<?php

namespace App\Support;

class PublicUrl
{
    public static function asset(?string $path, ?string $fallback = null): string
    {
        $path = $path ?: $fallback;

        if (! $path) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }

        $baseUrl = rtrim((string) config('app.asset_url', config('app.url')), '/');

        return $baseUrl . '/' . ltrim($path, '/');
    }
}
