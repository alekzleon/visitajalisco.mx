<?php

namespace Tests\Feature;

use App\Models\Airbnb;
use App\Models\Business;
use App\Models\PremiumService;
use App\Models\PublicAd;
use App\Models\Zone;
use DOMDocument;
use DOMXPath;
use Tests\TestCase;

class TourismSeoTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Nunca usar la base comercial para estas pruebas.
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        $this->artisan('migrate', ['--force' => true])->assertExitCode(0);
    }

    private function document(string $html): DOMXPath
    {
        $document = new DOMDocument;
        @$document->loadHTML('<?xml encoding="utf-8" ?>' . $html);

        return new DOMXPath($document);
    }

    public function test_all_ten_guides_have_visible_content_unique_metadata_and_valid_schema(): void
    {
        $titles = $descriptions = [];
        $this->assertCount(10, config('destinations'));
        foreach (config('destinations') as $slug => $destination) {
            $response = $this->get('/destinos/' . $slug)->assertOk();
            $xpath = $this->document($response->getContent());
            $this->assertSame(1, $xpath->query('//h1')->length);
            $titles[] = $xpath->evaluate('string(//title)');
            $descriptions[] = $xpath->evaluate('string(//meta[@name="description"]/@content)');
            $this->assertSame('https://visitajalisco.mx/destinos/' . $slug, $xpath->evaluate('string(//link[@rel="canonical"]/@href)'));
            $this->assertStringContainsString('index, follow', $xpath->evaluate('string(//meta[@name="robots"]/@content)'));
            $this->assertSame($destination['intro'], trim($xpath->evaluate('string(//p[@class="destination-intro"])')));
            $this->assertGreaterThanOrEqual(3, $xpath->query('//section[@aria-labelledby="visitar"]/h3')->length);
            $schema = json_decode($xpath->evaluate('string(//script[@type="application/ld+json"])'), true, 512, JSON_THROW_ON_ERROR);
            $this->assertSame('TouristDestination', $schema['@graph'][0]['@type']);
            $this->assertSame($destination['description'], $schema['@graph'][0]['description']);
            $this->assertSame('BreadcrumbList', $schema['@graph'][1]['@type']);
            $this->assertFileExists(public_path('assets/img/destinos/' . $destination['image']));
            if ($destination['optimized_image']) {
                $this->assertFileExists(public_path('assets/img/destinos/optimized/' . $destination['optimized_image']));
            }
            foreach ($destination['related'] as $related) {
                $this->assertArrayHasKey($related, config('destinations'));
                $response->assertSee('/destinos/' . $related, false);
            }
        }
        $this->assertCount(10, array_unique($titles));
        $this->assertCount(10, array_unique($descriptions));
    }

    public function test_unknown_and_malformed_destinations_are_not_indexable_pages(): void
    {
        $this->get('/destinos/desconocido')->assertNotFound();
        $this->get('/destinos/tequila.extra')->assertNotFound();
        $this->get('/destinos/TEQUILA')->assertNotFound();
    }

    public function test_sitemap_contains_guides_and_published_information_without_pending_legal_pages(): void
    {
        $response = $this->get('/sitemap.xml')->assertOk();
        $this->assertStringStartsWith('application/xml', $response->headers->get('Content-Type'));
        $xml = simplexml_load_string($response->getContent());
        $this->assertNotFalse($xml);
        $urls = array_map(fn ($url) => (string) $url->loc, iterator_to_array($xml->url, false));
        $this->assertCount(14, $urls);
        $this->assertCount(14, array_unique($urls));
        $this->assertContains('https://visitajalisco.mx/', $urls);
        foreach (array_keys(config('destinations')) as $slug) {
            $this->assertContains('https://visitajalisco.mx/destinos/' . $slug, $urls);
        }
        $this->assertStringNotContainsString('<lastmod>', $response->getContent());
        $this->assertStringContainsString('Sitemap: https://visitajalisco.mx/sitemap.xml', file_get_contents(public_path('robots.txt')));
    }

    public function test_home_preserves_navigation_forms_and_carousel_and_links_to_every_guide(): void
    {
        $response = $this->get('/')->assertOk();
        $xpath = $this->document($response->getContent());
        $this->assertSame(1, $xpath->query('//h1')->length);
        $this->assertSame(10, $xpath->query('//a[@class="place-card"]')->length);
        foreach (['inicio', 'destinos', 'rutas', 'locales', 'contacto'] as $anchor) {
            $this->assertSame(1, $xpath->query('//*[@id="' . $anchor . '"]')->length);
        }
        $response->assertSee('data-places-track', false)->assertSee('data-places-prev', false)->assertSee('data-places-next', false);
        $this->assertSame(1, $xpath->query('//form[@method="POST"]//input[@name="code"]')->length);
        foreach (array_keys(config('destinations')) as $slug) {
            $response->assertSee('href="/destinos/' . $slug . '"', false);
        }
        $schema = json_decode($xpath->evaluate('string(//script[@type="application/ld+json"])'), true, 512, JSON_THROW_ON_ERROR);
        $this->assertSame('WebSite', $schema['@type']);
    }

    public function test_existing_code_lookup_and_stay_route_keep_their_contract(): void
    {
        $zone = Zone::create(['name' => 'Zona de prueba', 'slug' => 'prueba', 'is_active' => true]);
        Airbnb::create(['zone_id' => $zone->id, 'name' => 'Estancia de prueba', 'code' => 'SEO-TEST', 'is_active' => true]);
        $this->post('/codigo-airbnb', ['code' => ' seo-test '])->assertRedirect('/estancias/SEO-TEST');
        $this->get('/estancias/SEO-TEST')->assertOk()->assertSee('Estancia de prueba');
        $this->from('/')->post('/codigo-airbnb', ['code' => 'NO-EXISTE'])->assertRedirect('/')->assertSessionHasErrors('code');
        $this->get('/estancias/NO-EXISTE')->assertNotFound();
        $this->get('/track/destinos/tequila')->assertRedirect('/#destinos');
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/aviso-de-privacidad')->assertOk()->assertSee('id="cookies"', false)->assertSee('id="terminos"', false);
    }
    public function test_existing_commercial_links_keep_their_redirects(): void
    {
        $zone = Zone::create(['name' => 'Zona de prueba', 'slug' => 'prueba', 'is_active' => true]);
        $business = Business::create(['zone_id' => $zone->id, 'name' => 'Negocio de prueba', 'whatsapp' => '523300000000', 'maps_url' => 'https://example.com/mapa', 'is_active' => true]);
        $service = PremiumService::create(['title' => 'Servicio de prueba', 'image_url' => 'assets/img/public-ad-placeholder.svg', 'link_url' => 'https://example.com/servicio', 'whatsapp' => '523300000001', 'is_active' => true]);
        $ad = PublicAd::create(['title' => 'Anuncio de prueba', 'image_url' => 'assets/img/public-ad-placeholder.svg', 'link_url' => 'https://example.com/visita', 'is_active' => true]);
        $airbnb = Airbnb::create(['zone_id' => $zone->id, 'name' => 'Estancia de prueba', 'code' => 'LINK-TEST', 'airbnb_url' => 'https://example.com/reserva', 'is_active' => true]);
        $this->get('/')->assertOk()->assertSee('Servicio de prueba')->assertSee('Anuncio de prueba')->assertSee('Estancia de prueba');
        $this->get('/track/negocios/' . $business->id . '/whatsapp')->assertRedirect('https://wa.me/523300000000');
        $this->get('/track/negocios/' . $business->id . '/como-llegar')->assertRedirect('https://example.com/mapa');
        $this->get('/track/servicios/' . $service->id . '/whatsapp')->assertRedirect('https://wa.me/523300000001');
        $this->get('/track/publicidad/' . $ad->id)->assertRedirect('https://example.com/visita');
        $this->get('/track/airbnbs/' . $airbnb->id . '/reservar')->assertRedirect('https://example.com/reserva');
    }

}
