@extends('information.layout')
@section('information')
    <h2>Una guía para descubrir Jalisco</h2>
    <p>Visita Jalisco reúne información turística para ayudar a elegir un destino y preparar una visita. Es una iniciativa comercial independiente de las instituciones de gobierno, operada por {{ config('site_operator.name') }}.</p>
    <p>El portal ofrece guías de Tequila, Ajijic, Chapala, Lagos de Moreno, Mascota, Mazamitla, Cocula, Sayula, Tapalpa y San Pedro Tlaquepaque. También permite consultar información asociada a un código de hospedaje y acceder a referencias comerciales y servicios de terceros.</p>
    <h2>Cómo se prepara el contenido</h2>
    <p>Las guías combinan redacción propia, fuentes turísticas identificadas en cada página y propuestas editoriales para organizar la visita. Los tiempos sugeridos no son garantías de traslado ni de acceso. El contenido no se presenta como una visita de campo realizada por el equipo ni como una reseña verificada de cada establecimiento.</p>
    <p>Los lugares incluidos se limitan a los destinos actualmente publicados. Las referencias comerciales se distinguen del contenido editorial y no certifican la calidad del servicio ni sustituyen una consulta directa con el proveedor.</p>
    <h2>Correcciones y derechos de materiales</h2>
    <p>Si encuentras información desactualizada o quieres informar sobre derechos de un material, indícanos la URL y el motivo mediante <a href="{{ route('contact', [], false) }}">Contacto</a>. La solicitud permitirá evaluar la corrección, sin prometer publicaciones o resultados automáticos.</p>
    <p>Consulta los <a href="{{ route('terms', [], false) }}">Términos y condiciones</a> y el <a href="{{ route('privacy', [], false) }}">Aviso de privacidad</a> para conocer el alcance del servicio y el uso de los datos.</p>
@endsection
