@extends('information.layout')
@section('information')
    <h2>Operador y alcance</h2>
    <p>Visita Jalisco es operado por {{ config('site_operator.name') }}. Puedes contactar al equipo a través de <a href="{{ route('contact', [], false) }}">Contacto</a>. Es una iniciativa comercial independiente, sin representación de dependencias de gobierno.</p>
    <p>El portal publica guías turísticas y referencias a hospedajes, negocios, anunciantes y servicios de terceros en Jalisco. Al utilizarlo debes respetar estas condiciones y la normativa aplicable. Estas condiciones no sustituyen los acuerdos que puedas celebrar directamente con un tercero.</p>
    <h2>Información turística y enlaces de hospedaje</h2>
    <p>Las guías ofrecen orientaciones editoriales, no una promesa de horarios, precios, accesos, disponibilidad, seguridad o accesibilidad de cada lugar. Confirma las condiciones con el recinto u operador antes de trasladarte o contratar.</p>
    <p>El código de hospedaje abre la información asociada a la estancia. Los enlaces de reserva y contacto llevan a plataformas o canales de terceros. El flujo público inspeccionado no procesa pagos ni confirma reservas por sí mismo. Las condiciones de contratación deben consultarse con quien presta el servicio.</p>
    <h2>Contenido editorial y comercial</h2>
    <p>Las guías de destinos se distinguen de los espacios comerciales. Los anuncios de portada y servicios se presentan como publicidad o contenido comercial; su publicación no equivale a una certificación de calidad ni a una garantía sobre el proveedor. La presencia y posición de referencias comerciales dependen de los registros activos y la configuración del portal.</p>
    <p>El portal incorpora el código de Google AdSense; los anuncios que se publiquen deberán identificarse y respetar los controles de privacidad aplicables. No se solicita al visitante hacer clic en anuncios para apoyar al sitio.</p>
    <h2>Uso permitido y conductas prohibidas</h2>
    <p>Puedes consultar las guías y compartir sus enlaces para planear tu viaje. No debes suplantar identidades, intentar acceder a cuentas o información ajena, enviar contenido ilícito ni interferir con el funcionamiento del portal. Los accesos de administrador, anfitrión o negocio requieren autorización.</p>
    <h2>Textos, imágenes y marcas</h2>
    <p>La consulta del sitio no concede una licencia general para reutilizar sus textos, fotografías, logotipos o marcas. Los derechos corresponden a sus titulares según cada material. Para solicitar autorización o informar sobre derechos de una imagen, escribe al equipo de contacto e identifica el contenido. No se afirma que todas las imágenes sean de propiedad del operador ni se atribuyen licencias no comprobadas.</p>
    <h2>Servicios externos y responsabilidades</h2>
    <p>Los sitios y canales externos tienen sus propias condiciones. Revisa quién presta el servicio, qué incluye y cómo atenderá cambios o cancelaciones antes de contratar. El portal puede corregir o retirar información cuando detecte errores o reciba una solicitud fundada, sin sustituir los derechos y obligaciones legales que correspondan a cada parte.</p>
    <p>Estas condiciones no excluyen responsabilidades que no puedan excluirse por ley ni implican renuncia a derechos del consumidor. Las controversias se sujetarán a la legislación y autoridades competentes que correspondan; no se impone una jurisdicción específica no verificada.</p>
    <h2>Correcciones, privacidad y cambios</h2>
    <p>Para reportar un error, indica la URL, la información cuestionada y, si es posible, una fuente que permita comprobarla. No envíes información sensible innecesaria. Consulta el <a href="{{ route('privacy', [], false) }}">Aviso de privacidad</a> y la <a href="{{ route('cookies', [], false) }}">Política de cookies</a>.</p>
    <p>Las modificaciones de estas condiciones se publicarán en esta URL con la fecha de la nueva versión, sin atribuirles efectos retroactivos indebidos.</p>
@endsection
