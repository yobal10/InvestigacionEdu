@extends("dashboard.master")
@section("title", "Panel")
@section("content")
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Panel</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $posts }}</h3>
                            <p>Posts</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <a href="{{ route("dashboard.posts.index") }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $comments }}</h3>
                            <p>Comentarios</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <a href="{{ route("dashboard.comments.index") }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $users }}</h3>
                            <p>Usuarios</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route("dashboard.users.index") }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $categories }}</h3>
                            <p>Categorías</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-th-list"></i>
                        </div>
                        <a href="{{ route("dashboard.categories.index") }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $surveys }}</h3>
                            <p>Encuestas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-poll"></i>
                        </div>
                        <a href="{{ route("dashboard.surveys.index") }}" class="small-box-footer">Administrar encuestas <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $surveyResponses }}</h3>
                            <p>Respuestas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <a href="{{ route("dashboard.surveys.index") }}" class="small-box-footer">Ver resultados <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="card mt-3 methodology-dashboard-card">
                <div class="card-body d-md-flex align-items-center">
                    <img src="{{ asset('assets/metodologia-investigacion-total.png') }}" alt="Portada de Metodología de la investigación total" class="methodology-dashboard-cover mr-md-4 mb-3 mb-md-0">
                    <div>
                        <span class="text-uppercase text-muted font-weight-bold">Biblioteca metodológica</span>
                        <h2 class="h4 mt-2">Metodología de la investigación total</h2>
                        <p class="mb-1">Cuantitativa, cualitativa y redacción de tesis. Referencia principal: Humberto Ñaupas Paitán y coautores.</p>
                        <a href="{{ route('frontend.methodology') }}" class="btn btn-primary mt-2">Abrir fórmulas y recursos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
