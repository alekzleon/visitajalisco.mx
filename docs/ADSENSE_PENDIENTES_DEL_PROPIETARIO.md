# AdSense — pendientes del propietario

> Actualización posterior: el propietario autorizó activar el script. El estado vigente de carga y despliegue está en [ADSENSE_ACTIVACION.md](ADSENSE_ACTIVACION.md); las referencias a integración desactivada de este reporte corresponden a la preparación anterior. Los pendientes legales/CMP/cuenta siguen vigentes.

Estado: **NO LISTO PARA SOLICITAR REVISIÓN**. Preparación del código realizada; faltan comprobaciones de operación, derechos y privacidad. Fecha de esta entrega: 2026-11-01. Ninguna calificación numérica ni garantía de aprobación.

## Información ya recibida

- Operador: **alejandro leo**, escrito como fue proporcionado. Confirmar forma legal completa si fuera distinta antes de una validación definitiva.
- Correo de soporte y privacidad: **info@visitajalisco.mx**, confirmado por el propietario en respuesta a la consulta. El sitio muestra mailto; no se enviaron correos de prueba ni se certificó entrega SMTP.
- Editor aportado por fragmento del propietario: **pub-9068723123011153** / **ca-pub-9068723123011153**. Se utiliza en `public/ads.txt`; la verificación alternativa por metadata está desactivada. No se cargó el script aportado ni se autorizaron anuncios.
- Dirección: el propietario pidió expresamente dejarla fuera. No se publica, no se inventa y no se atribuye una dirección de Cloudi.

## Bloqueantes antes de recomendar una solicitud

| Punto | Acción precisa | Evidencia necesaria para cerrar |
| --- | --- | --- |
| Despliegue | Publicar la entrega junto con etapa turística previa usando el proceso habitual del hosting; no copiar .env local | HTTP público 200 en cinco páginas de información, diez destinos, ads.txt y sitemap; body y Content-Type reales |
| Aviso/operador | Revisar con quien asesore al operador la forma legal del nombre y la omisión de domicilio solicitada | Decisión jurídica sobre el artículo 15 de LFPDPPP, que exige identidad y domicilio; no se considera cumplido por ocultar el campo |
| Textos legales | Revisar aviso/términos completos, finalidades, encargados/transferencias, retención, procedimiento ARCO y obligaciones reales | Versión aprobada por responsable y revisor; registrar fecha, actualizar texto y luego legal_reviewed solo si corresponde |
| Proveedores y conservación | Informar quién aloja/almacena, correo utilizado, CDN si existe, países de tratamiento, logs y política de conservación/borrado | Inventario contractual real y configuraciones de eventos, logs, correo y GA4; no se inventaron plazos |
| Consentimiento | Decidir mercados atendidos y configurar CMP que corresponda; revisar conflicto con la medición actual | Mensaje real, decisiones aceptar/rechazar/preferencias probadas donde proceda. Si afecta GA4, aprobar una tarea específica; esta no lo modifica |
| Derechos de fotografías | Confirmar autoría/licencias y créditos de los activos turísticos y comerciales | Registro de autorizaciones y atribuciones aplicables; reemplazo autorizado si falta permiso |
| Cuenta AdSense | Confirmar titularidad/permiso sobre el ID entregado, situación de cuenta y sitio, elegibilidad y políticas | Estados reales del panel; entregar observaciones de Google si las hay |
| Acceso administrativo | Revisar credenciales actuales y rotar las que lo requieran; revisar tokens | Confirmación del propietario. Se retiró la ayuda visible del login, no se modificó la base ni se ejecutó el seeder existente |

## Configuración y decisiones externas pendientes

1. Confirmar recepción de correo y que el responsable atiende soporte y ARCO. Si se desea, realizar una prueba propia fuera de esta sesión; no se envían mensajes a terceros automáticamente.
2. Confirmar proveedor de hosting/docroot. Laravel debe servir `public/` para que ads.txt y robots.txt estén en raíz; en instalaciones con copia a public_html, sincronizar esos archivos al root real manteniendo privados app/.env/vendor/storage. No se certifica la topología sin acceso.
3. Revalidar www: ahora HTTPS-www público responde 200 con canonical no-www. Evaluar redirección en hosting preservando POST/autenticación; no se añadió una regla global que afectara módulos excluidos.
4. Revisar informes Lighthouse/PageSpeed de producción y Core Web Vitals/INP de campo. El vídeo compartido sigue siendo pesado y no fue cambiado. No se usa un score inventado ni un mínimo de palabras/artículos como criterio de aprobación.
5. Verificar que GA4 continúa recibiendo datos en su cuenta mediante su flujo normal. Se probó integridad de código, no acceso al panel ni emisiones artificiales.
6. Search Console: recomendable para rastreo e indexación, no garantía de AdSense. Verificar propiedad real y enviar sitemap después del despliegue si se desea, siguiendo la guía de etapa 1.
7. Cuando todo lo anterior esté resuelto, decidir explícitamente solicitud y posterior activación de anuncios. Anuncios automáticos, ubicaciones, consentimiento y cambios de medición no se activan por esta entrega.

## Campos técnicos preparados

`config/site_operator.php` conserva nombre/correo confirmados, domicilio null por instrucción y legal_reviewed=false. Los flags de confirmación se basan en la respuesta del propietario; no son una certificación legal. `SitePublication::canPublishLegalInformation()` solo controla que no se rendericen campos vacíos, no valida cumplimiento normativo. Con datos insuficientes la ruta afectada responde 503 noindex sin publicar la plantilla vacía. En la configuración actual las cinco páginas responden 200.

`config/adsense.php` mantiene verificación alternativa desactivada. Si cambia el editor real, actualizar de manera coherente `public/ads.txt` y esa configuración, preservando otras entradas legítimas de ads.txt. No confundir el editor con el ID de GA4. No es necesario instalar un segundo tag de Analytics.
