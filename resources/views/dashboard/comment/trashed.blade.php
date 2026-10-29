@extends('dashboard.master')
@section('title', 'Comentarios Eliminados')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Comentarios Eliminados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.comments.index') }}">Todos los Comentarios</a></li>
                        <li class="breadcrumb-item active">Comentarios Eliminados</li>
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
                            <h3 class="card-title">Comentarios Eliminados</h3>
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
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Comentarista</th>
                                            <th class="text-center">Tipo</th>
                                            <th class="text-center">Post</th>
                                            <th class="text-center">Comentario</th>
                                            <th class="text-center">Enviado el</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($comments as $comment)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + $comments->firstItem() }}</td>
                                            <td>{{ $comment->user ? $comment->user->name : $comment->name }}</td>
                                            <td class="text-center"><span class="badge bg-{{ $comment->user ? "success" : "warning" }}">{{ $comment->user ? "Usuario" : "Invitado" }}</span></td>
                                            <td class="text-center">{{ $comment->post->title ?? "Eliminado" }}</td>
                                            <td class="text-center">{{ $comment->message }}</td>
                                            <td class="text-center">
                                                <div>{{ $comment->created_at->format("d M, Y") }}</div>
                                                <div>{{ $comment->created_at->format("h:i:s A") }}</div>
                                            </td>
                                            <td class="text-center"><span class="badge bg-{{ $comment->status ? "success" : "warning" }}">{{ $comment->status ? "Publicado" : "Pendiente" }}</span></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route("dashboard.comments.restore", $comment->id) }}" class="btn btn-success">Restaurar</a>
                                                    <form action="{{ route("dashboard.comments.delete", $comment->id) }}" method="POST">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger deletebtn">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">¡No se encontraron comentarios!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                            {{ $comments->links() }}
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
<script>
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
