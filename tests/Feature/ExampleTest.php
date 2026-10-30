<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        SiteSetting::create([
            'site_title' => 'Sitio de prueba',
            'tagline' => 'Pruebas',
            'description' => 'Sitio de prueba',
            'logo_dark' => 'logo.png',
            'logo_light' => 'logo.png',
            'copyright_text' => 'Prueba',
            'enable_registration' => true,
        ]);
        Menu::create([
            'header_menu' => json_encode([]),
            'footer_menu' => json_encode([]),
        ]);
    }

    public function test_the_homepage_displays_the_public_portal(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSeeText('Investiga, pregunta y comprende tus resultados');
    }

    public function test_research_guide_and_public_article_are_available(): void
    {
        $this->get('/guia-de-investigacion')->assertOk();
        $this->get('/blog/metodologia-de-estudios-online')
            ->assertOk()
            ->assertSeeText('Metodología de estudios online')
            ->assertSee('m-alt-hero-book')
            ->assertSee('assets/metodologia-investigacion-total.png');
    }
}
