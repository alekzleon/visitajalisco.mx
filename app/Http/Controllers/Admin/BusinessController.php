<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use App\Models\Zone;
use App\Support\PublicUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function index(): View
    {
        return view('dashboard.businesses.index', [
            'businesses' => Business::with(['zone', 'user'])->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.businesses.form', $this->formData(new Business()));
    }

    public function store(Request $request): RedirectResponse
    {
        Business::create($this->validatedData($request));

        return redirect()->route('dashboard.businesses.index')->with('status', 'Negocio creado.');
    }

    public function edit(Business $business): View
    {
        return view('dashboard.businesses.form', $this->formData($business));
    }

    public function update(Request $request, Business $business): RedirectResponse
    {
        $business->update($this->validatedData($request, $business));

        return redirect()->route('dashboard.businesses.index')->with('status', 'Negocio actualizado.');
    }

    public function toggle(Business $business): RedirectResponse
    {
        $business->update(['is_active' => ! $business->is_active]);

        return back()->with('status', 'Estado actualizado.');
    }

    private function formData(Business $business): array
    {
        return [
            'business' => $business,
            'zones' => Zone::orderBy('name')->get(),
            'owners' => User::where('role', 'business')->orderBy('name')->get(),
        ];
    }

    private function validatedData(Request $request, ?Business $business = null): array
    {
        $data = $request->validate([
            'zone_id' => ['required', 'exists:zones,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'distance' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'ad_slot' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'maps_url' => ['nullable', 'url', 'max:255'],
            'instagram_username' => ['nullable', 'string', 'max:100'],
            'facebook_username' => ['nullable', 'string', 'max:100'],
            'tiktok_username' => ['nullable', 'string', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            PublicUpload::delete($business?->image_url);
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

        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
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
