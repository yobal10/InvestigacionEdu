@extends("dashboard.master")
@section("title", $survey ? "Editar encuesta" : "Nueva encuesta")
@section("content")
@php
    $initialQuestions = old('questions', $survey?->questions ?? [['title' => '', 'type' => 'single', 'required' => true, 'options' => []]]);
    $questionTypes = [
        'single' => 'Selección única',
        'multiple' => 'Selección múltiple',
        'text' => 'Texto libre',
        'likert' => 'Escala Likert (1–5)',
        'nps' => 'NPS (0–10)',
        'rating' => 'Estrellas (1–5)',
        'select' => 'Lista desplegable',
        'number' => 'Número',
        'date' => 'Fecha',
    ];
@endphp
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">{{ $survey ? 'Editar encuesta' : 'Crear encuesta' }}</h1>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger"><strong>Revisa el formulario:</strong><ul class="mb-0 mt-2">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ $survey ? route('dashboard.surveys.update', $survey) : route('dashboard.surveys.store') }}" method="POST">
                @csrf
                @if ($survey) @method('PUT') @endif
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input id="title" name="title" class="form-control" value="{{ old('title', $survey?->title) }}" maxlength="150" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción / consentimiento</label>
                            <textarea id="description" name="description" class="form-control" rows="3" maxlength="2000">{{ old('description', $survey?->description) }}</textarea>
                            <small class="form-text text-muted">Explica el propósito y qué datos se recopilan. Las respuestas se guardan anónimamente.</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 mb-0">Preguntas</h2>
                    <button class="btn btn-outline-primary" id="add-question" type="button"><i class="fas fa-plus mr-1"></i> Añadir pregunta</button>
                </div>
                <div id="question-list">
                    @foreach ($initialQuestions as $index => $question)
                        @php
                            $isRequired = old('questions') !== null
                                ? !empty($question['required'])
                                : (bool) ($question['required'] ?? true);
                            $questionOptions = $question['options'] ?? [];
                            $questionOptions = is_array($questionOptions) ? implode("\n", $questionOptions) : $questionOptions;
                        @endphp
                        <div class="card question-card">
                            <div class="card-header d-flex justify-content-between">
                                <strong>Pregunta <span class="question-number">{{ $loop->iteration }}</span></strong>
                                <button class="btn btn-sm btn-outline-danger remove-question" type="button" aria-label="Eliminar pregunta"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Enunciado</label>
                                    <input name="questions[{{ $index }}][title]" class="form-control" value="{{ $question['title'] ?? '' }}" maxlength="500" required>
                                </div>
                                <div class="form-row align-items-end">
                                    <div class="form-group col-md-6">
                                        <label>Tipo de respuesta</label>
                                        <select name="questions[{{ $index }}][type]" class="form-control">
                                            @foreach ($questionTypes as $type => $label)
                                                <option value="{{ $type }}" @selected(($question['type'] ?? 'single') === $type)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input id="required-{{ $index }}" name="questions[{{ $index }}][required]" type="checkbox" class="custom-control-input" value="1" @checked($isRequired)>
                                            <label class="custom-control-label" for="required-{{ $index }}">Respuesta obligatoria</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Opciones (una por línea; para selección única, múltiple o lista)</label>
                                    <textarea name="questions[{{ $index }}][options]" class="form-control" rows="3" placeholder="Opción 1&#10;Opción 2">{{ $questionOptions }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <template id="question-template">
                    <div class="card question-card">
                        <div class="card-header d-flex justify-content-between">
                            <strong>Pregunta <span class="question-number"></span></strong>
                            <button class="btn btn-sm btn-outline-danger remove-question" type="button" aria-label="Eliminar pregunta"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Enunciado</label>
                                <input name="questions[__INDEX__][title]" class="form-control" maxlength="500" required>
                            </div>
                            <div class="form-row align-items-end">
                                <div class="form-group col-md-6">
                                    <label>Tipo de respuesta</label>
                                    <select name="questions[__INDEX__][type]" class="form-control">
                                        @foreach ($questionTypes as $type => $label)
                                            <option value="{{ $type }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="custom-control custom-checkbox">
                                        <input id="required-__INDEX__" name="questions[__INDEX__][required]" type="checkbox" class="custom-control-input" value="1" checked>
                                        <label class="custom-control-label" for="required-__INDEX__">Respuesta obligatoria</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label>Opciones (una por línea; para selección única, múltiple o lista)</label>
                                <textarea name="questions[__INDEX__][options]" class="form-control" rows="3" placeholder="Opción 1&#10;Opción 2"></textarea>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="mb-4">
                    <button class="btn btn-primary" type="submit">Guardar encuesta</button>
                    <a href="{{ route('dashboard.surveys.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
@section("script")
<script>
(() => {
    const list = document.getElementById('question-list');
    const template = document.getElementById('question-template');
    let nextIndex = Math.max(-1, ...Array.from(list.querySelectorAll('[name^="questions["]'))
        .map((field) => Number(field.name.match(/^questions\[(\d+)\]/)?.[1] ?? -1))) + 1;
    const updateNumbers = () => list.querySelectorAll('.question-card').forEach((card, index) => {
        card.querySelector('.question-number').textContent = index + 1;
    });
    document.getElementById('add-question').addEventListener('click', () => {
        const html = template.innerHTML.replaceAll('__INDEX__', String(nextIndex++));
        list.insertAdjacentHTML('beforeend', html);
        updateNumbers();
    });
    list.addEventListener('click', (event) => {
        const button = event.target.closest('.remove-question');
        if (!button) return;
        if (list.querySelectorAll('.question-card').length === 1) {
            alert('La encuesta debe tener al menos una pregunta.');
            return;
        }
        button.closest('.question-card').remove();
        updateNumbers();
    });
    updateNumbers();
})();
</script>
@endsection
