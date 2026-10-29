@extends("dashboard.master")
@section("title", "Respuestas de encuesta")
@section("content")
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div>
                <h1 class="m-0">Respuestas</h1>
                <p class="text-muted mb-0">{{ $survey->title }} · {{ $survey->responses()->count() }} en total</p>
            </div>
            <div>
                <a href="{{ route('dashboard.surveys.export', $survey) }}" class="btn btn-success"><i class="fas fa-download mr-1"></i> Exportar CSV</a>
                <a href="{{ route('dashboard.surveys.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($questionSummaries as $summary)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>{{ $summary['title'] }}</strong></div>
                            <div class="card-body">
                                <p class="text-muted">Respuestas recibidas: {{ $summary['answered'] }}</p>
                                @if (count($summary['counts']) > 0)
                                    @foreach ($summary['counts'] as $choice => $count)
                                        @php
                                            $percentage = $summary['answered'] > 0 ? round($count / $summary['answered'] * 100) : 0;
                                        @endphp
                                        <div class="d-flex justify-content-between"><span>{{ $choice }}</span><span>{{ $count }}</span></div>
                                        <div class="progress mb-2"><div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div></div>
                                    @endforeach
                                @else
                                    <small class="text-muted">El resumen de texto/número/fecha está disponible en la tabla de respuestas y en el CSV.</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    @forelse ($responses as $response)
                        <article class="border rounded p-3 mb-3">
                            <h2 class="h6">Respuesta #{{ $response->id }} <small class="text-muted">· {{ $response->submitted_at->format('d/m/Y H:i') }}</small></h2>
                            <dl class="row mb-0">
                                @foreach ($survey->questions ?? [] as $index => $question)
                                    @php $answer = ($response->answers ?? [])[$index] ?? null; @endphp
                                    <dt class="col-md-4">{{ $question['title'] }}</dt>
                                    <dd class="col-md-8">{{ is_array($answer) ? implode(', ', $answer) : ($answer ?? '—') }}</dd>
                                @endforeach
                            </dl>
                        </article>
                    @empty
                        <p class="text-center text-muted mb-0">Aún no se han recibido respuestas.</p>
                    @endforelse
                </div>
                <div class="card-footer">{{ $responses->links('vendor.pagination.custom') }}</div>
            </div>
        </div>
    </section>
</div>
@endsection
