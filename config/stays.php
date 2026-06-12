<?php

return [
    'airbnbs' => [
        'TORREA101' => [
            'name' => 'Departamento A101',
            'host' => 'Cliente inicial',
            'tower' => 'Torre Departamentos A',
            'zone' => 'torre-departamentos-a',
            'headline' => 'Tu guía cercana para moverte desde Torre Departamentos A.',
            'description' => 'Este código abre recomendaciones pensadas para huéspedes de este Airbnb: comercios cercanos, servicios rápidos, alimentos, experiencias y rutas útiles.',
        ],
        'TORREA202' => [
            'name' => 'Departamento A202',
            'host' => 'Cliente inicial',
            'tower' => 'Torre Departamentos A',
            'zone' => 'torre-departamentos-a',
            'headline' => 'Todo lo útil alrededor de tu estancia.',
            'description' => 'Comparte la misma zona de cercanía que otros departamentos de la torre, pero conserva su propio código para medir visitas.',
        ],
        'TORREA303' => [
            'name' => 'Departamento A303',
            'host' => 'Cliente inicial',
            'tower' => 'Torre Departamentos A',
            'zone' => 'torre-departamentos-a',
            'headline' => 'Recomendaciones locales desde tu torre.',
            'description' => 'Una microguía para encontrar negocios, comida, transporte y promociones cerca de este Airbnb.',
        ],
        'TORREA404' => [
            'name' => 'Departamento A404',
            'host' => 'Cliente inicial',
            'tower' => 'Torre Departamentos A',
            'zone' => 'torre-departamentos-a',
            'headline' => 'Descubre lo que tienes cerca sin buscar de más.',
            'description' => 'Contenido compartido por ubicación y métricas separadas por código de Airbnb.',
        ],
    ],

    'zones' => [
        'torre-departamentos-a' => [
            'name' => 'Torre Departamentos A',
            'area' => 'Zona inicial',
            'summary' => 'Locales y servicios recomendados para huéspedes hospedados en la torre.',
            'nearby' => [
                [
                    'name' => 'Café de la Torre',
                    'category' => 'Café y desayuno',
                    'distance' => 'Planta baja',
                    'description' => 'Café, pan dulce y desayunos rápidos para iniciar el día sin alejarse.',
                    'ad_slot' => 'Premium planta baja',
                ],
                [
                    'name' => 'La Esquina Local',
                    'category' => 'Comida casual',
                    'distance' => '3 min caminando',
                    'description' => 'Comida local para huéspedes que quieren algo cercano y confiable.',
                    'ad_slot' => 'Restaurante destacado',
                ],
                [
                    'name' => 'Mini Súper Torre A',
                    'category' => 'Compras rápidas',
                    'distance' => 'Planta baja',
                    'description' => 'Agua, botanas, básicos de higiene y artículos de emergencia.',
                    'ad_slot' => 'Servicio esencial',
                ],
                [
                    'name' => 'Traslados Jalisco',
                    'category' => 'Transporte y tours',
                    'distance' => 'Reserva previa',
                    'description' => 'Traslados al aeropuerto, rutas cortas y salidas turísticas privadas.',
                    'ad_slot' => 'Servicio turístico',
                ],
            ],
        ],
    ],
];
