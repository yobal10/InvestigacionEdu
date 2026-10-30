@extends("dashboard.master")
@section("title", "Panel")
@section("content")
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid dashboard-container">
            <ol class="breadcrumb dashboard-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Inicio</a></li>
                <li class="breadcrumb-item active">Panel</li>
            </ol>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid dashboard-container">
            <div class="dashboard-article-layout">
                <main class="dashboard-article-main">
                    <header class="dashboard-page-heading">
                        <h1>Panel</h1>
                        <p>Resumen de la actividad y los recursos de tu sitio.</p>
                    </header>
                    <figure class="dashboard-feature-image">
                        <img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt="Ilustración de análisis de datos con gráficos y resultados">
                        <figcaption>Encuestas</figcaption>
                    </figure>
                    <section class="dashboard-metrics" aria-label="Resumen del panel">
                        <div class="dashboard-section-heading">
                            <h2>Resumen</h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route("dashboard.posts.index") }}" class="small-box bg-info dashboard-stat-card">
                                    <img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt="" class="dashboard-stat-image">
                                    <span class="inner">
                                        <span class="dashboard-stat-label">Posts</span>
                                        <strong>{{ $posts }}</strong>
                                        <span class="dashboard-stat-action">Más info <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                                    </span>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route("dashboard.comments.index") }}" class="small-box bg-success dashboard-stat-card">
                                    <img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt="" class="dashboard-stat-image">
                                    <span class="inner">
                                        <span class="dashboard-stat-label">Comentarios</span>
                                        <strong>{{ $comments }}</strong>
                                        <span class="dashboard-stat-action">Más info <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                                    </span>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route("dashboard.users.index") }}" class="small-box bg-warning dashboard-stat-card">
                                    <img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt="" class="dashboard-stat-image">
                                    <span class="inner">
                                        <span class="dashboard-stat-label">Usuarios</span>
                                        <strong>{{ $users }}</strong>
                                        <span class="dashboard-stat-action">Más info <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                                    </span>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route("dashboard.categories.index") }}" class="small-box bg-danger dashboard-stat-card">
                                    <img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt="" class="dashboard-stat-image">
                                    <span class="inner">
                                        <span class="dashboard-stat-label">Categorías</span>
                                        <strong>{{ $categories }}</strong>
                                        <span class="dashboard-stat-action">Más info <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                                    </span>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route("dashboard.surveys.index") }}" class="small-box bg-primary dashboard-stat-card">
                                    <img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt="" class="dashboard-stat-image">
                                    <span class="inner">
                                        <span class="dashboard-stat-label">Encuestas</span>
                                        <strong>{{ $surveys }}</strong>
                                        <span class="dashboard-stat-action">Administrar encuestas <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                                    </span>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route("dashboard.surveys.index") }}" class="small-box bg-secondary dashboard-stat-card">
                                    <img src="{{ asset('assets/frontend/images/imagen-estudio.svg') }}" alt="" class="dashboard-stat-image">
                                    <span class="inner">
                                        <span class="dashboard-stat-label">Respuestas</span>
                                        <strong>{{ $surveyResponses }}</strong>
                                        <span class="dashboard-stat-action">Ver resultados <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </section>
                </main>
                <aside class="dashboard-article-sidebar">
                    <article class="dashboard-resource-card">
                        <span class="dashboard-resource-kicker">Biblioteca metodológica</span>
                        <img src="{{ asset('assets/metodologia-investigacion-total.png') }}" alt="Portada de Metodología de la investigación total" class="methodology-dashboard-cover">
                        <h2>Metodología de la investigación total</h2>
                        <p>Cuantitativa, cualitativa y redacción de tesis. Referencia principal: Humberto Ñaupas Paitán y coautores.</p>
                        <a href="{{ route('frontend.methodology') }}" class="dashboard-resource-button">Abrir fórmulas y recursos</a>
                    </article>
                    <section class="dashboard-quick-links">
                        <h2>Encuestas y resultados</h2>
                        <a href="{{ route('dashboard.surveys.index') }}">Administrar encuestas <span aria-hidden="true">→</span></a>
                        <a href="{{ route('dashboard.surveys.index') }}">Ver resultados <span aria-hidden="true">→</span></a>
                    </section>
                </aside>
            </div>
        </div>
    </section>
</div>
@endsection
