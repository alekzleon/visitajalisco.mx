# Etapa 1 — Auditoría previa

Fecha de consulta: 2026-11-01 (México). Estado previo a cambios de aplicación.

## Respaldo y stack

Repositorio limpio al inicio. Base recuperable: commit `7f98bc9d0d7a4ab4590eaf78aff7119afa37809e`; archivo local `/private/tmp/visitajalisco-etapa1-baseline.tar` (sin .env ni base de datos). Laravel 11, PHP >=8.2, Blade renderizado en servidor; Vite/Tailwind disponibles, pero portada con CSS/JS inline. No CMS de destinos: diez tarjetas literales en `resources/views/welcome.blade.php`. No se requieren migraciones, paquetes ni reestructuración. Hosting/proceso de despliegue no acreditados por el README (plantilla de Laravel).

## Inventario previo y decisiones

| URL | HTTP previo | Indexabilidad / contenido / SEO | Mejora mínima | Riesgo |
| --- | --- | --- | --- | --- |
| https://visitajalisco.mx/ | 200 público por curl | Un H1 JALISCO; es-MX; description, canonical sin slash final, OG/Twitter, JSON-LD TouristInformationCenter; diez tarjetas sin enlaces ni texto turístico | Metadatos coherentes, WebSite sin atribuir oficina física; enlazar guías | Conservar scripts y módulos |
| /#inicio, /#destinos, /#rutas, /#locales, /#contacto | Anclas de /, no URLs independientes | Inicio, carrusel turístico, hospedajes, anuncios/negocios, servicios | Conservar todos los IDs | No sustituir rutas comerciales |
| /destinos/{slug} (los diez) | No existen en router previo | No hay páginas turísticas independientes | Añadir guías Blade con contenido diferenciado, enlaces y metadatos | Sin alterar /track/destinos |
| /track/destinos/{destination} | Ruta existente; redirige a /#destinos | Registra interés; no es una guía | Ningún cambio | Tracking excluido |
| /robots.txt | 200 público | User-agent *, Disallow vacío; sin sitemap | Añadir solo Sitemap | No bloquear módulos |
| /sitemap.xml | 404 público confirmado por curl | No archivo ni ruta en repositorio | Sitemap dinámico de portada y diez guías | Sin incluir fichas no auditadas |
| /aviso-de-privacidad | 200 público | Canonical propio; secciones #cookies y #terminos reales | Documentar revisión humana | No improvisar textos legales |
| /ads.txt | 404 público | Sin archivo ni script AdSense encontrado | Documentar Publisher ID pendiente | No activar anuncios |
| /estancias/{code}, POST /codigo-airbnb | Rutas existentes | Ficha y búsqueda comercial | Ningún cambio | Fuera de etapa |
| /login, /dashboard, /business, /airbnb, /api/*, /track/* | Rutas inventariadas con route:list | Autenticación, APIs y comercio | Ningún cambio | Fuera de etapa |

Los diez nombres publicados son Tequila, Ajijic, Chapala, Lagos de Moreno, Mascota, Mazamitla, Cocula, Sayula, Tapalpa y San Pedro Tlaquepaque. No se agregan municipios. El idioma ES es texto, no un selector funcional. Menú con anclas, formulario POST de código con CSRF, carruseles de hospedajes y destinos y controles anteriores/siguientes; enlaces de WhatsApp/reserva/servicios gestionados por rutas track. Se conserva su código.

## Analytics y terceros (inventario, sin IDs)

GA4 condicionado por `config(services.google_analytics.measurement_id)` en welcome y otras vistas públicas existentes; configuración en `config/services.php`. Backend de eventos en `AnalyticsEvent`, `TrackingController` y rutas existentes. Conservar todos byte a byte salvo adiciones de rutas SEO en el archivo compartido (bloques preexistentes idénticos). Banner de cookies propio con localStorage y aceptación; no se identifica CMP certificada en código. No modificar consentimiento, scripts, IDs ni cargas. No extender Analytics a las nuevas guías: requiere decisión posterior sobre medición, fuera de autorización actual.

## Baseline y límites

`php artisan test`: 2 pruebas, 2 assertions, pasan antes de editar. `php artisan route:list --except-vendor`: 59 rutas. curl público: portada 200, robots 200, sitemap 404, privacidad 200, ads.txt 404. El lector web no pudo abrir el dominio; curl sí, por eso no se dedujo ausencia por error de rastreo.

No existe baseline de dos guías: aún no existen. Lighthouse no instalado en PATH al auditar. No se inventan LCP, CLS ni INP; INP necesita interacciones/campo, no una carga sintética. Evidencia móvil/escritorio y métricas por obtener durante validación si hay herramientas disponibles. Pesos originales: Ajijic 3,990,566 bytes, Cocula 1,383,751 bytes; vídeo compartido 26,241,384 bytes. Priorizar variantes de imágenes turísticas sin modificar vídeo ni módulos comerciales. Derechos de imágenes: activos preexistentes; titularidad/créditos pendientes de confirmación, no se atribuye licencia nueva.

## Confirmado frente a pendiente

Confirmado: ausencia de páginas de destino/sitemap, tarjetas sin enlaces, metadatos presentes, tipo TouristInformationCenter sin evidencia de oficina física, política única con secciones distintas, banner propio. Pendiente: indexación real en Google, propiedad Search Console, funcionamiento GA4 en cuenta, identidad jurídica/contacto operativo, derechos de fotografías, elegibilidad AdSense, CWV de campo, infraestructura de producción. No desplegar ni afirmar verificación de cuentas.
