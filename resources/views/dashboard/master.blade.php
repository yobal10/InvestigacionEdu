<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield("title") - {{ config('app.sitesettings')::first()->site_title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/fontawesome-free/css/all.min.css") }}"/>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/jqvmap/jqvmap.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/dist/css/adminlte.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/daterangepicker/daterangepicker.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/summernote/summernote-bs4.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("assets/dashboard/css/investigaedu-panel.css") }}?v=4"/>
    @yield("style")
</head>
<body class="hold-transition dashboard-nexo">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <span class="fa-2x brand-text font-weight-bold px-2">{{ config('app.sitesettings')::first()->site_title }}</span>
        </div>
        @include("dashboard.inc.navbar")
        @include("dashboard.inc.sidebar")
        <button class="dashboard-menu-overlay" type="button" data-dashboard-menu-close aria-label="Cerrar menú"></button>
        @yield("content")
        @include("dashboard.inc.footer")
    </div>
    <script src="{{ asset("assets/dashboard/plugins/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset("assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/chart.js/Chart.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/sparklines/sparkline.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/jqvmap/jquery.vmap.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/jquery-knob/jquery.knob.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/moment/moment.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/daterangepicker/daterangepicker.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/summernote/summernote-bs4.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
    <script src="{{ asset("assets/dashboard/dist/js/adminlte.js") }}"></script>
    <script>
        (() => {
            const body = document.body;
            const toggle = document.querySelector("[data-dashboard-menu]");
            const close = document.querySelector("[data-dashboard-menu-close]");

            const setMenuOpen = (isOpen) => {
                body.classList.toggle("dashboard-menu-open", isOpen);
                toggle.setAttribute("aria-expanded", String(isOpen));
            };

            toggle.addEventListener("click", () => {
                setMenuOpen(!body.classList.contains("dashboard-menu-open"));
            });
            close.addEventListener("click", () => setMenuOpen(false));
            document.querySelectorAll(".main-sidebar a").forEach((link) => {
                link.addEventListener("click", () => {
                    if (link.getAttribute("href") !== "#") setMenuOpen(false);
                });
            });
            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape") setMenuOpen(false);
            });
        })();
    </script>
    @yield("script")
</body>
</html>
