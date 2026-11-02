<?php

namespace Tests\Feature;

use App\Support\SitePublication;
use DOMDocument;
use DOMXPath;
use Tests\TestCase;

class AdSensePreparationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        $this->artisan('migrate', ['--force' => true])->assertExitCode(0);
    }

    private function xpath(string $html): DOMXPath
    {
        $doc = new DOMDocument;
        @$doc->loadHTML('<?xml encoding="utf-8" ?>'.$html);

        return new DOMXPath($doc);
    }

    public function test_information_pages_are_distinct_and_linked_without_placeholders(): void
    {
        $paths = ['/aviso-de-privacidad', '/politica-de-cookies', '/terminos-y-condiciones', '/sobre-nosotros', '/contacto'];
        $titles = $bodies = [];
        foreach ($paths as $path) {
            $response = $this->get($path)->assertOk();
            $xpath = $this->xpath($response->getContent());
            $titles[] = $xpath->evaluate('string(//title)');
            $bodies[] = $xpath->evaluate('string(//article)');
            $this->assertSame(1, $xpath->query('//h1')->length);
            $this->assertSame('https://visitajalisco.mx'.$path, $xpath->evaluate('string(//link[@rel="canonical"]/@href)'));
            $this->assertNotSame('', $xpath->evaluate('string(//meta[@name="description"]/@content)'));
            $response->assertSee('2026-11-01')->assertDontSee('PENDIENTE_DEL_PROPIETARIO')->assertDontSee('[DATOS')->assertDontSee('privacidad@visitajalisco.mx');
            foreach ($paths as $linkedPath) {
                $this->assertGreaterThan(0, $xpath->query('//footer//a[@href="'.$linkedPath.'"]')->length);
            }
        }
        $this->assertCount(5, array_unique($titles));
        $this->assertCount(5, array_unique($bodies));
        $this->get('/contacto')->assertSee('mailto:info@visitajalisco.mx', false)->assertDontSee('<form', false);
        $this->get('/aviso-de-privacidad')->assertSee('alejandro leo')->assertSee('veinte días hábiles')->assertDontSee('<p>Domicilio:', false);
        $this->get('/politica-de-cookies')->assertSee('localStorage')->assertSee('no depende del botón')->assertSee('No se presenta este aviso como una CMP');
    }

    public function test_missing_operator_data_never_publishes_empty_legal_text_or_fake_contact(): void
    {
        config(['site_operator.name' => null, 'site_operator.support_verified' => false]);
        foreach (['/aviso-de-privacidad', '/terminos-y-condiciones', '/contacto'] as $path) {
            $response = $this->get($path)->assertStatus(503)->assertHeader('X-Robots-Tag', 'noindex, follow');
            $response->assertDontSee('mailto:', false)->assertDontSee('Derechos ARCO, limitación y revocación');
        }
        $this->assertNotContains('/contacto', SitePublication::indexableInformationPaths());
    }

    public function test_pending_legal_review_is_honest_and_excluded_from_sitemap(): void
    {
        $this->assertFalse(config('site_operator.legal_reviewed'));
        foreach (['/aviso-de-privacidad', '/terminos-y-condiciones'] as $path) {
            $xpath = $this->xpath($this->get($path)->assertOk()->getContent());
            $this->assertSame('noindex, follow', $xpath->evaluate('string(//meta[@name="robots"]/@content)'));
        }
        $sitemap = $this->get('/sitemap.xml')->assertOk();
        foreach (['/politica-de-cookies', '/sobre-nosotros', '/contacto'] as $path) {
            $sitemap->assertSee('https://visitajalisco.mx'.$path, false);
        }
        $sitemap->assertDontSee('/aviso-de-privacidad')->assertDontSee('/terminos-y-condiciones')->assertDontSee('/estancias/');
    }

    public function test_adsense_loads_once_on_tourism_pages_and_can_be_disabled(): void
    {
        $this->assertSame("google.com, pub-9068723123011153, DIRECT, f08c47fec0942fa0\n", file_get_contents(public_path('ads.txt')));
        $this->assertTrue(config('adsense.enabled'));
        foreach (['/', '/destinos/ajijic'] as $path) {
            $response = $this->get($path)->assertOk();
            $xpath = $this->xpath($response->getContent());
            $this->assertSame(1, $xpath->query('//head/script[contains(@src,"adsbygoogle.js?client=ca-pub-9068723123011153")]')->length);
            $this->assertSame(0, $xpath->query('//meta[@name="google-adsense-account"]')->length);
            $this->assertSame('anonymous', $xpath->evaluate('string(//script[contains(@src,"adsbygoogle.js")]/@crossorigin)'));
        }
        $this->get('/contacto')->assertOk()->assertDontSee('adsbygoogle.js');
        config(['adsense.enabled' => false]);
        $this->get('/')->assertOk()->assertDontSee('adsbygoogle.js')->assertDontSee('google-adsense-account');
        config(['adsense.verification_enabled' => true]);
        $response = $this->get('/')->assertOk();
        $xpath = $this->xpath($response->getContent());
        $this->assertSame(1, $xpath->query('//meta[@name="google-adsense-account"]')->length);
        $response->assertDontSee('adsbygoogle.js');
        config(['adsense.enabled' => true, 'adsense.publisher_id' => 'G-INVALID']);
        $this->get('/')->assertOk()->assertDontSee('adsbygoogle.js')->assertDontSee('google-adsense-account');
        config(['adsense.publisher_id' => 'pub-'.str_repeat('0', 16)]);
        $this->assertNull(SitePublication::adsenseAccount());
    }

    public function test_home_and_login_expose_safe_functional_information_links(): void
    {
        foreach (['/', '/destinos/chapala', '/login'] as $path) {
            $response = $this->get($path)->assertOk();
            $xpath = $this->xpath($response->getContent());
            foreach (['/aviso-de-privacidad', '/politica-de-cookies', '/terminos-y-condiciones', '/sobre-nosotros', '/contacto'] as $link) {
                $this->assertGreaterThan(0, $xpath->query('//footer//a[@href="'.$link.'"]')->length);
            }
        }
        $this->get('/login')->assertDontSee('Usuario inicial:')->assertDontSee('contraseña: password')->assertDontSee('value="admin@', false);
        $this->get('/revision-ruta-inexistente')->assertNotFound();
        $this->get('/')->assertSee('Este aviso no cambia la medición')->assertSee('data-cookie-accept>Entendido', false);
    }
}
