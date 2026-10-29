@extends('dashboard.master')
@section('title', 'Cambiar Contraseña')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cambiar Contraseña</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item active">Cambiar Contraseña</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cambiar Contraseña</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> ¡Error!</h5>
                                @foreach ($errors->all() as $error)
                                <p class="m-0">{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif
                            @if (session("success"))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                                <p class="m-0">{{ session("success") }}</p>
                            </div>
                            @endif
                            <form action="{{ route("dashboard.settings.password.update") }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <div class="form-group">
                                            <label for="current_password">Contraseña Actual</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Ingrese contraseña actual"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password">Nueva Contraseña</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Ingrese nueva contraseña"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password_confirmation">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Ingrese confirmación de contraseña"/>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Cambiar Contraseña</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
