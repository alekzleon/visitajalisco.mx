# AdSense — cambios realizados y validación

> Actualización posterior: el propietario autorizó activar el script. El estado vigente de carga y despliegue está en [ADSENSE_ACTIVACION.md](ADSENSE_ACTIVACION.md); las referencias a integración desactivada de este reporte corresponden a la preparación anterior. Los pendientes legales/CMP/cuenta siguen vigentes.

Fecha de versión: 2026-11-01. **Código preparado para completar la operación, NO LISTO PARA SOLICITAR REVISIÓN todavía.** No se ha desplegado, accedido a la cuenta Google ni enviado una solicitud. Google conserva la decisión de aprobación.

## Alcance real y estado previo

Se conservaron los cambios previos de turismo y diseño sin commit. Esta entrega se compara con el snapshot de trabajo, no solo con HEAD: `/private/tmp/visitajalisco-adsense-baseline/source.tar` (100 archivos fuente/documentación relevantes), hashes, listado de rutas y git status. No se guardó .env ni se sobrescribieron cambios anteriores. No se creó rama/commit sobre ese trabajo; el respaldo recuperable permite restauración puntual.

La versión pública consultada todavía no tiene guías ni sitemap de la etapa anterior: nuevas rutas de destinos y páginas cookies/términos/contacto/sobre-nosotros devuelven 404. Portada y aviso previo responden 200. No presentar pruebas locales como despliegue.

## Datos aportados y decisión editorial

El propietario confirmó operador «alejandro leo» y correo info@visitajalisco.mx, pidió no publicar dirección y entregó el script de su editor AdSense. Se usa el ID real de ese fragmento; no se introduce el script ni se activan anuncios.

La instrucción posterior de dejar fuera la dirección prevalece sobre el requisito inicial de no publicar avisos si faltaba domicilio. Se ofrece información veraz con los datos aportados y sin placeholders, pero **no se certifica que constituya un aviso jurídicamente suficiente**. La omisión, identificación completa del operador, proveedores y retención deben resolverse en revisión legal. Privacidad/términos permanecen noindex y excluidos del sitemap por esa revisión pendiente. El helper controla campos disponibles, no cumplimiento legal.

## Archivos de aplicación de esta entrega

| Archivo | Cambio |
| --- | --- |
| app/Http/Controllers/InformationController.php | Nuevo: sirve cinco páginas concretas con metadata propia y respuestas 200; si faltan datos confirmados, legal/contacto responde 503 noindex sin renderizar un documento vacío |
| app/Support/SitePublication.php | Nuevo: disponibilidad de información, URLs indexables y validación del ID para metadata opcional; sin relación con Analytics ni lógica comercial |
| config/site_operator.php | Nuevo: nombre/correo aportados, domicilio null por instrucción, fecha de versión y legal_reviewed=false |
| config/adsense.php | Nuevo: editor aportado y verificación metadata desactivada por defecto; sin switch para activar anuncios |
| resources/views/privacy.blade.php | Sustituye aviso genérico por texto operativo con responsable/correo confirmados, datos reales, finalidades, medición, limitaciones, derechos ARCO, publicidad futura condicionada y revisión pendiente |
| resources/views/information/layout.blade.php | Nuevo layout de información con H1, fecha de versión, canonical, description, robots y enlaces cruzados |
| resources/views/information/cookies.blade.php | Nueva política técnica: cookies observadas frente a posibles, localStorage real, funcionamiento del aviso y límites; no inventa duración/cookies publicitarias |
| resources/views/information/terms.blade.php | Nuevas condiciones independientes: alcance editorial/comercial, terceros, contratación externa, propiedad intelectual y responsabilidades proporcionadas |
| resources/views/information/about.blade.php | Nueva descripción del proyecto, diez destinos, criterios y correcciones, sin fingir carácter gubernamental |
| resources/views/information/contact.blade.php | Nuevo contacto mailto real aportado; sin formulario, envío simulado ni nombres inventados |
| resources/views/partials/policy-links.blade.php | Nuevo bloque de cinco enlaces: privacidad, cookies, términos, sobre nosotros y contacto |
| resources/views/partials/adsense-verification.blade.php | Nuevo método alternativo por meta google-adsense-account; no emite nada por defecto ni carga script |
| resources/views/welcome.blade.php | Sustituye enlaces legales, añade include de metadata apagada después del title, añade noopener al enlace Facebook, distingue anuncios/servicios comerciales y aclara escenarios de ejemplo; corrige texto/etiquetas del banner informativo sin tocar su JS ni GA4 |
| resources/views/destinations/show.blade.php | Solo enlaces del footer e include de metadata apagada; diseño, contenido, fotos y nav de guías conservados |
| resources/views/destinations/sitemap.blade.php | Añade cookies/sobre-nosotros/contacto publicados y disponibles; privacidad/términos se omiten hasta revisión legal; 14 URLs actuales |
| resources/views/stays/show.blade.php | Únicamente añade bloque de enlaces de footer autorizado; cuerpo/ficha, snippet GA4 y lógica idénticos |
| resources/views/layouts/dashboard.blade.php | Únicamente enlaces de footer en layout compartido, sin tocar paneles ni formularios |
| resources/views/auth/login.blade.php | Añade footer y elimina ayuda con credenciales iniciales/correo prellenado; no cambia acción, campos, validación, controlador ni cuentas |
| routes/web.php | Cambia la ruta del aviso a la vista preparada y añade cuatro rutas de información; rutas de GA/eventos/código de estancia/comercio permanecen idénticas |
| public/ads.txt | Nuevo archivo con la línea del editor real proporcionado, sin entradas previas que reemplazar |
| tests/Feature/AdSensePreparationTest.php | Cinco nuevas pruebas con DB en memoria; información, datos incompletos, noindex/sitemap, ads.txt/metadata apagada y enlaces seguros |
| tests/Feature/TourismSeoTest.php | Ajusta expectativa del sitemap de 11 a 14; preserva pruebas de destinos y regresión comercial |

