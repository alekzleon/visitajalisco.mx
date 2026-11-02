{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>https://visitajalisco.mx/</loc></url>
    @foreach (array_keys(config('destinations')) as $slug)
        <url><loc>https://visitajalisco.mx/destinos/{{ $slug }}</loc></url>
    @endforeach
    @foreach (\App\Support\SitePublication::indexableInformationPaths() as $path)
        <url><loc>https://visitajalisco.mx{{ $path }}</loc></url>
    @endforeach
</urlset>
