@extends('information.layout')
@section('information')
    <h2>Escríbenos</h2>
    <p>Para consultas sobre el portal, correcciones turísticas, derechos de imágenes o referencias comerciales, escribe a <a href="mailto:{{ config('site_operator.support_email') }}">{{ config('site_operator.support_email') }}</a>.</p>
    <p>Visita Jalisco es operado por {{ config('site_operator.name') }}, de forma independiente a las instituciones de gobierno.</p>
    <h2>Cómo reportar una corrección</h2>
    <p>Incluye la URL, una descripción del problema y, cuando sea posible, una fuente que permita revisar el dato. Para una consulta comercial, identifica el anuncio o servicio al que te refieres. No se garantiza un plazo de respuesta comercial que no haya sido acordado.</p>
    <h2>Privacidad y derechos ARCO</h2>
    <p>Para asuntos de datos personales utiliza <a href="mailto:{{ config('site_operator.privacy_email') }}">{{ config('site_operator.privacy_email') }}</a> y consulta el procedimiento del <a href="{{ route('privacy', [], false) }}">Aviso de privacidad</a>. Evita enviar identificaciones, datos sensibles o documentos de pago sin acordar antes un medio adecuado.</p>
    <p>Este enlace abre tu aplicación de correo; el sitio no simula un formulario enviado ni recibe un mensaje hasta que decidas enviarlo desde tu correo.</p>
@endsection
