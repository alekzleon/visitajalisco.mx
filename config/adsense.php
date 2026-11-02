<?php

return [
    // Carga autorizada por el propietario; independiente de GA4.
    'enabled' => env('ADSENSE_ENABLED', true),
    'verification_enabled' => env('ADSENSE_VERIFICATION_ENABLED', false),
    'publisher_verified' => true, // ID confirmado por el propietario; no estado de aprobación en Google.
    'publisher_id' => 'pub-9068723123011153',
];
