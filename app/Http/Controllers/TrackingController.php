<?php

namespace App\Http\Controllers;

use App\Models\Airbnb;
use App\Models\AnalyticsEvent;
use App\Models\Business;
use App\Models\PremiumService;
use App\Models\PublicAd;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrackingController extends Controller
{
    public function airbnbReserve(Request $request, Airbnb $airbnb): RedirectResponse
    {
        abort_if(! $airbnb->airbnb_url, 404);

        AnalyticsEvent::record('airbnb_reserve_click', $request, [
            'airbnb_id' => $airbnb->id,
            'zone_id' => $airbnb->zone_id,
            'code' => $airbnb->code,
            'target_url' => $airbnb->airbnb_url,
            'meta' => ['airbnb' => $airbnb->name],
        ]);

        return redirect()->away($airbnb->airbnb_url);
    }

    public function businessWhatsapp(Request $request, Business $business): RedirectResponse
    {
        $targetUrl = $business->whatsappUrl();

        abort_if(! $targetUrl, 404);

        AnalyticsEvent::record('business_whatsapp_click', $request, [
            'business_id' => $business->id,
            'zone_id' => $business->zone_id,
            'target_url' => $targetUrl,
            'meta' => ['business' => $business->name],
        ]);

        return redirect()->away($targetUrl);
    }

    public function businessDirections(Request $request, Business $business): RedirectResponse
    {
        abort_if(! $business->maps_url, 404);

        AnalyticsEvent::record('business_directions_click', $request, [
            'business_id' => $business->id,
            'zone_id' => $business->zone_id,
            'target_url' => $business->maps_url,
            'meta' => ['business' => $business->name],
        ]);

        return redirect()->away($business->maps_url);
    }

    public function publicAd(Request $request, PublicAd $publicAd): RedirectResponse
    {
        AnalyticsEvent::record('public_ad_click', $request, [
            'public_ad_id' => $publicAd->id,
            'target_url' => $publicAd->link_url,
            'meta' => ['public_ad' => $publicAd->title],
        ]);

        return $this->redirectToTarget($publicAd->link_url);
    }

    public function premiumServiceWhatsapp(Request $request, PremiumService $premiumService): RedirectResponse
    {
        $targetUrl = $premiumService->whatsappUrl();

        abort_if(! $targetUrl, 404);

        AnalyticsEvent::record('premium_service_whatsapp_click', $request, [
            'premium_service_id' => $premiumService->id,
            'target_url' => $targetUrl,
            'meta' => ['premium_service' => $premiumService->title],
        ]);

        return redirect()->away($targetUrl);
    }

    public function destination(Request $request, string $destination): RedirectResponse
    {
        $destinationName = Str::headline(str_replace('-', ' ', $destination));

        AnalyticsEvent::record('destination_interest', $request, [
            'destination' => $destinationName,
            'target_url' => url('/#destinos'),
        ]);

        return redirect('/#destinos');
    }

    private function redirectToTarget(string $targetUrl): RedirectResponse
    {
        if (str_starts_with($targetUrl, '/') || str_starts_with($targetUrl, '#')) {
            return redirect($targetUrl);
        }

        return redirect()->away($targetUrl);
    }
}
