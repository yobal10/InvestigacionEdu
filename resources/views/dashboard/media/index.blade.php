@extends('dashboard.master')
@section('title', 'Todos los Medios')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Todos los Medios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Todos los Medios</li>
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
                            <h3 class="card-title">Todos los Medios</h3>
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
                            <div class="row">
                                @forelse ($media as $item)
                                <div class="col-md-3 mx-auto border p-1 d-flex flex-column justify-content-between">
                                    <div class="image">
                                        <img class="img-fluid" src="{{ asset("uploads/media/".$item->file_name) }}"/>
                                    </div>
                                    <div class="image-footer d-flex justify-content-center text-center mt-2">
                                        <button class="btn btn-primary copybtn" data-clipboard-text="{{ asset("uploads/media/".$item->file_name) }}">Copiar Enlace</button>
                                        <form action="{{ route("dashboard.media.destroy", $item->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger deletebtn">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-danger w-100">¡No se encontraron medios!</div>
                                @endforelse
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                            {{ $media->links() }}
                            </ul>
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
<script src="{{ asset("assets/dashboard/plugins/clipboardjs/clipboard.min.js") }}"></script>
<script>
    var clipboard = new ClipboardJS('.copybtn');
    clipboard.on('success', function(e) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({
            icon: 'success',
            title: '¡Enlace copiado al portapapeles!'
        });
    });
    $('.deletebtn').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
    Swal.fire({
        title: '¿Estás seguro?',
        type: 'warning',
        icon: 'warning',
        text: '¡No podrás revertir esto!',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
    });
</script>
@endsection
