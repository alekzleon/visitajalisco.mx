# AdSense — guía del propietario

> Actualización posterior: el propietario autorizó activar el script. El estado vigente de carga y despliegue está en [ADSENSE_ACTIVACION.md](ADSENSE_ACTIVACION.md); las referencias a integración desactivada de este reporte corresponden a la preparación anterior. Los pendientes legales/CMP/cuenta siguen vigentes.

Preparación 2026-11-01. No se realizó acceso a la cuenta, solicitud ni despliegue; las etiquetas del panel pueden variar. No activar anuncios antes de cerrar los pendientes y decidirlo expresamente.

## 1. Cerrar datos y revisión

Revisar `ADSENSE_PENDIENTES_DEL_PROPIETARIO.md`. Confirmar operador/correo como fueron aportados, resolver con revisión jurídica la omisión de domicilio, proveedores, transferencias, retención y el aviso. No pasar legal_reviewed a true por tener una página o un diseño. El texto actual no certifica suficiencia normativa; la fecha es versión del contenido, no una fecha de despliegue acreditada.

Confirmar derechos de imágenes, seguridad de accesos actuales y mercados de visitantes. Si una CMP necesitara controlar la medición actual, aprobar antes una tarea específica: esta entrega mantiene GA4 idéntico.

## 2. Publicar y comprobar archivos

Usar su procedimiento habitual para desplegar el código actual y la etapa turística previa aún no publicada. No copiar .env local, contraseñas ni fixtures. Servir Laravel desde `public/` o asegurar que la raíz pública real recibe sus assets; no exponer archivos internos al navegador. Regenerar cachés de Laravel por su proceso habitual cuando aplique; no cambiar ID, scripts o forma de carga de Analytics.

Comprobar con navegador o curl:

- `/`, las diez `/destinos/{slug}` y las cinco páginas de información: 200, títulos propios y enlaces correctos.
- `/ads.txt`: 200, Content-Type text/plain, sin HTML. Archivo del proyecto: `public/ads.txt`. Debe contener la línea suministrada a partir de la cuenta del propietario:

```text
google.com, pub-9068723123011153, DIRECT, f08c47fec0942fa0
```

- `/robots.txt`: permite páginas/recursos y referencia `https://visitajalisco.mx/sitemap.xml`.
- `/sitemap.xml`: 200 application/xml, 14 URLs con configuración actual: portada, diez destinos, cookies, sobre-nosotros y contacto. Privacidad/términos quedan fuera y noindex hasta revisión real. No contiene estancias ni páginas privadas.
- Una URL inexistente: 404 real. Revisar www y HTTP sin romper métodos POST o autenticación; HTTPS-www actualmente no redirige al host canónico.

Si otra red incorpora entradas legítimas a ads.txt en el futuro, conservarlas. Si cambia el editor, tomar el valor de la cuenta, no generar IDs de ejemplo. Evitar confundir pub-/ca-pub- con G-/GTM-/AW-.

## 3. Añadir/verificar el sitio en la cuenta

1. Entrar personalmente en AdSense con la cuenta propietaria y revisar primero si `visitajalisco.mx` ya existe en **Sitios / Sitios web**. No crear entradas duplicadas.
2. Si falta, seleccionar **Nuevo sitio**, introducir el dominio correcto y guardar. Confirmar que el editor del panel coincide con el proporcionado (`pub-9068723123011153`). El ID aportado no confirma por sí solo el estado de aprobación.
3. Elegir un único método de verificación ofrecido. El archivo ads.txt ya está preparado y puede usarse si la interfaz lo ofrece; comprobar primero la URL pública.
4. Como alternativa al script de anuncios, se preparó metadata: `config/adsense.php`, componente `partials/adsense-verification` en head de portada y guías. Está **apagada por defecto**. Solo si el propietario elige este método, habilitar `ADSENSE_VERIFICATION_ENABLED=true` en el entorno de despliegue, confirmar la configuración de editor y regenerar caché habitual. Debe aparecer exactamente una meta google-adsense-account con el ca-pub correspondiente, sin cargar adsbygoogle.js. No habilitar métodos adicionales por rutina.
5. El script enviado por el propietario se usó como fuente del ID; **no se insertó**. Su carga y anuncios automáticos son una decisión posterior, no una consecuencia de verificar metadata o publicar ads.txt.
6. En AdSense, completar la confirmación y **Verificar** conforme al método seleccionado. Documentar el resultado real, sin inferirlo del archivo local.

[Pasos oficiales para añadir y verificar sitio](https://support.google.com/adsense/answer/12169212?hl=es).

## 4. Comprobar ads.txt en Google

En **Sitios**, abrir el dominio, revisar el **Estado de ads.txt** y usar **Buscar actualizaciones** si está disponible. Si dice No encontrado/No autorizado, comparar exactamente el archivo público y el fragmento de la cuenta; revisar hosting, caché, redirects y acceso del rastreador. No afirmar Autorizado hasta que el panel lo indique. La actualización puede tardar y no depende del código local.

[Guía oficial](https://support.google.com/adsense/answer/12171612?hl=es).

## 5. Privacidad y mensajes / CMP

Abrir **Privacidad y mensajes** y revisar la configuración para los visitantes reales. Si corresponde publicidad personalizada en EEE, Reino Unido o Suiza, seleccionar una CMP certificada integrada con IAB TCF; puede evaluarse la CMP de Google o una certificada compatible. No publicar dos banners de consentimiento que compitan.

Configurar proveedores efectivamente utilizados, idiomas, territorios y decisiones aplicables (aceptar/rechazar/gestionar) sin preselecciones engañosas. Revisar textos y links de privacidad/cookies, publicar únicamente después de validar la integración y comprobar con navegador las decisiones iniciales y el cambio posterior. Añadir «Configurar privacidad» solo cuando exista un panel real que se abra y permita cambiar la decisión.

El banner actual de portada es informativo. Entendido recuerda el cierre; Cerrar lo oculta temporalmente. No configura categorías, no bloquea GA4 y no es Consent Mode ni CMP certificada. Resolver cualquier conflicto normativo sin reescribir GA4 por iniciativa de esta entrega. Los anuncios permanecen sin script, así que no hay una carga publicitaria nueva que condicionar.

[Gestión de CMP](https://support.google.com/adsense/answer/7670013?hl=es), [exigencia de certificación/TCF](https://support.google.com/adsense/answer/13554116?hl=es).

## 6. Solicitar revisión solo después de cerrar los bloqueantes

Revisar la matriz `ADSENSE_CHECKLIST_PRE_REVISION.md`, comprobar producción real, privacidad/consentimiento, derechos, originalidad y funcionamiento. Con decisión expresa del propietario, usar **Solicitar revisión** en Sitios. Guardar fecha y respuesta de Google. Si hay incidencias, resolver el motivo específico antes de volver a enviar; no generar tráfico artificial ni hacer clic en anuncios.

Search Console ayuda a conocer indexación, pero no sustituye la revisión de AdSense ni constituye una condición autónoma de aprobación. GA4 no debe reinstalarse o migrarse para verificar ninguno de estos productos.
