<?php

namespace App\Http\Controllers;

use App\Support\SitePublication;
use Illuminate\Http\Response;

class InformationController extends Controller
{
    private const PAGES = [
        'privacy' => ['Aviso de privacidad', '/aviso-de-privacidad', 'Datos que utiliza Visita Jalisco, finalidades del tratamiento, privacidad, derechos ARCO y contacto del responsable.'],
        'cookies' => ['Política de cookies', '/politica-de-cookies', 'Cookies de sesión, Google Analytics y almacenamiento local: cómo funcionan y qué controles ofrece Visita Jalisco.'],
        'terms' => ['Términos y condiciones', '/terminos-y-condiciones', 'Alcance de la guía turística Visita Jalisco, información editorial y comercial, servicios externos y condiciones de uso.'],
        'about' => ['Sobre nosotros', '/sobre-nosotros', 'Conoce qué ofrece Visita Jalisco, su independencia del gobierno y cómo se prepara y corrige la información turística.'],
        'contact' => ['Contacto', '/contacto', 'Cómo contactar al operador de Visita Jalisco para consultas, correcciones, derechos de imágenes y privacidad.'],
    ];

    public function show(string $page): Response
    {
        abort_unless(isset(self::PAGES[$page]), 404);
        [$title, $path, $description] = self::PAGES[$page];
        $available = match ($page) {
            'privacy', 'terms' => SitePublication::canPublishLegalInformation(),
            'contact' => SitePublication::contactReady(),
            default => true,
        };
        $unavailableMessage = match ($page) {
            'privacy' => 'El aviso de privacidad requiere datos confirmados del responsable antes de su publicación.',
            'terms' => 'Las condiciones de uso requieren la confirmación del operador antes de su publicación.',
            default => 'El canal de contacto no está habilitado sin la confirmación de su responsable.',
        };
        $updatedAt = in_array($page, ['privacy', 'terms'], true)
            ? config('site_operator.legal_updated_at')
            : '2026-11-01';
        // Una página informativa no constituye validación jurídica ni aprobación AdSense.
        $indexable = $available && in_array($path, SitePublication::indexableInformationPaths(), true);
        $response = response()->view($page === 'privacy' ? 'privacy' : 'information.'.$page,
            compact('title', 'path', 'description', 'available', 'indexable', 'updatedAt', 'unavailableMessage'),
            $available ? 200 : 503);

        if (! $available) {
            $response->header('X-Robots-Tag', 'noindex, follow')->header('Cache-Control', 'no-store');
        }

        return $response;
    }
}
