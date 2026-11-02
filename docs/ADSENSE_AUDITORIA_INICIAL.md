# AdSense — auditoría inicial

Consulta: 2026-11-01. Auditoría de código previa a esta entrega; no equivale a revisión ni aprobación de Google.

## Estado y respaldo

Laravel 11/PHP 8.2+, Blade del servidor, CSS/JS de portada inline y build Vite/Tailwind disponible. Docroot esperado `public/`, front controller Laravel y `.htaccess` Apache; hosting, DNS y procedimiento real de despliegue no confirmados. No se detectaron instrucciones AGENTS.md en el proyecto. README todavía plantilla Laravel.

El árbol ya contiene cambios de la etapa turística y de diseño **sin commit**, que pertenecen al usuario y se conservan. Se respaldó el estado de trabajo actual, incluidos archivos nuevos, en `/private/tmp/visitajalisco-adsense-baseline/source.tar`; status, listado de rutas y SHA-256 en la misma carpeta. HEAD no representa el estado visual más reciente. No se hizo reset, commit ni cambio de rama sobre esos cambios ajenos; el respaldo permite restaurar archivos puntuales.

## Hallazgos confirmados

| Prioridad | Elemento | Evidencia de código / riesgo |
| --- | --- | --- |
| P0 | Privacidad incompleta | `resources/views/privacy.blade.php` solo identifica marca, sin operador/domicilio verificables; correo propuesto no confirmado; no procedimiento/plazos ARCO. No atribuir responsabilidad a Cloudi |
| P0 | Legales no independientes | Footer de portada y guías enlaza aviso y anclas #cookies/#terminos del mismo documento. No hay rutas autónomas cookies/términos/contacto/sobre-nosotros |
| P0 | Consentimiento | Banner solo oculta aviso o guarda `visita-jalisco-cookie-consent=accepted` en localStorage; no condiciona gtag. No es CMP/Consent Mode. Corregir consentimiento de GA4 entraría en conflicto con exclusión expresa; documentar, no alterar |
| P0 | GA4 | Configuración en config/services.php; snippets en welcome y stays/show, backend AnalyticsEvent/TrackingController/rutas. Preservar asignación, posición relativa de carga, scripts, ID y eventos |
| P0 | Fallback GA heredado | services.php contiene G-XXXXXXXXXX predeterminado; no corregir porque GA4 está excluido. Auditar configuración efectiva sin imprimir ID; propietario debe garantizar valor real por su proceso actual |
| P0 | AdSense | No se identifica ads.txt, ca-pub ni script AdSense en código inspeccionado. Sin ID confirmado no crear archivo ficticio ni cargar anuncios |
| P1 | Destinos | Ya hay diez guías útiles en config/destinations.php y plantilla común; sitemap de once URLs. No duplicar páginas ni rehacer diseño aprobado |
| P1 | Fotos | Nueve WebP y originales preexistentes; permisos/licencias no acreditados. No descargar ni inventar atribuciones |
| P1 | Comercio | Portada usa anuncios y servicios configurados; sección de anuncios no distingue claramente patrocinio en su encabezado. Etiquetar solo contexto comercial sin cambiar selección, precios o tracking |
| P1 | Transparencia | Portada aclara independencia; existen enlaces a redes. No hay canal de soporte/ARCO operativo demostrado |
| P2 | Enlaces externos | Facebook de portada abre otra pestaña sin rel=noopener; ajuste de seguridad puntual permitido |
| P2 | Infraestructura | No se ha acreditado redirección HTTPS/www por configuración del repositorio; verificar HTTP real antes de tocar reglas globales |

## Inventario de datos y proveedores

