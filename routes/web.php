<?php

use App\Http\Controllers\Admin\AirbnbController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\PremiumServiceController;
use App\Http\Controllers\Admin\PublicAdController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Airbnb\AirbnbDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Business\BusinessDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrackingController;
use App\Models\Airbnb;
use App\Models\AnalyticsEvent;
use App\Models\PremiumService;
use App\Models\PublicAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    AnalyticsEvent::record('home_visit', $request);

    return view('welcome', [
        'homeAirbnbs' => Airbnb::with('zone')
            ->where('is_active', true)
            ->latest()
            ->limit(6)
            ->get(),
        'publicAds' => PublicAd::where('is_active', true)
            ->orderBy('position')
            ->latest()
            ->limit(6)
            ->get(),
        'premiumServices' => PremiumService::where('is_active', true)
            ->orderBy('position')
            ->latest()
            ->limit(4)
            ->get(),
    ]);
});

Route::view('/aviso-de-privacidad', 'privacy')->name('privacy');

Route::prefix('track')->name('track.')->group(function () {
    Route::get('/airbnbs/{airbnb}/reservar', [TrackingController::class, 'airbnbReserve'])->name('airbnbs.reserve');
    Route::get('/negocios/{business}/whatsapp', [TrackingController::class, 'businessWhatsapp'])->name('businesses.whatsapp');
    Route::get('/negocios/{business}/como-llegar', [TrackingController::class, 'businessDirections'])->name('businesses.directions');
    Route::get('/publicidad/{publicAd}', [TrackingController::class, 'publicAd'])->name('public-ads.click');
    Route::get('/servicios/{premiumService}/whatsapp', [TrackingController::class, 'premiumServiceWhatsapp'])->name('premium-services.whatsapp');
    Route::get('/destinos/{destination}', [TrackingController::class, 'destination'])->name('destinations.interest');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('zones', ZoneController::class)->except(['show', 'destroy']);
    Route::patch('zones/{zone}/toggle', [ZoneController::class, 'toggle'])->name('zones.toggle');

    Route::resource('airbnbs', AirbnbController::class)->except(['show', 'destroy']);
    Route::patch('airbnbs/{airbnb}/toggle', [AirbnbController::class, 'toggle'])->name('airbnbs.toggle');

    Route::resource('businesses', BusinessController::class)->except(['show', 'destroy']);
    Route::patch('businesses/{business}/toggle', [BusinessController::class, 'toggle'])->name('businesses.toggle');

    Route::resource('public-ads', PublicAdController::class)
        ->parameters(['public-ads' => 'publicAd'])
        ->except(['show', 'destroy']);
    Route::patch('public-ads/{publicAd}/toggle', [PublicAdController::class, 'toggle'])->name('public-ads.toggle');

    Route::resource('premium-services', PremiumServiceController::class)
        ->parameters(['premium-services' => 'premiumService'])
        ->except(['show', 'destroy']);
    Route::patch('premium-services/{premiumService}/toggle', [PremiumServiceController::class, 'toggle'])->name('premium-services.toggle');

    Route::resource('users', UserController::class)->except(['show', 'destroy']);
});

Route::middleware(['auth', 'business'])->prefix('business')->name('business.')->group(function () {
    Route::get('/', [BusinessDashboardController::class, 'index'])->name('dashboard');
    Route::get('/negocios/{business}/editar', [BusinessDashboardController::class, 'edit'])->name('businesses.edit');
    Route::put('/negocios/{business}', [BusinessDashboardController::class, 'update'])->name('businesses.update');
});

Route::middleware(['auth', 'airbnb'])->prefix('airbnb')->name('airbnb.')->group(function () {
    Route::get('/', [AirbnbDashboardController::class, 'index'])->name('dashboard');
    Route::get('/hospedajes/{airbnb}/editar', [AirbnbDashboardController::class, 'edit'])->name('airbnbs.edit');
    Route::put('/hospedajes/{airbnb}', [AirbnbDashboardController::class, 'update'])->name('airbnbs.update');
    Route::get('/hospedajes/{airbnb}/qr', [AirbnbDashboardController::class, 'qr'])->name('airbnbs.qr');
    Route::get('/hospedajes/{airbnb}/qr/descargar', [AirbnbDashboardController::class, 'downloadQr'])->name('airbnbs.qr.download');
    Route::get('/hospedajes/{airbnb}/qr/imprimir', [AirbnbDashboardController::class, 'printQr'])->name('airbnbs.qr.print');
});

Route::post('/codigo-airbnb', function (Request $request) {
    $validated = $request->validate([
        'code' => ['required', 'string', 'max:40'],
    ]);

    $code = strtoupper(trim($validated['code']));

    if (! Airbnb::where('code', $code)->where('is_active', true)->exists()) {
        AnalyticsEvent::record('airbnb_code_invalid', $request, [
            'code' => $code,
        ]);

        return back()
            ->withInput()
            ->withErrors(['code' => 'No encontramos ese código. Revisa con tu anfitrión e intenta de nuevo.']);
    }

    AnalyticsEvent::record('airbnb_code_lookup', $request, [
        'code' => $code,
    ]);

    return redirect()->route('stays.show', ['code' => $code]);
})->name('stays.lookup');

Route::get('/estancias/{code}', function (Request $request, string $code) {
    $code = strtoupper(trim($code));
    $airbnb = Airbnb::with(['zone.businesses' => fn ($query) => $query->where('is_active', true)->latest()])
        ->where('code', $code)
        ->where('is_active', true)
        ->first();

    abort_if(! $airbnb, 404);

    $zone = $airbnb->zone;

    abort_if(! $zone, 404);

    AnalyticsEvent::record('airbnb_profile_visit', $request, [
        'airbnb_id' => $airbnb->id,
        'zone_id' => $zone->id,
        'code' => $code,
        'meta' => [
            'airbnb' => $airbnb->name,
            'zone' => $zone->name,
        ],
    ]);

    return view('stays.show', [
        'code' => $code,
        'airbnb' => $airbnb,
        'zone' => $zone,
    ]);
})->name('stays.show');
