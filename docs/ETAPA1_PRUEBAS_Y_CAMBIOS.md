# Etapa 1 — Pruebas, cambios y pendientes

Fecha: 2026-11-01. Implementación local terminada; despliegue y validaciones externas pendientes. Base: `7f98bc9d0d7a4ab4590eaf78aff7119afa37809e`. Respaldo de archivos rastreados: `/private/tmp/visitajalisco-etapa1-baseline.tar`. No se hizo commit ni despliegue. Los criterios que dependen de producción/cuentas, validación legal, derechos o datos de campo siguen pendientes; no se declara la etapa aprobada integralmente. Los cambios quedan en un diff revisable y archivos nuevos.

## Qué se encontró y corrigió

La portada contenía diez nombres/fotos sin páginas propias, y /sitemap.xml devolvía 404 público. Se añadieron diez guías diferenciadas renderizadas por servidor y dos rutas (guía y sitemap), conservando todas las anteriores. No se creó un índice redundante: /#destinos continúa siendo el índice mediante el carrusel. No hay nuevas tablas, dependencias, capas de aplicación ni cambios al build.

## Archivos modificados

| Archivo | Cambio y razón |
| --- | --- |
| resources/views/welcome.blade.php | Title/description/OG/Twitter coherentes; canonical raíz con slash, imagen OG raster existente; JSON-LD WebSite en lugar de TouristInformationCenter sin evidencia de oficina física; tarjetas convertidas en enlaces conservando clases/geometría/JS, indicación breve para abrir guías y foco visible; nueve variantes turísticas WebP |
| routes/web.php | Solo añade GET /destinos/{slug} y GET /sitemap.xml; validación de slug/404; bloques anteriores idénticos |
| public/robots.txt | Conserva User-agent y Disallow vacío; añade línea Sitemap |

## Archivos nuevos

