@extends('information.layout')
@section('information')
    <h2>Cookies y almacenamiento local</h2>
    <p>Las cookies son pequeños datos que un sitio guarda en el navegador y puede recibir en visitas posteriores. El almacenamiento local permite conservar datos en ese navegador sin enviarlos automáticamente con cada petición. Ambos mecanismos pueden borrarse desde la configuración del navegador.</p>
    <h2>Tecnologías identificadas</h2>
    <p>El inventario distingue mecanismos observados en respuestas públicas de los previstos por el código. La duración y activación pueden variar según la configuración y el navegador.</p>
    <div class="table-scroll" tabindex="0" role="region" aria-label="Inventario de cookies y almacenamiento">
        <table>
            <thead><tr><th scope="col">Tecnología / categoría</th><th scope="col">Proveedor y finalidad</th><th scope="col">Duración y activación</th></tr></thead>
            <tbody>
                <tr><td>laravel_session — necesaria, observada en respuestas públicas</td><td>Visita Jalisco / Laravel. Mantener la sesión y el estado de la navegación o del acceso autorizado.</td><td>Se emite al usar páginas de la aplicación. Su duración depende de la configuración de sesión; no se garantiza un plazo idéntico para todos los entornos.</td></tr>
                <tr><td>XSRF-TOKEN — necesaria, observada en respuestas públicas</td><td>Visita Jalisco / Laravel. Protección de peticiones y formularios frente a solicitudes no autorizadas.</td><td>Se emite con la sesión; su duración depende de la configuración efectiva.</td></tr>
                <tr><td>Cookie de acceso persistente — posible si se solicita «recordarme»</td><td>Visita Jalisco / Laravel. Mantener el acceso de una cuenta que selecciona esa opción.</td><td>Condicionada al inicio de sesión con esa opción; nombre y vencimiento deben consultarse en ese navegador. No se presenta como observada en navegación anónima.</td></tr>
                <tr><td>Cookies de medición de Google Analytics — configuración presente</td><td>Google. Medir el uso de las páginas donde ya está instalado Analytics. Los nombres habituales _ga y _ga_… son posibles, no una lista de cookies observadas en esta auditoría sin ejecución de medición.</td><td>La carga de Analytics en las páginas actuales no depende del botón del aviso. Cookies, duración y retención dependen del servicio y su configuración; pueden variar por navegador.</td></tr>
                <tr><td>visita-jalisco-cookie-consent — localStorage, preferencia del aviso</td><td>Visita Jalisco. Recuerda que se pulsó «Aceptar» y evita mostrar otra vez el aviso de portada.</td><td>El código guarda accepted sin vencimiento propio; persiste hasta borrado del navegador. «Después» solo cierra temporalmente el aviso.</td></tr>
            </tbody>
        </table>
    </div>
    <h2>Qué hace el aviso actual</h2>
    <p>Los botones del aviso permiten cerrarlo o recordar su aceptación. No bloquean previamente Google Analytics ni permiten seleccionar categorías de cookies. No se presenta este aviso como una CMP certificada, Consent Mode ni un mecanismo completo de aceptación o rechazo de medición.</p>
    <p>Para volver a ver el aviso, puedes borrar los datos locales de visitajalisco.mx desde el navegador. Borrar ese dato no revoca por sí mismo la medición ni impide nuevas cookies. No hay un panel de preferencias de privacidad implementado al que podamos enlazar.</p>
    <h2>Cómo gestionar el navegador</h2>
    <p>Puedes eliminar o bloquear cookies desde las opciones de privacidad del navegador. Si bloqueas las necesarias, el inicio de sesión, la persistencia de errores y los formularios pueden verse afectados. Los cambios se aplican al navegador y dispositivo utilizados.</p>
    <p>Información de Google: <a href="https://policies.google.com/technologies/cookies?hl=es">cookies</a>, <a href="https://policies.google.com/privacy?hl=es">privacidad</a> y <a href="https://tools.google.com/dlpage/gaoptout?hl=es">complemento de inhabilitación de Analytics</a>, sujeto a compatibilidad y al alcance descrito por Google.</p>
    <h2>Publicidad y terceros</h2>
    <p>La portada y las guías incorporan el código de AdSense. Google y los proveedores publicitarios participantes pueden utilizar cookies o tecnologías similares para mostrar anuncios basados en visitas anteriores; la aparición de anuncios depende del estado y la configuración de la cuenta. El inventario de cookies observado y los controles regionales deben verificarse con la integración publicitaria efectiva.</p>
    <p>Consulta <a href="https://myadcenter.google.com/">Mi centro de anuncios</a> y <a href="https://policies.google.com/technologies/ads?hl=es">tecnologías publicitarias de Google</a>. Los anuncios comerciales publicados directamente por el portal y sus enlaces no equivalen a tener cookies de AdSense instaladas. Los servicios externos de destino tienen políticas propias.</p>
    <h2>Actualización y contacto</h2>
    <p>Esta página describe la implementación inspeccionada. Las modificaciones se reflejarán aquí con una nueva fecha de versión. Para consultas, utiliza la página de <a href="{{ route('contact', [], false) }}">Contacto</a>; el tratamiento de datos se detalla en el <a href="{{ route('privacy', [], false) }}">Aviso de privacidad</a>.</p>
@endsection
