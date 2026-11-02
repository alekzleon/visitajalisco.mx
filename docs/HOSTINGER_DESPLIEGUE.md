# Hostinger — servir el proyecto sin mover public

Fecha: 2026-11-01. Se añadió `.htaccess` en la raíz usando la estructura propuesta por el propietario. Permite que el directorio del dominio contenga el proyecto completo y que las solicitudes se reescriban internamente hacia `public/`. No se mueven archivos ni se cambia index.php.

## Cambios

- `.htaccess` raíz: desactiva índices/MultiViews, bloquea rutas ocultas salvo .well-known, pasa la ejecución a public/.htaccess y reescribe también solicitudes de archivos existentes para no servir fuentes/archivos de la raíz. Si mod_rewrite no está disponible, deniega acceso en lugar de exponer el proyecto.
- `public/.htaccess`: conserva manejo de Authorization, X-XSRF-Token y front controller. Añade bloqueo de ocultos para accesos directos a public/ y corrige la redirección de barra final usando THE_REQUEST (ruta original del cliente). Sin esa corrección, la prueba de /destinos/ajijic/ devolvía /public/destinos/ajijic.
- No se modifica Analytics, AdSense, rutas Laravel, formularios, base de datos ni lógica comercial.

## Cómo subir

Con el directorio del dominio apuntando al proyecto, subir la estructura completa con ambos .htaccess: el nuevo en la raíz y el existente dentro de public/. Conservar public/ como carpeta; no trasladar su contenido ni editar las rutas de bootstrap de index.php.

El hosting debe aplicar estas directivas de Apache/LiteSpeed y permitir las opciones y reglas de .htaccess. No se cambió el panel de Hostinger desde esta sesión. Si el hosting permite que DocumentRoot apunte directamente a public/, esa opción también sigue funcionando.

Configurar APP_URL y, si se define, ASSET_URL con el dominio público correcto, sin localhost ni un /public añadido por esta estructura. No cambiar la configuración de Analytics. Regenerar las cachés de Laravel mediante el proceso habitual del despliegue.

Los recursos públicos, ads.txt y robots.txt se solicitan como /assets/…, /ads.txt y /robots.txt. La excepción ACME permite el archivo público en public/.well-known/acme-challenge/; la gestión de SSL propia de Hostinger puede tener otro manejo y debe comprobarse allí. La excepción no publica indiscriminadamente archivos de una .well-known situada fuera de public/.

## Pruebas

Apache local real, configuración temporal y fixtures con marcadores ficticios (sin secretos ni base de datos): **21 solicitudes comprobadas**, con proyecto como raíz, sin mod_rewrite y con public/ como DocumentRoot. Syntax OK; git diff --check sin errores.

- Rutas y POST llegan al front controller sin redirección añadida al POST normal.
- Assets/ads.txt/robots.txt se sirven como públicos; ads.txt es text/plain y conserva su línea real.
- .env, .git/config y public/.env bloqueados; composer.json, archivo ZIP y fuente PHP internos nunca devuelven el marcador privado.
- Barra final redirige sin introducir /public/ y conserva query string.
- ACME público accesible. Sin mod_rewrite: 403, sin exposición de raíz.

Evidencia: hosting-evidencias/apache-htaccess.json. El front controller de la fixture es un marcador, por lo que los 200 de esa prueba acreditan reescritura, no estados de rutas Laravel inexistentes ni ejecución de PHP. No se afirma prueba del servidor Hostinger: tras subir, comprobar portada, una guía, login, código Airbnb, assets, ads.txt y ausencia de acceso a archivos internos. Los procesos Apache temporales se cerraron al finalizar.

Referencia técnica: [mod_rewrite en Apache 2.4](https://httpd.apache.org/docs/2.4/mod/mod_rewrite.html) y [flags de reescritura](https://httpd.apache.org/docs/2.4/rewrite/flags.html). Se conserva L para permitir el procesamiento posterior de public/.htaccess; no se sustituye por END en el salto interno.
