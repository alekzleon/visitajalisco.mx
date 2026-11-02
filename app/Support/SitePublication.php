<?php

namespace App\Support;

class SitePublication
{
    public static function contactReady(): bool
    {
        return config('site_operator.support_verified') === true
            && filter_var(config('site_operator.support_email'), FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function canPublishLegalInformation(): bool
    {
        $date = (string) config('site_operator.legal_updated_at');
        $validDate = preg_match('/\A(\d{4})-(\d{2})-(\d{2})\z/', $date, $parts)
            && checkdate((int) $parts[2], (int) $parts[3], (int) $parts[1]);

        return config('site_operator.identity_verified') === true
            && config('site_operator.publication_enabled') === true
            && trim((string) config('site_operator.name')) !== ''
            && config('site_operator.privacy_verified') === true
            && filter_var(config('site_operator.privacy_email'), FILTER_VALIDATE_EMAIL) !== false
            && $validDate;
    }

    public static function indexableInformationPaths(): array
    {
        $paths = ['/politica-de-cookies', '/sobre-nosotros'];
        if (self::contactReady()) {
            $paths[] = '/contacto';
        }
        if (self::canPublishLegalInformation() && config('site_operator.legal_reviewed') === true) {
            $paths[] = '/aviso-de-privacidad';
            $paths[] = '/terminos-y-condiciones';
        }

        return $paths;
    }

    public static function adsenseAccount(): ?string
    {
        $publisher = (string) config('adsense.publisher_id');

        if (config('adsense.publisher_verified') !== true
            || ! preg_match('/\Apub-(?!0{16}\z)\d{16}\z/', $publisher)) {
            return null;
        }

        return 'ca-'.$publisher;
    }
}
