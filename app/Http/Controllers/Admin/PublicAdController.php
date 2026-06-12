<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicAd;
use App\Support\PublicUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicAdController extends Controller
{
    public function index(): View
    {
        return view('dashboard.public-ads.index', [
            'publicAds' => PublicAd::orderBy('position')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.public-ads.form', [
            'publicAd' => new PublicAd(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        PublicAd::create($this->validatedData($request));

        return redirect()->route('dashboard.public-ads.index')->with('status', 'Publicidad creada.');
    }

    public function edit(PublicAd $publicAd): View
    {
        return view('dashboard.public-ads.form', [
            'publicAd' => $publicAd,
        ]);
    }

    public function update(Request $request, PublicAd $publicAd): RedirectResponse
    {
        $publicAd->update($this->validatedData($request, $publicAd));

        return redirect()->route('dashboard.public-ads.index')->with('status', 'Publicidad actualizada.');
    }

    public function toggle(PublicAd $publicAd): RedirectResponse
    {
        $publicAd->update(['is_active' => ! $publicAd->is_active]);

        return back()->with('status', 'Estado actualizado.');
    }

    private function validatedData(Request $request, ?PublicAd $publicAd = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'integer', 'min:0'],
            'image' => [$publicAd?->exists ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            PublicUpload::delete($publicAd?->image_url);
            $data['image_url'] = PublicUpload::store($request->file('image'), 'public-ads');
        }

        unset($data['image']);

        $data['position'] = (int) ($data['position'] ?? 0);
        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }
}
