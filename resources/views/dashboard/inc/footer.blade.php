<footer class="main-footer">
    <div class="dashboard-footer-inner">
        <div class="dashboard-footer-about">
            <a href="{{ route("frontend.home") }}" class="dashboard-footer-brand">
                <span class="dashboard-brand-mark">N</span>
                <span>{{ config('app.sitesettings')::first()->site_title }}</span>
            </a>
            <p>Copyright &copy; 2022-{{ date("Y") }} <a href="{{ route("frontend.home") }}">{{ config('app.sitesettings')::first()->site_title }}</a>. Todos los derechos reservados.</p>
            <p class="dashboard-footer-version"><strong>Versión</strong> 1.0</p>
        </div>
        <nav class="dashboard-footer-links" aria-label="Enlaces del panel">
            <div>
                <strong>Panel</strong>
                <a href="{{ route("dashboard.home") }}">Resumen</a>
                <a href="{{ route("dashboard.surveys.index") }}">Encuestas y resultados</a>
            </div>
            <div>
                <strong>Cuenta</strong>
                <a href="{{ route("dashboard.settings.profile") }}">Perfil</a>
                <a target="_blank" href="{{ route("frontend.home") }}">Ver sitio</a>
            </div>
        </nav>
    </div>
</footer>