`public/robots.txt`, config/destinations.php, assets turísticos y diseño previo no se modificaron en esta entrega respecto del snapshot. El diff global de Git todavía los muestra por la etapa anterior. No se crearon tablas, migraciones, módulos de negocio ni dependencias permanentes. Los documentos imprimibles QR y APIs quedan fuera del footer público: no se alteró su formato ni contrato.

## Reportes nuevos

- ADSENSE_AUDITORIA_INICIAL.md: hallazgos, fuente de evidencia y prioridad.
- ADSENSE_CAMBIOS_REALIZADOS.md: este reporte.
- ADSENSE_PENDIENTES_DEL_PROPIETARIO.md: acciones operativas y datos/decisiones pendientes.
- ADSENSE_CHECKLIST_PRE_REVISION.md: estados objetivos, diferenciando local y producción.
- ADSENSE_GUIA_PROPIETARIO.md: pasos de cuenta, ads.txt, CMP, verificación y solicitud.
- adsense-evidencias/: integridad, HTTP público previo, HTTP/navegador local, build y escaneo. No incluye IDs de Analytics, cookies con valores, tokens, .env ni credenciales.

## Antes/después y pruebas

| Comprobación | Antes | Después local |
| --- | --- | --- |
| Suite | 8 pruebas / 246 assertions | **13 pruebas / 396 assertions**, sin fallos |
| Portada | 200, mismo formulario/carruseles/GA | 200, conserva esas funciones; footer y transparencia corregidos |
| Diez guías | Existen localmente, no desplegadas en consulta pública | 200 con contenido propio/metadatos/JSON-LD, sin duplicación de páginas |
| Aviso | 200 público, contacto propuesto no confirmado y secciones mezcladas | 200 local con información aportada y noindex por revisión pendiente |
| Cookies/términos | Anclas del mismo aviso; nuevas rutas públicas 404 | Documentos distintos, 200; Cookies indexable, Términos noindex hasta revisión |
| Contacto/sobre nosotros | Sin rutas propias | Ambas 200 con contenido distinto y cinco links cruzados |
| ads.txt | 404 público, sin archivo | 200 text/plain en servidor PHP de QA; línea exacta, 59 bytes; estado Google no comprobado |
| robots | 200 público sin Sitemap; archivo local ya corregido etapa previa | 200 text/plain, misma política no bloqueante y referencia al sitemap local |
| sitemap | 404 público; 11 URLs locales | 200 application/xml; XML válido con 14 URLs únicas y sin privadas/estancias/legales pendientes |
| URL desconocida | 404 público | 404 real local |
| HTTPS | HTTP→HTTPS 301 público | No se alteraron reglas; www pendiente de evaluación (200 con canonical no-www) |

Comandos ejecutados: `php artisan test`, `php artisan view:cache`, `php -l` sobre controller/helper/config/rutas, `git diff --check`. Build real: `npm run build -- --outDir /private/tmp/visitajalisco-adsense-vite-output`, Vite 6.4.5, 61 módulos, salida CSS/JS/manifest válida. Se descargaron solo las dependencias ya declaradas en una carpeta temporal (140 paquetes, scripts de instalación deshabilitados); symlink node_modules temporal retirado al terminar. package.json/package-lock y dependencias del repositorio no se cambiaron. Aviso Vite sobre outDir externo es intencional para no escribir el build sobre producción.

