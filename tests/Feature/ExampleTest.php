<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\SiteSetting;
use App\Models\User;
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

    public function test_dashboard_uses_its_own_visual_theme_and_keeps_existing_content(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin-panel',
            'email' => 'admin-panel@example.test',
            'password' => 'password',
            'role' => User::IS_ADMIN,
            'status' => true,
        ]);

        $this->actingAs($admin)
            ->get(route('dashboard.home'))
            ->assertOk()
            ->assertSee('dashboard-nexo', false)
            ->assertSee('assets/dashboard/css/investigaedu-panel.css?v=4')
            ->assertSee('dashboard-page-heading', false)
            ->assertSee('dashboard-article-layout', false)
            ->assertSee('dashboard-stat-card', false)
            ->assertSee('data-dashboard-menu', false)
            ->assertSee('aria-label="Resumen del panel"', false)
            ->assertSee('dashboard-resource-card', false)
            ->assertSeeText('Posts')
            ->assertSeeText('Comentarios')
            ->assertSeeText('Usuarios')
            ->assertSeeText('Categorías')
            ->assertSeeText('Encuestas')
            ->assertSeeText('Respuestas')
            ->assertSeeText('Multimedia')
            ->assertSeeText('Etiquetas')
            ->assertSeeText('Páginas')
            ->assertSeeText('Configuración')
            ->assertSeeText('Cerrar Sesión')
            ->assertSee('data-widget="fullscreen"', false)
            ->assertSeeText('Biblioteca metodológica')
            ->assertSeeText('Metodología de la investigación total')
            ->assertSee('assets/metodologia-investigacion-total.png');
    }
}
