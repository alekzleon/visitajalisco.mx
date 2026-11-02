# Etapa 1 — Inventario de URLs

Fecha: 2026-11-01. Host canónico: https://visitajalisco.mx (HTTPS, sin www). Todas las nuevas guías son HTML del servidor, no dependen de JavaScript. No se renombró ni redirigió ninguna URL anterior.

| URL absoluta | HTTP previo público | HTTP posterior local Laravel | Canonical | Indexable prevista | Sitemap | Enlaces de entrada |
| --- | --- | --- | --- | --- | --- | --- |
| https://visitajalisco.mx/ | 200 | 200 | https://visitajalisco.mx/ | Sí | Sí | Navegación/retornos |
| https://visitajalisco.mx/destinos/tequila | No existía en router | 200 | https://visitajalisco.mx/destinos/tequila | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/ajijic | No existía en router | 200 | https://visitajalisco.mx/destinos/ajijic | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/chapala | No existía en router | 200 | https://visitajalisco.mx/destinos/chapala | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/lagos-de-moreno | No existía en router | 200 | https://visitajalisco.mx/destinos/lagos-de-moreno | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/mascota | No existía en router | 200 | https://visitajalisco.mx/destinos/mascota | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/mazamitla | No existía en router | 200 | https://visitajalisco.mx/destinos/mazamitla | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/cocula | No existía en router | 200 | https://visitajalisco.mx/destinos/cocula | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/sayula | No existía en router | 200 | https://visitajalisco.mx/destinos/sayula | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/tapalpa | No existía en router | 200 | https://visitajalisco.mx/destinos/tapalpa | Sí | Sí | Carrusel portada y guías relacionadas |
| https://visitajalisco.mx/destinos/tlaquepaque | No existía en router | 200 | https://visitajalisco.mx/destinos/tlaquepaque | Sí | Sí | Carrusel portada y guías relacionadas |

| Recurso / módulo | Previo público o código | Posterior | Decisión |
| --- | --- | --- | --- |
| /robots.txt | 200 público, sin restricciones | Archivo estático con la misma política más Sitemap | No introduce bloqueos |
| /sitemap.xml | 404 público | 200 local, XML, 11 URLs únicas | Portada y diez destinos; sin lastmod artificial |
| /aviso-de-privacidad | 200 público | 200 local, mismo código | Fuera del sitemap de destinos por alcance, sin cambiar indexabilidad |
| /aviso-de-privacidad#cookies y #terminos | Secciones de la misma URL | IDs presentes en HTML | No son documentos separados; revisión legal pendiente |
| /#inicio, /#destinos, /#rutas, /#locales, /#contacto | Secciones de portada | IDs conservados | No son páginas indexables separadas |
| /track/destinos/{destination} | Redirect con evento | Mismo contrato, /tequila redirige a /#destinos en prueba | Tracking intacto |
| /estancias/{code}, /codigo-airbnb | Ficha y búsqueda | Regresión con registros sintéticos aislados | Sin cambios, sin incluir ni excluir del buscador |
| /login, /dashboard, /airbnb, /business, /api, /track | Router existente | Sin cambio de rutas existentes | No se auditan ni incluyen en sitemap |
| /ads.txt | 404 público | No creado | Requiere datos reales de cuenta |

No se afirma que las nuevas URLs estén desplegadas o indexadas. Después del despliegue verificar estado público, canonical, ausencia de X-Robots-Tag noindex del servidor/CDN y disponibilidad de assets. Propiedad e indexación en Google: NO VERIFICADAS para todas las URLs. Variantes www/HTTP y cabeceras del hosting: pendientes de auditoría operativa; no se añaden redirecciones globales.
