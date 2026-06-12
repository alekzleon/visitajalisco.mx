<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airbnb;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AirbnbController extends Controller
{
    public function index(): View
    {
        return view('dashboard.airbnbs.index', [
            'airbnbs' => Airbnb::with(['zone', 'user'])->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.airbnbs.form', $this->formData(new Airbnb()));
    }

    public function store(Request $request): RedirectResponse
    {
        Airbnb::create($this->validatedData($request));

        return redirect()->route('dashboard.airbnbs.index')->with('status', 'Airbnb creado.');
    }

    public function edit(Airbnb $airbnb): View
    {
        return view('dashboard.airbnbs.form', $this->formData($airbnb));
    }

    public function update(Request $request, Airbnb $airbnb): RedirectResponse
    {
        $airbnb->update($this->validatedData($request, $airbnb));

        return redirect()->route('dashboard.airbnbs.index')->with('status', 'Airbnb actualizado.');
    }

    public function toggle(Airbnb $airbnb): RedirectResponse
    {
        $airbnb->update(['is_active' => ! $airbnb->is_active]);

        return back()->with('status', 'Estado actualizado.');
    }

    private function formData(Airbnb $airbnb): array
    {
        return [
            'airbnb' => $airbnb,
            'zones' => Zone::orderBy('name')->get(),
            'owners' => User::where('role', 'airbnb')->orderBy('name')->get(),
        ];
    }

    private function validatedData(Request $request, ?Airbnb $airbnb = null): array
    {
        $data = $request->validate([
            'zone_id' => ['required', 'exists:zones,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'host' => ['nullable', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:40', 'unique:airbnbs,code,' . ($airbnb?->id ?? 'NULL')],
            'airbnb_url' => ['nullable', 'url', 'max:255'],
            'tower' => ['nullable', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['code'] = strtoupper(trim($data['code']));
        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }
}
