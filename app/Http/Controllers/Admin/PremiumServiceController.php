<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PremiumService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PremiumServiceController extends Controller
{
    public function index(): View
    {
        return view('dashboard.premium-services.index', [
            'premiumServices' => PremiumService::orderBy('position')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.premium-services.form', [
            'premiumService' => new PremiumService(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        PremiumService::create($this->validatedData($request));

        return redirect()->route('dashboard.premium-services.index')->with('status', 'Servicio premium creado.');
    }

    public function edit(PremiumService $premiumService): View
    {
        return view('dashboard.premium-services.form', [
            'premiumService' => $premiumService,
        ]);
    }

    public function update(Request $request, PremiumService $premiumService): RedirectResponse
    {
        $premiumService->update($this->validatedData($request, $premiumService));

        return redirect()->route('dashboard.premium-services.index')->with('status', 'Servicio premium actualizado.');
    }

    public function toggle(PremiumService $premiumService): RedirectResponse
    {
        $premiumService->update(['is_active' => ! $premiumService->is_active]);

        return back()->with('status', 'Estado actualizado.');
    }

    private function validatedData(Request $request, ?PremiumService $premiumService = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'label' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'position' => ['nullable', 'integer', 'min:0'],
            'image' => [$premiumService?->exists ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($premiumService?->image_url && str_starts_with($premiumService->image_url, '/storage/premium-services/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $premiumService->image_url));
            }

            $path = $request->file('image')->store('premium-services', 'public');
            $data['image_url'] = Storage::url($path);
        }

        unset($data['image']);

        if (! empty($data['whatsapp'])) {
            $data['whatsapp'] = preg_replace('/[^\d+]/', '', $data['whatsapp']);
        }

        $data['position'] = (int) ($data['position'] ?? 0);
        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }
}
