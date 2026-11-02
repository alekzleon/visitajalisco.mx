# AdSense — checklist previo a revisión

> Actualización posterior: el propietario autorizó activar el script. El estado vigente de carga y despliegue está en [ADSENSE_ACTIVACION.md](ADSENSE_ACTIVACION.md); las referencias a integración desactivada de este reporte corresponden a la preparación anterior. Los pendientes legales/CMP/cuenta siguen vigentes.

Resultado global: **NO LISTO PARA SOLICITAR REVISIÓN**. No implica rechazo de Google: identifica pendientes concretos antes de recomendar el envío. Fecha: 2026-11-01.

LISTO significa exclusivamente que la comprobación indicada pasó en su entorno; no certifica producción ni aprobación.

| Área | Estado | Evidencia / límite |
| --- | --- | --- |
| GA4 y eventos propios | LISTO en código | Snippets, asignaciones y orden de scripts idénticos a respaldo; configuración/modelo/controller y rutas comerciales intactos. Recepción en cuenta: pendiente del propietario |
| Airbnb y comercio | LISTO en regresión local | Búsqueda, ficha sintética, redirects de reserva/WhatsApp/indicaciones/anuncios y control de acceso pasan. Única edición de ficha: añadir enlaces de footer, sin cambiar cuerpo, lógica ni GA4 |
| Legales separados | LISTO técnico local | /aviso-de-privacidad, /politica-de-cookies, /terminos-y-condiciones con 200, title/canonical/cuerpo propios; cinco enlaces de información en footers. Producción aún refleja versión anterior |
| Suficiencia jurídica | BLOQUEADO | Nombre/correo aportados; domicilio omitido por pedido expreso, proveedores/retención pendientes y sin revisión jurídica. Privacidad/términos noindex y fuera de sitemap; no se afirma cumplimiento |
| Contacto | LISTO técnico / PENDIENTE operativo | /contacto 200 con mailto al correo aportado, sin formulario simulado. Entrega de correo y atención ARCO no comprobadas por envío |
| Sobre el proyecto | LISTO local | /sobre-nosotros independiente, misión/alcance y criterios verificables; sin atribuir condición gubernamental ni responsabilidad a Cloudi |
| Ads.txt | LISTO local / PENDIENTE público | Línea real del editor suministrado, 200 text/plain en servidor PHP de QA. Producción antes: 404; estado Autorizado solo se verifica en AdSense |
| Verificación / anuncios | LISTO como preparación desactivada | Meta alternativa disponible, apagada por defecto; no adsbygoogle.js ni bloques. No se insertó el script enviado por el propietario |
| Estado de cuenta AdSense | PENDIENTE | ID recibido no demuestra sitio aprobado, titularidad en panel ni elegibilidad de cuenta |
| CMP/consentimiento | BLOQUEADO para cierre integral | Banner informativo, no control previo de GA4. Sin CMP/Consent Mode probado. Requiere decisión y configuración por territorios sin alterar GA4 en esta tarea |
| «Configurar privacidad» | NO APLICA como enlace implementado | No existe panel funcional; no se inventó control ni se simulan preferencias |
| Destinos y originalidad | LISTO editorial local / PENDIENTE evaluación integral | Diez guías previas diferenciadas con fuentes y HTML visible; no se crearon páginas masivas ni un mínimo artificial de contenido. Revisión de calidad editorial y disponibilidad actual de recintos continúa siendo humana |
| Imágenes/licencias | BLOQUEADO para cierre integral | Activos previos conservados; no se acreditaron derechos ni se inventaron créditos |
| Publicidad comercial | LISTO transparencia local | Encabezados distinguen anuncios/servicios activos; escenarios de ejemplo aclaran disponibilidad pendiente. No cambia selección, precios ni tracking |
| Rastreo/404 | LISTO local / PENDIENTE despliegue | robots no bloqueante, sitemap XML válido (14 URLs con configuración actual), ruta inventada 404; nuevas páginas públicas faltan en producción |
| Host/HTTPS | PENDIENTE parcial | HTTP→HTTPS público 301 confirmado; www todavía 200 con canonical no-www. No se modifican reglas globales sin evaluar infraestructura/POST |
| Seguridad visible | LISTO corrección puntual / PENDIENTE operación | Credenciales de ayuda eliminadas del login y rel=noopener añadido en Facebook. Rotación de cuentas/tokens y seeder peligroso deben revisarse por propietario; no se tocó autenticación ni DB |
| Móvil, escritorio y teclado | LISTO en smoke local | Revisión Chrome 390/1440; enlaces, imágenes visibles y foco. No equivale a auditoría WCAG ni prueba completa de lector de pantalla |
| Rendimiento | PENDIENTE producción | Build y recursos compilados; sin Lighthouse/PageSpeed instalado de producción ni INP de campo. No se deducen mejoras de métricas por existir cambios de código |
| Producción/release | BLOQUEADO hasta revalidar | No se desplegó. Debe publicar docroot correcto, cachés habituales y confirmar HTTP/legales/ads.txt/recursos antes de revisión |

## Criterios oficiales frente a recomendaciones

- Google evalúa contenido propio y experiencia, políticas y acceso/permiso del editor; no se promete aprobación por un número de páginas. [Requisitos oficiales](https://support.google.com/adsense/answer/9724?hl=es), [sitio no listo](https://support.google.com/adsense/answer/12176698?hl=es).
- ads.txt es recomendado por Google, no una condición universal autónoma de ingreso; su contenido y estado deben ser reales. [Guía oficial ads.txt](https://support.google.com/adsense/answer/12171612?hl=es).
- La privacidad publicitaria debe describir cookies/terceros y opciones reales de personalización cuando se active. [Contenido requerido](https://support.google.com/adsense/answer/1348695?hl=es).
- Para anuncios personalizados en EEE/Reino Unido/Suiza se exige CMP certificada integrada con TCF según la política de Google. No se deduce consentimiento válido de un banner. [Requisitos CMP](https://support.google.com/adsense/answer/13554116?hl=es).
- La revisión de domicilio e información del responsable se basa en la ley mexicana aplicable; el propietario pidió no publicar dirección, y esto no elimina la necesidad de revisión. [LFPDPPP vigente consultada](https://www.diputados.gob.mx/LeyesBiblio/pdf/LFPDPPP.pdf).
