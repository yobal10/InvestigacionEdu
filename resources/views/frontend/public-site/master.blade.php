<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Recursos para planificar estudios, crear cuestionarios y analizar información con rigor.')">
    <meta name="theme-color" content="#0b2d61">
    <title>@yield('title', 'InvestigacionEdu | Recursos de investigación')</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/public-site.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/public-site-overrides.css') }}">
</head>
<body>
<div class="marketing-site">
    <header class="m-header">
        <div class="m-utility">
            <button type="button" data-search-toggle aria-expanded="false" aria-label="Buscar artículos" title="Buscar artículos">⌕</button>
            <i class="m-sep" aria-hidden="true"></i>
            <a class="m-login" href="{{ route('auth.login') }}">Iniciar sesión</a>
        </div>
        <div class="m-head-content">
            <a class="m-brand" href="{{ route('frontend.home') }}" aria-label="InvestigacionEdu, inicio">
                <span class="m-brand-symbol" aria-hidden="true">IE</span>
                <span>InvestigacionEdu</span>
            </a>
            <button class="m-hamburger" type="button" data-mobile-toggle aria-expanded="false" aria-label="Abrir menú">☰</button>
            <nav class="m-nav" data-mobile-nav aria-label="Navegación principal">
                <a href="{{ url('/inicio') }}">Inicio</a>
                <div class="m-menu-wrap">
                    <button type="button" data-menu-toggle aria-expanded="false">Productos <span class="m-chevron">⌄</span></button>
                    <div class="m-dropdown" hidden>
                        <a href="{{ url('/caracteristicas') }}">Características <span>›</span></a>
                        <a href="{{ url('/soluciones') }}">Soluciones <span>›</span></a>
                        <a href="{{ route('frontend.research.guide') }}">Guía de metodología <span>›</span></a>
                    </div>
                </div>
                <div class="m-menu-wrap">
                    <button type="button" data-menu-toggle aria-expanded="false">Recursos <span class="m-chevron">⌄</span></button>
                    <div class="m-dropdown" hidden>
                        <a href="{{ url('/recursos') }}">Artículos y guías <span>›</span></a>
                        <a href="{{ url('/plantillas') }}">Plantillas <span>›</span></a>
                        <a href="{{ route('frontend.research.guide') }}">Metodología de investigación <span>›</span></a>
                    </div>
                </div>
                <a href="{{ url('/precios') }}">Planes</a>
            </nav>
            <a class="m-register" href="{{ route('auth.signup') }}">REGÍSTRATE</a>
        </div>
        <div class="m-search-drawer" data-search-drawer hidden>
            <label for="m-article-search">Buscar artículos y guías</label>
            <div class="m-search-field">
                <input id="m-article-search" type="search" placeholder="Escribe para buscar…" autocomplete="off">
                <button type="button" data-search-close aria-label="Cerrar búsqueda">×</button>
            </div>
            <div class="m-search-results" data-search-results hidden>
                @foreach(($articles ?? []) as $searchArticle)
                    <a data-search-item data-search-text="{{ strtolower($searchArticle['title'].' '.$searchArticle['excerpt']) }}" href="{{ url('/blog/'.$searchArticle['slug']) }}">{{ $searchArticle['title'] }}</a>
                @endforeach
                <a data-search-item data-search-text="guía metodología investigación tesis" href="{{ route('frontend.research.guide') }}">Guía de metodología de la investigación</a>
                @forelse(($posts ?? []) as $searchPost)
                    <a data-search-item data-search-text="{{ strtolower($searchPost->title.' '.strip_tags($searchPost->content)) }}" href="{{ route('frontend.post', $searchPost->slug) }}">{{ $searchPost->title }}</a>
                @empty
                @endforelse
                <p data-search-empty hidden>No encontramos resultados para esa búsqueda.</p>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="m-footer">
        <div class="m-container m-footer-inner">
            <div>
                <a class="m-brand m-footer-brand" href="{{ route('frontend.home') }}" aria-label="InvestigacionEdu, inicio"><span class="m-brand-symbol" aria-hidden="true">IE</span><span>InvestigacionEdu</span></a>
                <p>Recursos para investigar, preguntar y analizar con criterio.</p>
                <small>El portal público no incluye un constructor ni almacenamiento de respuestas a encuestas.</small>
            </div>
            <div><b>EXPLORAR</b><a href="{{ url('/caracteristicas') }}">Características</a><a href="{{ url('/soluciones') }}">Soluciones</a><a href="{{ url('/precios') }}">Planes</a></div>
            <div><b>RECURSOS</b><a href="{{ url('/recursos') }}">Artículos y guías</a><a href="{{ url('/plantillas') }}">Plantillas</a><a href="{{ route('frontend.research.guide') }}">Guía metodológica</a></div>
        </div>
    </footer>
</div>
<script src="{{ asset('assets/frontend/js/public-site.js') }}" defer></script>
</body>
</html>