- Formulario público: código de hospedaje (POST), errores de validación y redirección. No introducir formularios nuevos sin canal real.
- Login: email/password/remember y sesión; administración de usuarios/negocios/hospedajes y medios comerciales existentes, fuera de modificación.
- Eventos propios: tipo, URL, referrer, user-agent truncado a 500, IP derivada mediante SHA-256 con clave de app, fecha, código/destino/IDs y metadatos según evento. IP derivada no debe describirse como anonimización garantizada. No hay política de borrado automático acreditada.
- GA4: librería de Google en páginas existentes con measurement_id; cookies y retención efectiva dependen de cuenta/configuración del navegador. No inferir 14 meses ni otros plazos de cuenta.
- Sesión Laravel/CSRF: nombre de sesión derivado de APP_NAME o SESSION_COOKIE, duración por configuración, remember si se selecciona. Identificar nombres reales en respuesta local sin publicar valores. No inventariar cookies publicitarias como si estuvieran instaladas.
- localStorage: clave de aceptación del aviso, sin expiración implementada en el código, borrable desde el navegador. No significa rechazo de analítica.
- Proveedores/enlaces: Google para analítica; enlaces externos de reserva, WhatsApp, mapas y redes según registro. Abrir un enlace no implica que sea embed activo. No se detectan embeds de terceros en la plantilla pública de guías.
- Configuración mail/servicios contiene conectores posibles; su existencia no prueba uso real. Hosting, correo, CDN, logs de infraestructura, regiones y retención siguen pendientes del propietario.

## Baseline y decisiones

La suite turística previa se ejecuta antes de editar. Se contrastará el HTTP público actual por separado; no asumir que los cambios locales ya están desplegados. Hay respaldo local del HTML público previo de etapa 1, pero no sustituye las consultas de esta auditoría.

Los textos definitivos de privacidad/términos requieren identidad, domicilio, contacto confirmado y revisión jurídica. Preparar vistas completas y bloquear su publicación si faltan esos datos; no rellenar con ejemplos. La página técnica de cookies puede describir hechos comprobados, sin atribuirle validación de consentimiento. Contacto no debe simular envío o mostrar correo supuesto. Se permitirá contenido institucional descriptivo comprobado, sin nombres inventados.

Consultar fuentes oficiales vigentes de AdSense y LFPDPPP (nueva ley 20-03-2025, texto consultado con reforma 14-11-2025). No usar documentación anterior como si fuera la versión actual. Las exigencias oficiales se distinguen de decisiones editoriales del proyecto en los reportes finales.

## Contraste público y datos recibidos durante el trabajo

HTTP público confirmado por solicitudes sin JavaScript (evidencia `adsense-evidencias/http-publico-antes.json`): portada y aviso 200; cookies/términos/contacto/sobre-nosotros/ads.txt/sitemap/guía Ajijic 404. Ruta inventada 404 auténtico. HTTP → HTTPS mediante 301 en ambos hosts. HTTPS con www responde 200 sin redirigir a no-www, pero declara canonical no-www. No se cambia globalmente el host en esta tarea: hacerlo sin revisar hosting/proxies/métodos POST podría afectar flujos excluidos. Revisar como mejora operativa posterior.

Cookies observadas por nombre en respuestas públicas de aplicación: XSRF-TOKEN y laravel_session. No se almacenan sus valores en reportes. No se ejecutó GA para inventariar cookies: nombres de Analytics y retención de cuenta siguen sin observación de navegador de producción. Código local de sesión database/120 minutos no se atribuye automáticamente a producción.

El propietario proporcionó después de la auditoría: operador «alejandro leo», correo «info@visitajalisco.mx» e instrucción expresa de no publicar dirección; entregó también su fragmento con `ca-pub-9068723123011153`. Es fuente de confirmación para identidad/contacto/ID, no evidencia de aprobación de Google ni una prueba de entrega de correo. No se recibió hosting, permisos de imágenes, estado de la cuenta o CMP.

La instrucción posterior sobre domicilio prevalece sobre el requisito inicial de completar ese campo: se publicará información factual sin dirección, sin afirmar suficiencia legal. Privacidad y términos permanecen noindex y fuera del sitemap hasta revisión jurídica. La identidad/domicilio exigidos por el artículo 15 de la [LFPDPPP vigente consultada](https://www.diputados.gob.mx/LeyesBiblio/pdf/LFPDPPP.pdf) siguen siendo un punto de revisión bloqueante para recomendar la solicitud.

Se detectó además una ayuda visible en login con credenciales iniciales y un seeder que puede reestablecerlas. Se retira la ayuda y el correo prellenado, sin cambiar autenticación, seeder ni cuentas. Corresponde al propietario comprobar/rotar credenciales y evitar ejecutar ese seeder en producción.