| Archivo | Función |
| --- | --- |
| config/destinations.php | Diez guías con texto, fuentes, imágenes y relacionados; única lista de publicación para rutas/sitemap |
| resources/views/destinations/show.blade.php | HTML semántico es-MX, un H1, H2/H3, metadatos, canonical HTTPS propio, breadcrumbs, fuentes y TouristDestination/BreadcrumbList; sin tracking añadido |
| resources/views/destinations/sitemap.blade.php | XML de portada + diez guías, sin lastmod ficticio ni fichas Airbnb |
| public/assets/img/destinos/optimized/*.webp | Nueve variantes; conserva todos los originales. Sayula utiliza su JPEG original por ser menor |
| tests/Feature/TourismSeoTest.php | Seis pruebas de SEO y regresión con SQLite en memoria; migraciones y registros sintéticos solo en esa conexión |
| docs/ETAPA1_AUDITORIA_INICIAL.md | Auditoría previa, stack, respaldo, hallazgos y límites |
| docs/ETAPA1_INVENTARIO_URLS.md | Tabla de URLs/estados/canonicals/enlaces/indexabilidad prevista |
| docs/ETAPA1_FUENTES_DESTINOS.md | Fuentes fechadas, texto final por destino y límites editoriales |
| docs/ETAPA1_SEARCH_CONSOLE_GUIA.md | Pasos del propietario, sitemap e inspección |
| docs/ETAPA1_ADSENSE_CHECKLIST.md | Estados de preparación y dependencias humanas |
| docs/ETAPA1_PRUEBAS_Y_CAMBIOS.md | Este informe |
| docs/etapa1-evidencias/*.json | Comparaciones de integridad, pesos y resultados del navegador local |

## Pruebas realizadas

- Antes: `php artisan test` pasó 2 pruebas / 2 assertions. Router previo: 59 rutas. HTTP público por curl: / 200, robots 200, sitemap 404, aviso 200, ads.txt 404.
- Después: `php artisan test` pasó **8 pruebas / 246 assertions**. Seis pruebas nuevas usan base SQLite en memoria, sin editar migraciones ni fichas/productos reales.
- Diez guías: 200 por kernel Laravel; titles y descriptions únicos, canonical esperado, un H1 y contenido principal visible, relacionados existentes, imágenes disponibles y JSON-LD parseable/coherente. Slugs desconocidos/malformados: 404.
- Sitemap: 200, Content-Type application/xml, XML parseado con SimpleXML, once URLs únicas y exactas, sin lastmod ficticio. Robots conserva acceso y referencia al sitemap.
- Portada: 200, mismos IDs de anclas, formulario POST por código, controles y diez enlaces del carrusel.
- Código de estancia con espacios/minúsculas conserva normalización y redirect; código inexistente conserva error; ficha sintética válida 200 e inválida 404. Tracking de destino sigue redirigiendo a /#destinos. Dashboard sigue redirigiendo al login.
- Portada con fixtures de hospedaje/servicio/anuncio conserva salida visible. Redirecciones de reserva, WhatsApp de negocio/servicio, indicaciones y anuncio verificadas con URLs/telefonía sintéticas, sin visitar servicios externos.
- `php artisan view:cache` compiló las vistas. `php -l` sin errores en rutas, configuración de destinos y prueba nueva. `git diff --check` sin errores.
- Primer intento de fixture comercial falló por image_url obligatorio; se corrigió el fixture, no el esquema ni código comercial. Un intento previo de PHPUnit detectó sidecars ._ generados por macOS como clases; se eliminaron y la ejecución final pasó sin advertencias.

## Preservación de Analytics y exclusiones

Comparación con HEAD de bloques originales, no solo búsqueda por ID. Evidencia en `etapa1-evidencias/integridad.json`:

- Snippet GA4 y asignación de measurement_id: idénticos. SHA-256 del bloque GA4: `13f35829e0ec9f572b489cb885f061909e20f90e34de1793d9115a552a3aba72`.
- Bloque JavaScript completo de portada (incluye consentimiento y carruseles): idéntico. SHA-256: `f806c88959faf509a008c6d912a76fbe89dbb5dab552340a203892547ea36347`.
- Todos los bloques previos de routes/web.php idénticos después de retirar las dos adiciones SEO para comparar.
- config/services.php, AnalyticsEvent, TrackingController, vista de estancia y aviso de privacidad: byte a byte iguales a HEAD. Ningún modelo/controlador comercial, API, autenticación, plan, precio, ficha o base comercial fue modificado por la implementación.
- Sin segundo tag/gtag/GTM ni eventos nuevos. Las nuevas guías NO incorporan Analytics; extender cobertura requiere otra autorización por la exclusión expresa del usuario. No se cambió consentimiento ni dataLayer.
- No se ha comprobado recepción en la cuenta GA4: corresponde al propietario. En la prueba de navegador se bloquean peticiones externas para no producir medición artificial.

## Imágenes

cwebp, calidad 80, anchura máxima 1200 sin ampliar originales. Variantes nuevas con fallback original en guías; carrusel mantiene formato de fondo decorativo con nombre visible. Imagen principal con tamaño reservado/aspect-ratio y fetchpriority high, sin lazy. Se mantiene el vídeo compartido y los lazy existentes fuera del alcance.

| Destino | Original bytes | Servido bytes | Formato servido |
| --- | ---: | ---: | --- |
| tequila | 140700 | 101900 | WebP |
| ajijic | 3990566 | 143274 | WebP |
| chapala | 220696 | 93436 | WebP |
| lagos-de-moreno | 278660 | 135904 | WebP |
| mascota | 315895 | 168470 | WebP |
| mazamitla | 189221 | 153206 | WebP |
| cocula | 1383751 | 203452 | WebP |
| sayula | 9295 | 9295 | JPEG original |
| tapalpa | 101974 | 66822 | WebP |
| tlaquepaque | 111869 | 64876 | WebP |

Total de estas diez imágenes: 6,742,627 → 1,140,635 bytes (~83% menos). Esto mide archivos de imagen, NO el peso total de página ni una mejora de LCP. Sayula mantiene el original de 9,295 bytes; se descartó la conversión más pesada. El vídeo sigue midiendo 26,241,384 bytes; su optimización requeriría trabajo independiente, no se tocó.

## Navegador y rendimiento

Chrome headless local, HTML realmente renderizado por Laravel, datos comerciales vacíos equivalentes antes/después. Anchos 390 y 1440, alto 900. Baseline de portada renderizado desde HEAD; dos guías representativas Tequila y Ajijic; comprobación adicional de las imágenes de las diez guías. Las capturas se guardan localmente bajo `/private/tmp/visitajalisco-etapa1-*.png`; resultados durables en `etapa1-evidencias/navegador.json`.

Resultado del navegador: sin excepciones JavaScript, sin respuestas HTTP 4xx/5xx esenciales ni imágenes rotas verificadas; diez fondos del carrusel cargan y diez imágenes principales cargan. Sin desbordamiento horizontal a 390/1440. Menú/anclas/formulario presentes y controles del carrusel ejecutables. Revisión visual de portada, guía móvil y carrusel con fotos. Se preservan ambos vídeos. Se observaron cancelaciones del vídeo durante navegación de QA (también en baseline); no son una certificación de reproducción completa en todos los dispositivos.

Observaciones locales finales (ms de LCP, CLS acumulado observado; sin validez de benchmark):

| Página | 390 px LCP / CLS | 1440 px LCP / CLS |
| --- | --- | --- |
| Portada previa | 624 / 0 | 144 / 0 |
| Portada final | 208 / 0 | 132 / 0 |
| Tequila nueva | 92 / 0 | 84 / 0 |
| Ajijic nueva | 52 / 0 | 48 / 0 |

No existe Lighthouse instalado en el entorno y no se añadió una dependencia para esta tarea. No se ejecutó PageSpeed contra URLs aún no desplegadas. Observaciones PerformanceObserver locales se registran como smoke, no Lighthouse/CrUX: sin throttling controlado ni repeticiones, caché caliente entre cargas, ventana corta. No permiten afirmar mejora de rendimiento ni aprobación de Core Web Vitals. INP y datos de campo quedan pendientes. Las guías no tenían página previa contra la cual medir.

La primera tentativa de navegador precedió al servidor (falló la conexión); se repitió después de iniciarlo. Se corrigió únicamente la configuración del render de prueba para servir assets desde su puerto, sin modificar la configuración de la aplicación. Los SVG lazy aún no solicitados fuera del viewport no se reportan como imágenes rotas. No se afirmó que una captura inicial parcial fuera una prueba completa. Se corrigió también el parser de URLs de fondo del script de QA (escape de regex), sin cambios a la aplicación. Las cancelaciones ERR_ABORTED del vídeo al navegar entre documentos de prueba no se interpretan como 404 ni fallas nuevas del sitio.

## Pendientes del propietario / límites de aceptación

1. Desplegar código, configuración y nueve assets mediante su proceso existente; regenerar cachés habituales si aplica. Revalidar públicamente todas las rutas y cabeceras, sin alterar Analytics. No se accedió al hosting ni se modificó DNS.
2. Confirmar GA4 en su cuenta usando su procedimiento habitual. Verificar propiedad Search Console, enviar sitemap e inspeccionar once URLs siguiendo la guía. Indexación real: NO VERIFICADA.
3. Lighthouse/PageSpeed móvil/escritorio de producción y CWV/INP de campo pendientes. Smoke local no sustituye esas mediciones.
4. JSON-LD validado sintácticamente en las pruebas, tipos y datos coherentes con texto visible. Schema Markup Validator y Rich Results Test externos pendientes tras despliegue. No se promete resultado enriquecido para TouristDestination; sin FAQPage, ratings ni VacationRental.
5. Aprobar revisión editorial, titularidad/créditos de imágenes, operador y contacto real. La investigación respalda referencias turísticas, no horarios, disponibilidad o accesibilidad actual de cada recinto.
6. Revisión humana/jurídica del aviso, términos, cookies y eventual CMP según comportamiento real/mercados. No se modificaron textos legales ni consentimiento.
7. AdSense: cuenta, Publisher ID, ads.txt, autorización de implementación y solicitud de revisión pendientes. No hay anuncios nuevos ni aprobación garantizada.
8. Las pruebas de negocio/reserva son regresión con fixtures. No se hicieron reservas, envíos de WhatsApp ni pagos reales; no se certifica disponibilidad de terceros.

## Etapa 2 y reversibilidad

Fichas individuales de hospedajes/Airbnb, sus planes, precios, promociones, negocios y experiencia comercial de cada opción permanecen fuera de esta etapa. No se cambió su indexabilidad ni se agregaron/excluyeron mediante robots. No se incluyeron en el sitemap turístico por no haber sido auditadas.

Para revertir esta entrega, restaurar solo welcome.blade.php, routes/web.php y robots.txt desde la base indicada y retirar los archivos nuevos de esta etapa (revisando antes cambios posteriores). No usar reset global ni restaurar .env/base de datos. No se hicieron migraciones de producción ni redirecciones que deban deshacerse.

## Ajuste posterior — navegación de guías

Se corrigió el encabezado de las diez guías en `resources/views/destinations/show.blade.php`: logotipo, fondo gris y enlaces con el estilo de portada. Todos apuntan a las secciones existentes de inicio; Destinos aparece destacado. Breadcrumbs conservados dentro del contenido, separados del menú principal. En móvil el menú permite desplazamiento horizontal sin desbordar la página y sin JavaScript adicional. No se modificó la portada ni se añadió tracking o lógica comercial.

Validación del ajuste: 8 pruebas / 246 assertions pasan; vistas Blade compiladas. Dimensiones del logo verificadas contra el asset (2000 × 600). Las capturas y métricas anteriores corresponden a la versión previa del encabezado; no se presentan como evidencia visual de este ajuste.

## Ajuste posterior — tarjetas de destinos relacionados

La sección «Otros destinos para tu viaje» de las diez guías ahora muestra tarjetas con fotografías existentes, nombre, descripción editorial y llamada «Explorar destino». Cada tarjeta es un único enlace real; cuadrícula adaptable, imágenes lazy con espacio reservado, foco visible y animaciones sutiles que respetan prefers-reduced-motion. Se reutilizan variantes WebP con fallback original. No se añadieron dependencias, JavaScript, imágenes nuevas ni tracking. Las capturas iniciales de esta etapa no representan este ajuste visual.

Validación de tarjetas: 8 pruebas / 246 assertions pasan, Blade compila y diff sin errores de whitespace. Sin nueva revisión de navegador para este ajuste.

## Ajuste visual — referencia editorial de destinos

Se utiliza la referencia aportada por el propietario para la composición del contenido, sin copiar su identidad, navegación, footer, textos o fotografías. `resources/views/destinations/show.blade.php` ahora presenta una portada fotográfica a todo el ancho, degradado para contraste, H1 sobre la imagen, acceso al recorrido, introducción destacada, sección verde oscuro de lugares numerados y paneles claros para planificación y llegada. FAQ, fuentes y tarjetas relacionadas conservan su contenido y enlaces. Se mantienen exactamente el markup del nav y footer propios; no se añade código a portada, tracking o fichas comerciales. No se inventan atracciones, actividades ni fotografías para rellenar las guías.

Las diez páginas usan la misma plantilla. Imagen LCP sin lazy y con prioridad alta; tarjetas relacionadas mantienen lazy y reduced-motion. Se reutiliza la fotografía real disponible por destino; las imágenes de baja resolución preexistentes (especialmente Sayula) siguen siendo una limitación y no se suplantan con fotografías de otro lugar.

La prueba del texto de introducción cambia su selector al nombre de clase del bloque nuevo; el contenido exigido no cambia. Validación: 8 pruebas, 246 assertions, Blade compilado, diff sin errores de whitespace. Las evidencias anteriores de rendimiento no corresponden a esta composición.

Revisión visual posterior: Chrome a 390 y 1440 px en Ajijic y Chapala; un H1, portada y tarjetas con imágenes cargadas, nav/footer presentes, sin desbordamiento horizontal ni excepciones JavaScript. Capturas revisadas de Ajijic escritorio y Chapala móvil; archivos locales `/private/tmp/visitajalisco-design-*.png`. Resultados en `etapa1-evidencias/diseno-guias.json`. Servidor y Chrome de QA cerrados al terminar.
