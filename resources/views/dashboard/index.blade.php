@extends('layouts.dashboard')

@section('title', 'Resumen')

@section('content')
    @php
        $eventLabels = [
            'home_visit' => 'Visita al home',
            'airbnb_profile_visit' => 'Entrada a Airbnb por código/QR',
            'airbnb_code_lookup' => 'Código Airbnb consultado',
            'airbnb_code_invalid' => 'Código inválido',
            'airbnb_reserve_click' => 'Click en reservar Airbnb',
            'business_whatsapp_click' => 'Click WhatsApp negocio',
            'business_directions_click' => 'Click cómo llegar negocio',
            'public_ad_click' => 'Click publicidad',
            'premium_service_whatsapp_click' => 'Click servicio premium',
            'destination_interest' => 'Interés en destino',
        ];
    @endphp

    <div class="page-head">
        <div>
            <h1>Estadísticas</h1>
            <p class="subhead">Métricas de visitas, clicks e intención comercial de los últimos 30 días.</p>
        </div>
    </div>

    <section class="grid">
        <article class="card"><span>Visitas home</span><strong>{{ $analyticsSummary['homeVisits'] }}</strong></article>
        <article class="card"><span>Entradas Airbnb</span><strong>{{ $analyticsSummary['airbnbProfileVisits'] }}</strong></article>
        <article class="card"><span>Códigos usados</span><strong>{{ $analyticsSummary['codeLookups'] }}</strong></article>
        <article class="card"><span>Clicks totales</span><strong>{{ $analyticsSummary['totalClicks'] }}</strong></article>
        <article class="card"><span>Visitantes únicos</span><strong>{{ $analyticsSummary['uniqueVisitors'] }}</strong></article>
        <article class="card"><span>Códigos inválidos</span><strong>{{ $analyticsSummary['invalidCodes'] }}</strong></article>
    </section>

    <section class="grid" style="margin-top:16px;">
        <article class="card"><span>Zonas</span><strong>{{ $zonesCount }}</strong></article>
        <article class="card"><span>Airbnbs</span><strong>{{ $airbnbsCount }}</strong></article>
        <article class="card"><span>Negocios</span><strong>{{ $businessesCount }}</strong></article>
        <article class="card"><span>Publicidad</span><strong>{{ $publicAdsCount }}</strong></article>
        <article class="card"><span>Servicios</span><strong>{{ $premiumServicesCount }}</strong></article>
        <article class="card"><span>Usuarios</span><strong>{{ $usersCount }}</strong></article>
    </section>

    <section class="split">
        <div class="table-card">
            <div class="table-title"><span>Zonas más visitadas</span></div>
            <table>
                <thead><tr><th>Zona</th><th>Visitas</th></tr></thead>
                <tbody>
                    @forelse ($topZones as $zone)
                        <tr><td>{{ $zone->name }}</td><td><span class="pill">{{ $zone->total }}</span></td></tr>
                    @empty
                        <tr><td colspan="2">Aún no hay visitas por zona.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-card">
            <div class="table-title"><span>Airbnbs con más entradas por código</span></div>
            <table>
                <thead><tr><th>Airbnb</th><th>Código</th><th>Entradas</th></tr></thead>
                <tbody>
                    @forelse ($topAirbnbs as $airbnb)
                        <tr><td>{{ $airbnb->name }}</td><td><span class="pill">{{ $airbnb->code }}</span></td><td>{{ $airbnb->total }}</td></tr>
                    @empty
                        <tr><td colspan="3">Aún no hay entradas por código.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="split">
        <div class="table-card">
            <div class="table-title"><span>Negocios con más clicks</span></div>
            <table>
                <thead><tr><th>Negocio</th><th>Clicks</th></tr></thead>
                <tbody>
                    @forelse ($topBusinesses as $business)
                        <tr><td>{{ $business->name }}</td><td><span class="pill">{{ $business->total }}</span></td></tr>
                    @empty
                        <tr><td colspan="2">Aún no hay clicks en negocios.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-card">
            <div class="table-title"><span>Destinos con más interés</span></div>
            <table>
                <thead><tr><th>Destino</th><th>Clicks</th></tr></thead>
                <tbody>
                    @forelse ($topDestinations as $destination)
                        <tr><td>{{ $destination->name }}</td><td><span class="pill">{{ $destination->total }}</span></td></tr>
                    @empty
                        <tr><td colspan="2">Aún no hay interés en destinos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="split">
        <div class="table-card">
            <div class="table-title"><span>Publicidad con más clicks</span></div>
            <table>
                <thead><tr><th>Publicidad</th><th>Clicks</th></tr></thead>
                <tbody>
                    @forelse ($topPublicAds as $publicAd)
                        <tr><td>{{ $publicAd->name }}</td><td><span class="pill">{{ $publicAd->total }}</span></td></tr>
                    @empty
                        <tr><td colspan="2">Aún no hay clicks en publicidad.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-card">
            <div class="table-title"><span>Servicios premium más usados</span></div>
            <table>
                <thead><tr><th>Servicio</th><th>Contactos</th></tr></thead>
                <tbody>
                    @forelse ($topPremiumServices as $service)
                        <tr><td>{{ $service->name }}</td><td><span class="pill">{{ $service->total }}</span></td></tr>
                    @empty
                        <tr><td colspan="2">Aún no hay contactos en servicios.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="split">
        <div class="table-card">
            <div class="table-title"><span>Actividad reciente</span></div>
            <table>
                <thead><tr><th>Evento</th><th>Detalle</th><th>Fecha</th></tr></thead>
                <tbody>
                    @forelse ($recentEvents as $event)
                        <tr>
                            <td>{{ $eventLabels[$event->event_type] ?? $event->event_type }}</td>
                            <td>{{ $event->destination ?? $event->code ?? data_get($event->meta, 'business') ?? data_get($event->meta, 'premium_service') ?? data_get($event->meta, 'public_ad') ?? data_get($event->meta, 'airbnb') ?? 'Sin detalle' }}</td>
                            <td>{{ $event->occurred_at?->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3">Aún no hay eventos registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="split">
        <div class="table-card">
            <div class="table-title">
                <span>Airbnbs recientes</span>
                <a class="link-action" href="{{ route('dashboard.airbnbs.create') }}">Nuevo</a>
            </div>
            <table>
                <thead><tr><th>Código</th><th>Airbnb</th><th>Zona</th></tr></thead>
                <tbody>
                    @forelse ($recentAirbnbs as $airbnb)
                        <tr>
                            <td><span class="pill">{{ $airbnb->code }}</span></td>
                            <td>{{ $airbnb->name }}</td>
                            <td>{{ $airbnb->zone?->name }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3">Sin Airbnbs todavía.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-card">
            <div class="table-title">
                <span>Negocios recientes</span>
                <a class="link-action" href="{{ route('dashboard.businesses.create') }}">Nuevo</a>
            </div>
            <table>
                <thead><tr><th>Negocio</th><th>Categoría</th><th>Zona</th></tr></thead>
                <tbody>
                    @forelse ($recentBusinesses as $business)
                        <tr>
                            <td>{{ $business->name }}</td>
                            <td>{{ $business->category }}</td>
                            <td>{{ $business->zone?->name }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3">Sin negocios todavía.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
