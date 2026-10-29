<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            "name" => "Admin",
            "username" => "admin",
            "email" => "admin@example.com",
            "role" => 3,
            "password" => "123456789",
        ]);

        // \App\Models\Category::create([
        //     "title" => "Uncategorized",
        //     "slug" => "uncategorized",
        // ]);

        \App\Models\SiteSetting::create([
            "site_title" => "Mi Página Web",
            "tagline" => "Laravel Blog",
            "description" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro tenetur non laudantium! Autem, similique. Error quidem sequi adipisci, voluptatem sunt possimus cum. Nisi, nobis quia! Odio, vel similique. Corrupti, a!",
            "logo_dark" => "logo_dark.png",
            "logo_light" => "logo_light.png",
            "copyright_text" => "© 2026, Mi Página Web, Todos los derechos reservados.",
            "enable_registration" => "1",
        ]);

        \App\Models\Menu::create([
            "header_menu" => json_encode([["href"=>"http://localhost/","icon"=>"","text"=>"Home","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"Acerca de","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"Contacto","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"Política de Privacidad","tooltip"=>"","children"=>[]]]),
            "footer_menu" => json_encode([["href"=>"http://localhost/","icon"=>"","text"=>"Home","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"Acerca de","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"Contacto","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"Política de Privacidad","tooltip"=>"","children"=>[]]]),
        ]);
    }
}
