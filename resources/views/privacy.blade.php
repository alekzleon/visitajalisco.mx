@extends('information.layout')
@section('information')
    <h2>Responsable y contacto</h2>
    <p>{{ config('site_operator.name') }} es responsable del tratamiento de datos personales en Visita Jalisco. Para asuntos de privacidad, derechos ARCO o revocación del consentimiento, escribe a <a href="mailto:{{ config('site_operator.privacy_email') }}">{{ config('site_operator.privacy_email') }}</a>.</p>
    @if (config('site_operator.address'))<p>Domicilio: {{ config('site_operator.address') }}.</p>@endif
    <p>Visita Jalisco es una plataforma comercial independiente que publica información turística de Jalisco y referencias a hospedajes, negocios y servicios. No representa a una autoridad de turismo ni a una institución de gobierno.</p>
    <h2>Datos que se tratan</h2>
    <ul>
        <li>Cuando consultas un código de hospedaje, se recibe el código ingresado y se registra el resultado de la consulta.</li>
        <li>Al navegar por las páginas que tienen medición o usar enlaces de seguimiento, se pueden registrar URL, referencia de origen, fecha y hora, tipo de evento, navegador, identificadores del contenido y metadatos de la interacción. El registro propio transforma la IP mediante una función hash con clave de aplicación; esto no se presenta como anonimización garantizada.</li>
        <li>Las cuentas de acceso utilizan correo, contraseña y datos de sesión. Los paneles autorizados administran nombres y datos de contacto, imágenes y enlaces de negocios u hospedajes que sus responsables facilitan para publicación.</li>
        <li>Si escribes al correo de contacto, se tratarán tu dirección y el contenido que envíes para atender el mensaje. Evita enviar datos sensibles o documentación innecesaria por correo.</li>
    </ul>
    <p>La consulta turística pública no requiere crear una cuenta. No existen campos públicos destinados a solicitar datos sensibles en los formularios inspeccionados.</p>
    <h2>Finalidades del tratamiento</h2>
    <p>Las finalidades de servicio son atender consultas, permitir el acceso autorizado, mostrar la información correspondiente al código de hospedaje, administrar el contenido facilitado por sus titulares y responder solicitudes de contacto o privacidad.</p>
    <p>La medición de visitas y de interacciones permite conocer el uso del portal y de sus referencias comerciales. Esta finalidad de análisis se distingue de la consulta turística y del inicio de sesión. Puedes solicitar limitación u oposición mediante el correo de privacidad; su alcance se evaluará conforme a la normativa aplicable.</p>
    <h2 id="cookies">Google Analytics y cookies</h2>
    <p>El sitio utiliza Google Analytics en las páginas donde ya está integrado, para conocer el uso de la plataforma. Google recibe información técnica conforme a su servicio y configuración. También se mantienen registros de interacción propios del portal.</p>
    <p>Consulta la <a href="{{ route('cookies', [], false) }}">Política de cookies</a> para conocer las tecnologías identificadas y el funcionamiento del aviso actual. El aviso de cookies no proporciona un control previo de la medición ni un sistema completo de preferencias.</p>
    <p>Más información: <a href="https://policies.google.com/privacy?hl=es">privacidad de Google</a> y <a href="https://policies.google.com/technologies/partner-sites?hl=es">uso de información en sitios asociados</a>.</p>
    <h2>Proveedores, enlaces y transferencias</h2>
    <p>Google presta el servicio de analítica. La operación del sitio utiliza infraestructura de alojamiento y almacenamiento. La identificación contractual de esos proveedores, su ubicación de tratamiento y sus condiciones de conservación deben completarse en la revisión operativa del responsable.</p>
    <p>Los datos comerciales autorizados para publicación aparecen en las fichas correspondientes. Cuando abres enlaces a plataformas de reserva, WhatsApp, mapas o redes sociales, sales hacia servicios que tienen sus propias condiciones y políticas. Antes de proporcionar información en ellos, revisa sus avisos.</p>
    <p>Cualquier transferencia de datos que requiera consentimiento deberá informarse y sujetarse a las exigencias legales aplicables. No se presupone que aceptar este aviso autoriza finalidades o transferencias no descritas.</p>
    <h2>Google AdSense y publicidad de terceros</h2>
    <p>El portal incorpora el código de Google AdSense en la portada y las guías turísticas. La aparición efectiva de anuncios depende de la aprobación y configuración del sitio en la cuenta de Google.</p>
    <p>Google y los proveedores publicitarios que participen pueden utilizar cookies y tecnologías similares para mostrar anuncios basados en visitas anteriores a este y otros sitios. La publicidad personalizada está sujeta a las opciones del usuario y a los consentimientos exigibles según su región. El aviso informativo actual del portal no gestiona esas preferencias.</p>
    <p>Puedes administrar opciones de personalización en <a href="https://myadcenter.google.com/">Mi centro de anuncios</a> y consultar <a href="https://policies.google.com/technologies/ads?hl=es">cómo utiliza Google las tecnologías publicitarias</a>. Estas opciones no sustituyen los controles exigibles en el sitio. La lista de proveedores habilitados y la configuración regional deben revisarse en la cuenta AdSense y reflejarse en la información de privacidad.</p>
    <h2>Derechos ARCO, limitación y revocación</h2>
    <p>Para solicitar acceso, rectificación, cancelación u oposición, limitar el uso o divulgación de tus datos o revocar el consentimiento, escribe al correo de privacidad indicado al inicio. Describe qué solicitas y proporciona tu nombre, un medio de respuesta y la información necesaria para localizar los datos. Para rectificación, explica el cambio solicitado y aporta el soporte pertinente.</p>
    <p>El responsable podrá solicitar la acreditación proporcional de tu identidad o representación mediante un procedimiento acordado para atender la solicitud. No envíes identificaciones o datos sensibles sin que se haya acordado cómo entregarlos.</p>
    <p>Conforme a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, la determinación sobre una solicitud ARCO se comunica en un máximo de veinte días hábiles desde su recepción; si procede, se hace efectiva dentro de los quince días hábiles siguientes a la comunicación. Las ampliaciones legalmente permitidas deben justificarse. La revocación no tiene efectos retroactivos y puede estar sujeta a obligaciones de conservación o excepciones legales.</p>
    <h2>Conservación y seguridad</h2>
    <p>La duración efectiva de los registros del servidor, eventos propios, correo y analítica depende de las prácticas y configuraciones del responsable y sus proveedores. No se ha establecido en este documento un plazo uniforme que sustituya esas configuraciones. El responsable debe definir y documentar los periodos de conservación y supresión aplicables.</p>
    <p>El portal utiliza mecanismos de sesión, autenticación y protección de formularios. Esta descripción no constituye una promesa de invulnerabilidad ni una certificación de seguridad. Las medidas de infraestructura deben revisarse con los proveedores reales.</p>
    <h2>Visitantes internacionales y actualizaciones</h2>
    <p>Si una visita o un tratamiento está sujeto a normas de otra región, deberán evaluarse los derechos y consentimientos aplicables. No se afirma cumplimiento automático con todas las jurisdicciones. La publicidad para determinados territorios puede exigir una plataforma de consentimiento certificada.</p>
    <p>Los cambios se comunicarán mediante una nueva versión de este aviso en esta URL, indicando su fecha; si una modificación requiere otro medio de información o consentimiento, el responsable deberá implementarlo antes del tratamiento correspondiente.</p>
    <p id="terminos">Consulta también los <a href="{{ route('terms', [], false) }}">Términos y condiciones</a> y la página de <a href="{{ route('contact', [], false) }}">Contacto</a>.</p>
@endsection
