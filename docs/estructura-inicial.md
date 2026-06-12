# Visita Jalisco - estructura inicial

## Objetivo

Crear una plataforma turística local para conectar huéspedes de Airbnb con negocios cercanos, rutas y servicios útiles durante su estancia.

## Primera etapa

- Home pública con video hero, frase principal y navegación base.
- Sección de hospedaje inicial para el Airbnb cliente.
- Sección de negocios locales cercanos al hospedaje.
- Espacios publicitarios preparados para venta por ubicación o categoría.
- Mensaje comercial para futuros anunciantes.

## Módulos siguientes

1. Hospedajes
   - Nombre, descripción, zona, fotos, amenidades y reglas.
   - Relación con negocios cercanos.
   - Código único por Airbnb para llevar al huésped a su página contextual.
   - Métricas separadas por código aunque varios Airbnbs compartan la misma zona.

2. Negocios locales
   - Nombre comercial, categoría, ubicación, horario y contacto.
   - Imagen publicitaria editable por el negocio.
   - Relación por zona para que varios Airbnbs cercanos compartan recomendaciones.

3. Espacios publicitarios
   - Posición, zona, precio, vigencia y prioridad.
   - Estado: disponible, reservado, activo, vencido.

4. Acceso para empresas
   - Usuario propietario del negocio.
   - Panel para actualizar imagen, promoción y datos visibles.

5. Pagos recurrentes
   - Plan contratado.
   - Método de pago domiciliado.
   - Historial de pagos y estado de publicación.

## Dashboard administrativo

Ruta:

`/dashboard`

Acceso inicial:

- Correo: `admin@visitajalisco.mx`
- Contraseña: `password`

Roles iniciales:

- `admin`: administra zonas, Airbnbs, negocios y usuarios.
- `airbnb`: cuenta para propietarios o anfitriones.
- `business`: cuenta para negocios anunciantes.

Flujo de negocios:

- El administrador crea el usuario tipo `business`.
- El administrador crea el negocio y lo asigna a una zona.
- El administrador asigna el negocio al usuario tipo `business`.
- El usuario tipo `business` entra en `/business`.
- El usuario tipo `business` solo puede editar los negocios donde su cuenta está asignada como responsable.
- El usuario tipo `business` no puede cambiar zona, estado de publicación, permisos ni editar otros negocios.

El dashboard usa diseño propio en Blade/CSS, sin librerías visuales externas. Sanctum queda instalado para proteger futuras rutas API y emisión de tokens.

Flujo Airbnb:

- El administrador crea el usuario tipo `airbnb`.
- El administrador crea el Airbnb y lo asigna a una zona, código, cuenta y torre/edificio.
- El usuario tipo `airbnb` entra en `/airbnb`.
- El usuario tipo `airbnb` solo puede editar nombre de anfitrión, link de Airbnb, frase de página, descripción y galería.
- La galería permite hasta 5 imágenes.
- La primera imagen de la galería alimenta la tarjeta pública del home.
- El usuario tipo `airbnb` puede copiar el link público de su estancia.
- El usuario tipo `airbnb` puede ver, descargar e imprimir un código QR para colocar dentro del hospedaje.
- El usuario tipo `airbnb` no puede cambiar zona, código, cuenta asignada, torre/edificio, estado ni otros Airbnbs.

## Archivo de video principal

El header espera un video local en:

`public/assets/video/jalisco_vd.mp4`

Mientras ese archivo no exista, la página muestra un fondo visual de respaldo para conservar el diseño.

## Flujo de código Airbnb

- El home sigue siendo general para turismo, guías y negocios de todo Jalisco.
- El header tiene un campo para ingresar código de Airbnb.
- Cada código lleva a `/estancias/{codigo}`.
- Varios códigos pueden compartir la misma zona, por ejemplo una torre con varios departamentos.
- La zona comparte negocios cercanos y espacios publicitarios.
- El código conserva la métrica individual para saber qué Airbnb genera más visitas.

Códigos semilla:

- `TORREA101`
- `TORREA202`
- `TORREA303`
- `TORREA404`
