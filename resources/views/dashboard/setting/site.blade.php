@extends('dashboard.master')
@section('title', 'Configuración del Sitio')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Configuración del Sitio</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item active">Configuración del Sitio</li>
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
                            <h3 class="card-title">Configuración del Sitio</h3>
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
                            <form action="{{ route("dashboard.settings.site.update") }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <div class="form-group">
                                            <label for="site_title">Título del Sitio</label>
                                            <input type="text" class="form-control" id="site_title" name="site_title" placeholder="Ingrese título del sitio" value="{{ $sitesettings->site_title }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="tagline">Eslogan</label>
                                            <input type="text" class="form-control" id="tagline" name="tagline" placeholder="Ingrese eslogan" value="{{ $sitesettings->tagline }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Descripción</label>
                                            <textarea id="description" name="description" placeholder="Ingrese descripción" class="form-control">{{ $sitesettings->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="logo_dark">Logo Oscuro <span class="font-italic">(Para modo oscuro)</span></label>
                                            <img id="logo_darkpreview" src="{{ asset("uploads/logo/".$sitesettings->logo_dark) }}" class="d-block mb-3 img-fluid img-thumbnail bg-black"/>
                                            <input type="file" class="form-control" id="logo_dark" name="logo_dark" accept="image/*"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="logo_light">Logo Claro <span class="font-italic">(Para modo claro)</span></label>
                                            <img id="logo_lightpreview" src="{{ asset("uploads/logo/".$sitesettings->logo_light) }}" class="d-block mb-3 img-fluid img-thumbnail"/>
                                            <input type="file" class="form-control" id="logo_light" name="logo_light" accept="image/*"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="copyright_text">Texto de Copyright</label>
                                            <textarea id="copyright_text" name="copyright_text" placeholder="Ingrese texto de copyright" class="form-control">{{ $sitesettings->copyright_text }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Actualizar</button>
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
        function readURL(input, preview, image) {
            if (input.files && input.files[0] && input.files[0].type.includes("image")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(preview).removeClass("d-none");
                    $(preview).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $(image).val('');
                $(preview).addClass("d-none");
                Swal.fire({
                    icon: "error",
                    text: "Select a valid image!"
                });
            }
        }
        $("#logo_dark").change(function(){
            readURL(this, "#logo_darkpreview", "#logo_dark");
        });
        $("#logo_light").change(function(){
            readURL(this, "#logo_lightpreview", "#logo_light");
        });
    });
</script>
@endsection
