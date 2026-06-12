<?php

namespace App\Http\Controllers;

use App\Models\Airbnb;
use App\Models\AnalyticsEvent;
use App\Models\Business;
use App\Models\PremiumService;
use App\Models\PublicAd;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $last30Days = now()->subDays(30);

        return view('dashboard.index', [
            'zonesCount' => Zone::count(),
            'airbnbsCount' => Airbnb::count(),
            'businessesCount' => Business::count(),
            'publicAdsCount' => PublicAd::count(),
            'premiumServicesCount' => PremiumService::count(),
            'usersCount' => User::count(),
            'analyticsSummary' => [
                'homeVisits' => AnalyticsEvent::where('event_type', 'home_visit')->where('occurred_at', '>=', $last30Days)->count(),
                'airbnbProfileVisits' => AnalyticsEvent::where('event_type', 'airbnb_profile_visit')->where('occurred_at', '>=', $last30Days)->count(),
                'codeLookups' => AnalyticsEvent::where('event_type', 'airbnb_code_lookup')->where('occurred_at', '>=', $last30Days)->count(),
                'invalidCodes' => AnalyticsEvent::where('event_type', 'airbnb_code_invalid')->where('occurred_at', '>=', $last30Days)->count(),
                'totalClicks' => AnalyticsEvent::whereIn('event_type', [
                    'airbnb_reserve_click',
                    'business_whatsapp_click',
                    'business_directions_click',
                    'public_ad_click',
                    'premium_service_whatsapp_click',
                    'destination_interest',
                ])->where('occurred_at', '>=', $last30Days)->count(),
                'uniqueVisitors' => AnalyticsEvent::where('occurred_at', '>=', $last30Days)->distinct('ip_hash')->count('ip_hash'),
            ],
            'topZones' => $this->topZones($last30Days),
            'topAirbnbs' => $this->topAirbnbs($last30Days),
            'topBusinesses' => $this->topBusinesses($last30Days),
            'topDestinations' => $this->topDestinations($last30Days),
            'topPublicAds' => $this->topPublicAds($last30Days),
            'topPremiumServices' => $this->topPremiumServices($last30Days),
            'recentEvents' => AnalyticsEvent::latest('occurred_at')->limit(12)->get(),
            'recentAirbnbs' => Airbnb::with('zone')->latest()->limit(5)->get(),
            'recentBusinesses' => Business::with('zone')->latest()->limit(5)->get(),
        ]);
    }

    private function topZones($since)
    {
        return AnalyticsEvent::query()
            ->join('zones', 'analytics_events.zone_id', '=', 'zones.id')
            ->where('analytics_events.occurred_at', '>=', $since)
            ->select('zones.name', DB::raw('count(*) as total'))
            ->groupBy('zones.id', 'zones.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    private function topAirbnbs($since)
    {
        return AnalyticsEvent::query()
            ->join('airbnbs', 'analytics_events.airbnb_id', '=', 'airbnbs.id')
            ->where('analytics_events.event_type', 'airbnb_profile_visit')
            ->where('analytics_events.occurred_at', '>=', $since)
            ->select('airbnbs.name', 'airbnbs.code', DB::raw('count(*) as total'))
            ->groupBy('airbnbs.id', 'airbnbs.name', 'airbnbs.code')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    private function topBusinesses($since)
    {
        return AnalyticsEvent::query()
            ->join('businesses', 'analytics_events.business_id', '=', 'businesses.id')
            ->whereIn('analytics_events.event_type', ['business_whatsapp_click', 'business_directions_click'])
            ->where('analytics_events.occurred_at', '>=', $since)
            ->select('businesses.name', DB::raw('count(*) as total'))
            ->groupBy('businesses.id', 'businesses.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    private function topDestinations($since)
    {
        return AnalyticsEvent::query()
            ->where('event_type', 'destination_interest')
            ->where('occurred_at', '>=', $since)
            ->whereNotNull('destination')
            ->select('destination as name', DB::raw('count(*) as total'))
            ->groupBy('destination')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    private function topPublicAds($since)
    {
        return AnalyticsEvent::query()
            ->join('public_ads', 'analytics_events.public_ad_id', '=', 'public_ads.id')
            ->where('analytics_events.event_type', 'public_ad_click')
            ->where('analytics_events.occurred_at', '>=', $since)
            ->select('public_ads.title as name', DB::raw('count(*) as total'))
            ->groupBy('public_ads.id', 'public_ads.title')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    private function topPremiumServices($since)
    {
        return AnalyticsEvent::query()
            ->join('premium_services', 'analytics_events.premium_service_id', '=', 'premium_services.id')
            ->where('analytics_events.event_type', 'premium_service_whatsapp_click')
            ->where('analytics_events.occurred_at', '>=', $since)
            ->select('premium_services.title as name', DB::raw('count(*) as total'))
            ->groupBy('premium_services.id', 'premium_services.title')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }
}
