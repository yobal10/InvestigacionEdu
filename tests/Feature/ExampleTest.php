<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
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

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