Nuevas pruebas de información/comercio usan SQLite en memoria y fixtures; no modifican la base comercial ni llaman a WhatsApp/plataformas externas. El test ExampleTest existente conserva su comportamiento previo. No se ejecutó ningún seeder, envío real, reserva, pago o rotación de usuarios.

## GA4 y flujo comercial conservados

Evidencia: `adsense-evidencias/integridad.json` compara contra el snapshot previo a esta entrega:

- Bloques GA4 de portada y estancia idénticos byte a byte; asignaciones de ID y lista/orden de scripts idénticos.
- JS completo de portada idéntico, incluidos localStorage y carruseles. Solo cambia la redacción del aviso y nombres visibles de botones: «Entendido» guarda la misma clave; «Cerrar» oculta temporalmente.
- Registro home_visit y todo el tramo de rutas track/autenticación/Airbnb son idénticos.
- config/services.php, AnalyticsEvent, TrackingController, controladores/modelos preexistentes y APIs sin modificación.
- En ficha de estancia, quitar la única línea nueva de footer produce exactamente el archivo anterior.
- No segundo GA4/GTM, nuevos eventos, Consent Mode ni cambios de carga. No se incorporó GA4 a páginas que no lo tenían.

La llegada efectiva de visitas/eventos al panel no puede verificarse sin cuenta: pendiente del propietario. El navegador de QA bloquea hosts externos y no se genera tráfico de medición artificial.

## Navegador, accesibilidad y límites

Chrome headless con servidor PHP real y SQLite en memoria, anchos 390/1440, alto 900: cinco páginas de información, portada, guía Ajijic y login. Footer accesible en los 16 escenarios, sin overflow horizontal, imágenes visibles cargadas, sin scripts de anuncios ni excepciones JS. Tabulador alcanza un enlace o campo; no equivale a una auditoría completa con lector de pantalla. Tabla de cookies con scroll interno y región accesible. Mailto apunta al correo aportado; no se pulsó para enviar un mensaje.

Se comprobó cierre/recuerdo del banner con su JS real y localStorage. No se presenta esta prueba como consentimiento de categorías ni como cumplimiento regional. La primera pasada capturó un documento en transición; se ajustó el script de QA para esperar footer/documento completo y se repitió. Capturas locales `/private/tmp/visitajalisco-adsense-*.png`; se inspeccionaron cookies móvil, login y footer de portada escritorio. Servidor y Chrome de QA se cerraron al finalizar.

Lighthouse/PageSpeed de producción e INP/CWV de campo no disponibles en esta sesión. No se inventan resultados ni se reutilizan métricas de etapa 1 para afirmar rendimiento del nuevo conjunto. El vídeo y los pesos de imágenes previos se conservaron.

## Escaneo y riesgos residuales

No hay placeholders legales, editor ficticio ni credenciales de ayuda visibles en fuentes servidas. El ID AdSense aportado es un identificador público, no una contraseña. Persisten fallbacks de localhost en config de desarrollo preexistente; no son enlaces publicados nuevos. Persiste el fallback G-XXXXXXXXXX heredado en config/services.php porque la integración GA4 está explícitamente excluida; la configuración efectiva local tiene un valor real sin imprimirlo. Propietario debe preservar el valor real en su despliegue habitual. No se intentó resolverlo modificando Analytics.

El seeder heredado puede reestablecer credenciales iniciales; no se ejecutó ni cambió. Revisar cuentas/tokens reales con propietario. El fallback de hospedajes vacío contiene «Próximamente/En preparación», fuera del alcance de lógica Airbnb; no apareció en el HTML público consultado y no se modificó para maquillar disponibilidad. Los servicios de ejemplo de portada sí se distinguen como ideas/disponibilidad por confirmar sin alterar su lógica.

## Qué falta y reversión

Consultar los otros cuatro reportes. Bloqueantes: producción, revisión jurídica (incluida omisión de dirección solicitada), proveedores/retención, consentimiento/CMP según territorios, derechos de fotos y estado real de cuenta. No se recomienda solicitar aún. Contacto/operador/ID ya aportados no deben volver a pedirse salvo corrección.

Revertir solo archivos de esta entrega desde el snapshot, preservando etapa turística/diseño previos y cualquier trabajo posterior. Restaurar las vistas/rutas puntualmente y retirar archivos nuevos si corresponde. No usar git reset global, restaurar .env/base de datos ni eliminar los cambios anteriores. No hay migraciones de producción que deshacer.
