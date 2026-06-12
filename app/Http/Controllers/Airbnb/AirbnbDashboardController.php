<?php

namespace App\Http\Controllers\Airbnb;

use App\Http\Controllers\Controller;
use App\Models\Airbnb;
use App\Support\PublicUpload;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AirbnbDashboardController extends Controller
{
    public function index(Request $request): View
    {
        return view('airbnb.index', [
            'airbnbs' => Airbnb::with('zone')
                ->where('user_id', $request->user()->id)
                ->latest()
                ->get(),
        ]);
    }

    public function edit(Request $request, Airbnb $airbnb): View
    {
        abort_unless($airbnb->user_id === $request->user()->id, 403);

        return view('airbnb.form', ['airbnb' => $airbnb->load('zone')]);
    }

    public function update(Request $request, Airbnb $airbnb): RedirectResponse
    {
        abort_unless($airbnb->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'host' => ['nullable', 'string', 'max:255'],
            'airbnb_url' => ['nullable', 'url', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'gallery_images' => ['nullable', 'array', 'max:5'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
        ], [
            'gallery_images.max' => 'La galería permite máximo 5 imágenes.',
            'gallery_images.*.image' => 'Cada archivo de la galería debe ser una imagen válida.',
            'gallery_images.*.mimes' => 'Cada imagen de la galería debe ser JPG, PNG, WEBP, GIF o SVG.',
            'gallery_images.*.max' => 'Cada imagen de la galería debe pesar máximo 4 MB.',
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach ($airbnb->gallery_images ?? [] as $image) {
                PublicUpload::delete($image);
            }

            $data['gallery_images'] = collect($request->file('gallery_images'))
                ->take(5)
                ->map(fn ($image) => PublicUpload::store($image, 'airbnbs'))
                ->values()
                ->all();
        } else {
            unset($data['gallery_images']);
        }

        $airbnb->update($data);

        return redirect()->route('airbnb.dashboard')->with('status', 'Airbnb actualizado.');
    }

    public function qr(Request $request, Airbnb $airbnb): Response
    {
        abort_unless($airbnb->user_id === $request->user()->id, 403);

        $writer = new Writer(new ImageRenderer(
            new RendererStyle(720, 32),
            new SvgImageBackEnd(),
        ));

        return response($writer->writeString(route('stays.show', $airbnb->code)), 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'inline; filename="qr-' . strtolower($airbnb->code) . '.svg"',
        ]);
    }

    public function downloadQr(Request $request, Airbnb $airbnb): Response
    {
        abort_unless($airbnb->user_id === $request->user()->id, 403);

        $writer = new Writer(new ImageRenderer(
            new RendererStyle(720, 32),
            new SvgImageBackEnd(),
        ));

        return response($writer->writeString(route('stays.show', $airbnb->code)), 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="qr-' . strtolower($airbnb->code) . '.svg"',
        ]);
    }

    public function printQr(Request $request, Airbnb $airbnb): View
    {
        abort_unless($airbnb->user_id === $request->user()->id, 403);

        return view('airbnb.qr-print', [
            'airbnb' => $airbnb,
            'publicUrl' => route('stays.show', $airbnb->code),
        ]);
    }
}
