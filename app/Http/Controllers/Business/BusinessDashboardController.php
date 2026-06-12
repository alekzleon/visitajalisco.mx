<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Support\PublicUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BusinessDashboardController extends Controller
{
    public function index(Request $request): View
    {
        return view('business.index', [
            'businesses' => Business::with('zone')
                ->where('user_id', $request->user()->id)
                ->latest()
                ->get(),
        ]);
    }

    public function edit(Request $request, Business $business): View
    {
        abort_unless($business->user_id === $request->user()->id, 403);

        return view('business.form', ['business' => $business->load('zone')]);
    }

    public function update(Request $request, Business $business): RedirectResponse
    {
        abort_unless($business->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'distance' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'maps_url' => ['nullable', 'url', 'max:255'],
            'instagram_username' => ['nullable', 'string', 'max:100'],
            'facebook_username' => ['nullable', 'string', 'max:100'],
            'tiktok_username' => ['nullable', 'string', 'max:100'],
        ]);

        if ($request->hasFile('image')) {
            PublicUpload::delete($business->image_url);
            $data['image_url'] = PublicUpload::store($request->file('image'), 'businesses');
        }

        unset($data['image']);

        if (! empty($data['whatsapp'])) {
            $data['whatsapp'] = preg_replace('/[^\d+]/', '', $data['whatsapp']);
        }

        $this->validateGoogleMapsUrl($data['maps_url'] ?? null);

        foreach (['instagram_username', 'facebook_username', 'tiktok_username'] as $field) {
            if (! empty($data[$field])) {
                $data[$field] = ltrim(trim($data[$field]), '@');
            }
        }

        $business->update($data);

        return redirect()->route('business.dashboard')->with('status', 'Negocio actualizado.');
    }

    private function validateGoogleMapsUrl(?string $url): void
    {
        if (! $url) {
            return;
        }

        $host = parse_url($url, PHP_URL_HOST);
        $host = $host ? strtolower($host) : '';

        if (! str_contains($host, 'google.') && ! in_array($host, ['maps.app.goo.gl', 'goo.gl'], true)) {
            throw ValidationException::withMessages([
                'maps_url' => 'El link de cómo llegar debe ser de Google Maps.',
            ]);
        }
    }
}
