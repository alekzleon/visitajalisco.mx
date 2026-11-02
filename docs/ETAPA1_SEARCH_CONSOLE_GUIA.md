# Etapa 1 — Conectar Search Console

Preparado en código, NO conectado ni verificado en una cuenta Google. Consulta: 2026-11-01. No se encontró meta google-site-verification ni archivo de verificación rastreado en el código inspeccionado. Esto no descarta una verificación DNS o realizada fuera del repositorio. No se eliminó mecanismo alguno.

1. Desplegar los cambios con el procedimiento habitual del propietario. No se ha desplegado desde esta sesión. Publicar también las variantes de imágenes. Si el servidor cachea rutas/configuración/vistas, regenerar las cachés mediante el proceso habitual de Laravel, sin modificar .env ni configuración de Analytics.
2. Comprobar públicamente https://visitajalisco.mx/robots.txt y https://visitajalisco.mx/sitemap.xml: 200, XML válido con once URLs, ninguna en redirect/404/noindex; verificar las diez guías. El sitemap se genera desde `config/destinations.php`, sin mantener una segunda lista manual.
3. Abrir https://search.google.com/search-console/ con la cuenta propietaria. Revisar primero si la propiedad ya existe.
4. Si falta, preferir la propiedad de dominio `visitajalisco.mx`: copiar exactamente el TXT ofrecido por Google al proveedor DNS, conservar los registros previos y verificar tras propagación. Esta tarea no incorpora tokens inventados ni modifica DNS.
5. Si solo se dispone de acceso al sitio, usar propiedad de prefijo `https://visitajalisco.mx/` y el método aprobado por el propietario. Si Google permite aprovechar Analytics, hacerlo únicamente en su interfaz; no cambiar tags, IDs, configuración ni duplicar medición. No se ha añadido un placeholder de verificación al código.
6. En Sitemaps, enviar `https://visitajalisco.mx/sitemap.xml` solo tras validar el despliegue. Confirmar que Google informa lectura correcta.
7. Usar Inspección de URLs para portada y las diez guías; revisar canonical elegido, acceso e indexabilidad con prueba en vivo. Solicitar indexación de forma razonable, sin automatización masiva. El envío no garantiza indexación.
8. En Rendimiento > Resultados de búsqueda filtrar por URL/destino; revisar impresiones, clics, CTR, posición media y consultas. Comparar períodos cuando exista suficiente información.
9. Revisar Indexación > Páginas, Sitemaps, Core Web Vitals, acciones manuales y problemas de seguridad. INP/CWV necesitan datos de campo, no se deducen de pruebas locales.

## Lista para inspección

Usar la tabla completa de `ETAPA1_INVENTARIO_URLS.md`: portada y diez destinos. Para cada una el estado esperado es 200, canonical propio e indexable; estado local confirmado 200. Estado de Google en las once: **NO VERIFICADO**. Registrar aquí o en la bitácora de operación la fecha real de envío, lectura e indexación sin sustituir estos estados por suposiciones.

No asociar productos ni crear propiedades Analytics desde código. El propietario debe confirmar que la medición previa continúa llegando a su cuenta. Las nuevas guías no incorporan medición nueva en esta etapa para respetar la exclusión de Analytics.

Referencias oficiales consultadas: [Search Console](https://search.google.com/search-console/), [sitemaps](https://developers.google.com/search/docs/crawling-indexing/sitemaps/build-sitemap). Las etiquetas de la interfaz pueden variar.
