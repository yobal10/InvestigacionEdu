@extends("dashboard.master")
@section("title", "Encuestas")
@section("content")
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="m-0">Encuestas</h1>
            <a href="{{ route('dashboard.surveys.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Nueva encuesta</a>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="GET" action="{{ route('dashboard.surveys.index') }}" class="form-inline mb-3">
                <label for="survey-search" class="sr-only">Buscar encuestas</label>
                <input id="survey-search" name="q" value="{{ $search }}" class="form-control mr-2" placeholder="Buscar por título o descripción">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
                @if ($search !== '')
                    <a href="{{ route('dashboard.surveys.index') }}" class="btn btn-link">Limpiar</a>
                @endif
            </form>
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Encuesta</th>
                                <th>Estado</th>
                                <th>Preguntas</th>
                                <th>Respuestas</th>
                                <th>Enlace público</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($surveys as $survey)
                                <tr>
                                    <td>
                                        <strong>{{ $survey->title }}</strong>
                                        @if (auth()->user()->role === 3)
                                            <small class="d-block text-muted">Por {{ $survey->user->name }}</small>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-{{ $survey->is_published ? 'success' : 'secondary' }}">{{ $survey->is_published ? 'Publicada' : 'Borrador' }}</span></td>
                                    <td>{{ count($survey->questions ?? []) }}</td>
                                    <td>{{ $survey->responses_count }}</td>
                                    <td>
                                        @if ($survey->is_published)
                                            <a href="{{ route('frontend.surveys.show', $survey->slug) }}" target="_blank" rel="noopener">Abrir <i class="fas fa-external-link-alt"></i></a>
                                        @else
                                            <span class="text-muted">Publica para habilitar</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('dashboard.surveys.responses', $survey) }}" class="btn btn-sm btn-outline-info" title="Respuestas"><i class="fas fa-chart-bar"></i></a>
                                        <a href="{{ route('dashboard.surveys.edit', $survey) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('dashboard.surveys.duplicate', $survey) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-secondary" type="submit" title="Duplicar"><i class="fas fa-copy"></i></button>
                                        </form>
                                        <form action="{{ route('dashboard.surveys.publish', $survey) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-{{ $survey->is_published ? 'warning' : 'success' }}" type="submit">{{ $survey->is_published ? 'Despublicar' : 'Publicar' }}</button>
                                        </form>
                                        <form action="{{ route('dashboard.surveys.destroy', $survey) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta encuesta y todas sus respuestas?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit" title="Eliminar"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center p-4">Todavía no hay encuestas. Crea una para comenzar.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">{{ $surveys->links('vendor.pagination.custom') }}</div>
            </div>
        </div>
    </section>
</div>
@endsection
