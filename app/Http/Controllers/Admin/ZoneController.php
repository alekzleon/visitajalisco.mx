<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ZoneController extends Controller
{
    public function index(): View
    {
        return view('dashboard.zones.index', [
            'zones' => Zone::withCount(['airbnbs', 'businesses'])->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.zones.form', ['zone' => new Zone()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['name']);

        Zone::create($data);

        return redirect()->route('dashboard.zones.index')->with('status', 'Zona creada.');
    }

    public function edit(Zone $zone): View
    {
        return view('dashboard.zones.form', ['zone' => $zone]);
    }

    public function update(Request $request, Zone $zone): RedirectResponse
    {
        $zone->update($this->validatedData($request, $zone));

        return redirect()->route('dashboard.zones.index')->with('status', 'Zona actualizada.');
    }

    public function toggle(Zone $zone): RedirectResponse
    {
        $zone->update(['is_active' => ! $zone->is_active]);

        return back()->with('status', 'Estado actualizado.');
    }

    private function validatedData(Request $request, ?Zone $zone = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'area' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($zone && ! $zone->slug) {
            $data['slug'] = $this->uniqueSlug($data['name'], $zone);
        }

        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }

    private function uniqueSlug(string $name, ?Zone $zone = null): string
    {
        $baseSlug = Str::slug($name) ?: 'zona';
        $slug = $baseSlug;
        $suffix = 2;

        while (
            Zone::where('slug', $slug)
                ->when($zone, fn ($query) => $query->whereKeyNot($zone->id))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
