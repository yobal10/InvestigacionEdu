<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <a href="{{ route("dashboard.home") }}" class="navbar-brand dashboard-brand">
        <span class="dashboard-brand-mark">N</span>
        <span>{{ config('app.sitesettings')::first()->site_title }}</span>
    </a>
    <div class="dashboard-header-links">
        <a href="{{ route("dashboard.home") }}" class="dashboard-header-link">Panel</a>
        <a href="{{ route("dashboard.surveys.index") }}" class="dashboard-header-link">Encuestas</a>
        <a target="_blank" href="{{ route("frontend.home") }}" class="dashboard-header-link">Ver sitio</a>
        <a target="_blank" href="{{ route("frontend.user", auth()->user()->username) }}" class="dashboard-header-link">Perfil</a>
    </div>
    <button class="dashboard-fullscreen-toggle" type="button" data-widget="fullscreen" aria-label="Pantalla completa" title="Pantalla completa">
        <i class="fas fa-expand-arrows-alt" aria-hidden="true"></i>
    </button>
    <button class="dashboard-menu-toggle" type="button" data-dashboard-menu aria-controls="dashboard-navigation" aria-expanded="false">
        <i class="fas fa-bars" aria-hidden="true"></i>
        <span>Menú</span>
    </button>
</nav>
