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
            <section class="dashboard-hero">
                <span class="dashboard-eyebrow">{{ config('app.sitesettings')::first()->site_title }}</span>
                <h1>Panel</h1>
                <p>Resumen de la actividad y los recursos de tu sitio.</p>
            </section>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid dashboard-container">
            <section class="dashboard-metrics" aria-label="Resumen del panel">
                <div class="dashboard-section-heading">
                    <h2>Resumen</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route("dashboard.posts.index") }}" class="small-box bg-info dashboard-stat-card">
                            <span class="dashboard-stat-icon"><i class="fas fa-pencil-alt" aria-hidden="true"></i></span>
                            <span class="inner">
                                <span class="dashboard-stat-label">Posts</span>
                                <strong>{{ $posts }}</strong>
                                <span class="dashboard-stat-action">Más info <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route("dashboard.comments.index") }}" class="small-box bg-success dashboard-stat-card">
                            <span class="dashboard-stat-icon"><i class="fas fa-comment-alt" aria-hidden="true"></i></span>
                            <span class="inner">
                                <span class="dashboard-stat-label">Comentarios</span>
                                <strong>{{ $comments }}</strong>
                                <span class="dashboard-stat-action">Más info <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route("dashboard.users.index") }}" class="small-box bg-warning dashboard-stat-card">
                            <span class="dashboard-stat-icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                            <span class="inner">
                                <span class="dashboard-stat-label">Usuarios</span>
                                <strong>{{ $users }}</strong>
                                <span class="dashboard-stat-action">Más info <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route("dashboard.categories.index") }}" class="small-box bg-danger dashboard-stat-card">
                            <span class="dashboard-stat-icon"><i class="fas fa-th-list" aria-hidden="true"></i></span>
                            <span class="inner">
                                <span class="dashboard-stat-label">Categorías</span>
                                <strong>{{ $categories }}</strong>
                                <span class="dashboard-stat-action">Más info <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route("dashboard.surveys.index") }}" class="small-box bg-primary dashboard-stat-card">
                            <span class="dashboard-stat-icon"><i class="fas fa-poll" aria-hidden="true"></i></span>
                            <span class="inner">
                                <span class="dashboard-stat-label">Encuestas</span>
                                <strong>{{ $surveys }}</strong>
                                <span class="dashboard-stat-action">Administrar encuestas <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route("dashboard.surveys.index") }}" class="small-box bg-secondary dashboard-stat-card">
                            <span class="dashboard-stat-icon"><i class="fas fa-chart-bar" aria-hidden="true"></i></span>
                            <span class="inner">
                                <span class="dashboard-stat-label">Respuestas</span>
                                <strong>{{ $surveyResponses }}</strong>
                                <span class="dashboard-stat-action">Ver resultados <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </section>
            <section class="dashboard-resource-section" aria-label="Biblioteca metodológica">
                <div class="dashboard-section-heading">
                    <h2>Biblioteca metodológica</h2>
                </div>
                <article class="dashboard-resource-card">
                    <img src="{{ asset('assets/metodologia-investigacion-total.png') }}" alt="Portada de Metodología de la investigación total" class="methodology-dashboard-cover">
                    <div>
                        <span class="dashboard-resource-kicker">Biblioteca metodológica</span>
                        <h3>Metodología de la investigación total</h3>
                        <p>Cuantitativa, cualitativa y redacción de tesis. Referencia principal: Humberto Ñaupas Paitán y coautores.</p>
                        <a href="{{ route('frontend.methodology') }}" class="dashboard-text-link">Abrir fórmulas y recursos <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            </section>
        </div>
    </section>
</div>
@endsection
