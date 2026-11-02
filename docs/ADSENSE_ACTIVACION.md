# Activación autorizada de AdSense

Fecha: 2026-11-01. El propietario solicitó expresamente dejar activa la integración para su próximo despliegue. Esta instrucción sustituye la decisión anterior de mantener el script apagado.

## Estado actual

- `config/adsense.php`: ADSENSE_ENABLED=true por defecto; puede deshabilitarse con ADSENSE_ENABLED=false en el entorno y regeneración de caché habitual.
- `resources/views/partials/adsense-verification.blade.php`: carga asíncrona única del script oficial con ca-pub-9068723123011153 y crossorigin=anonymous, en portada y diez guías. No añade anuncios a fichas, paneles o páginas legales.
- Verificación por meta sigue desactivada; no se duplica con el script activo. ID inválido o sin confirmación no genera script.
- `public/ads.txt` conserva el editor real proporcionado.
- Se actualizan privacidad, cookies y términos para describir la presencia del código, sin afirmar que Google ya esté mostrando anuncios.
- GA4 conserva sus bloques byte a byte; no se cambia consentimiento, eventos, ID ni carga.

## Despliegue y límites

No se desplegó desde esta sesión. Publicar estos cambios y regenerar las cachés de configuración/vistas de Laravel mediante el proceso habitual. Comprobar que el entorno de producción no tenga ADSENSE_ENABLED=false ni caché anterior. Revisar HTML: un solo adsbygoogle.js por página turística.

La aparición de anuncios depende de la aprobación y configuración del sitio en AdSense. No se accedió al panel, habilitaron allí anuncios automáticos ni crearon bloques manuales. La carga del script permite la integración configurada en esa cuenta, sin garantizar anuncios visibles.

La CMP, configuración regional, revisión legal (incluida dirección omitida por instrucción), derechos de imágenes y demás pendientes anteriores siguen pendientes. El banner actual no controla anuncios ni GA4 y no equivale a CMP certificada o Consent Mode. La autorización de activar el código no acredita cumplimiento ni aprobación de Google.

Las evidencias anteriores de «cero scripts publicitarios» describen la versión previa; no describen esta activación. Las pruebas actuales validan un script en portada/guías, ninguno en contacto, apagado configurable y ausencia de duplicación de metadata.

Validación: 13 pruebas / 400 assertions pasan; Blade compilado, bloques GA4 idénticos al respaldo y git diff --check sin errores. No se ejecutó publicidad externa ni tráfico artificial para probarlo.
