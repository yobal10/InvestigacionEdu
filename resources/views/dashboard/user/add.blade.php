{{-- name username email password role status --}}
@extends('dashboard.master')
@section('title', 'Nuevo Usuario')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nuevo Usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.users.index") }}">Todos los Usuarios</a></li>
                        <li class="breadcrumb-item active">Nuevo Usuario</li>
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
                            <h3 class="card-title">Nuevo Usuario</h3>
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
                            <form action="{{ route("dashboard.users.store") }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese nombre" value="{{ old('name') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Nombre de Usuario</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese nombre de usuario" value="{{ old('username') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese email" value="{{ old('email') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contraseña"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="about">Acerca de</label>
                                            <textarea id="about" name="about" placeholder="Ingrese acerca de" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mx-auto">
                                        <div class="form-group">
                                            <label for="image">Foto de Perfil</label>
                                            <input type="file" class="form-control" id="image" name="profile" accept="image/*"/>
                                            <img id="imagepreview" class="img-fluid img-thumbnail mt-3 d-none"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Rol</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="1">Visitante</option>
                                                <option value="2">Autor</option>
                                                <option value="3">Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Estado</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Crear</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section("script")
<script src="{{ asset("assets/dashboard/plugins/sweetalert2/sweetalert2.all.js") }}"></script>
<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0] && input.files[0].type.includes("image")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagepreview').removeClass("d-none");
                    $('#imagepreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $("#image").val('');
                $('#imagepreview').addClass("d-none");
                Swal.fire({
                    icon: "error",
                    text: "¡Seleccione una imagen válida!"
                });
            }
        }
        $("#image").change(function(){
            readURL(this);
        });
    });
</script>
@endsection
