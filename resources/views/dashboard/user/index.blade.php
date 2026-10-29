@extends('dashboard.master')
@section('title', 'Todos los Usuarios')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Todos los Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Todos los Usuarios</li>
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
                            <h3 class="card-title">Todos los Usuarios</h3>
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
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Perfil</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Rol</th>
                                            <th class="text-center">Cant. Posts</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + $users->firstItem() }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td class="text-center">
                                                <img class="rounded rounded-circle" width="70px" height="70px" src="{{ asset("uploads/author/".($user->profile ?? "default.webp")) }}" alt="{{ $user->name }}"/>
                                            </td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">
                                                @if ($user->role == 3)
                                                <span class="badge bg-success">Admin</span>
                                                @elseif ($user->role == 2)
                                                <span class="badge bg-cyan">Autor</span>
                                                @elseif ($user->role == 1)
                                                <span class="badge bg-warning">Visitante</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $user->posts_count }}</td>
                                            <td class="text-center"><a href="{{ route("dashboard.users.status", $user->id) }}"><span class="badge bg-{{ $user->status ? "success" : "danger" }}">{{ $user->status ? "Activo" : "Inactivo" }}</span></a></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a target="_blank" href="{{ $user->status ? route("frontend.user", $user->username) : "" }}" class="btn btn-success {{ $user->status ? "" : " disabled" }}">Ver</a>
                                                    <a href="{{ route("dashboard.users.edit", $user->id) }}" class="btn btn-warning">Editar</a>
                                                    <form action="{{ route("dashboard.users.destroy", $user->id) }}" method="POST">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger deletebtn">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">¡No se encontraron usuarios!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                            {{ $users->links() }}
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
        text: '¡Todos los posts de este usuario se eliminarán permanentemente!',
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
