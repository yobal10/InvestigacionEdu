@extends("frontend.master")
@section("title", $survey->title)
@section("style")
<style>
    .public-survey { padding: 125px 0 70px; min-height: 80vh; background: #f5f7fb; }
    .public-survey-card { max-width: 820px; margin: auto; padding: 32px; border-radius: 14px; background: #fff; box-shadow: 0 10px 35px rgba(20, 43, 74, .08); }
    .public-survey-card h1 { color: #172a46; }
    .public-question { padding: 20px 0; border-top: 1px solid #e8edf4; }
    .public-question legend { width: auto; font-size: 1.05rem; font-weight: 600; }
    .public-question .form-check { margin: 8px 0; }
    @media (max-width: 760px) { .public-survey-card { padding: 22px; } }
</style>
@endsection
@section("content")
<main class="public-survey">
    <div class="container">
        <section class="public-survey-card">
            @if (session('success'))
                <div class="alert alert-success" role="status">{{ session('success') }}</div>
            @endif
            <span class="methodology-eyebrow">Encuesta</span>
            <h1>{{ $survey->title }}</h1>
            @if ($survey->description)
                <p class="text-muted">{{ $survey->description }}</p>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">No se pudo enviar. Revisa las respuestas marcadas e inténtalo nuevamente.</div>
            @endif
            @if (session('success'))
                <p>Tu participación ha sido registrada. Puedes cerrar esta página.</p>
            @else
                <form action="{{ route('frontend.surveys.submit', $survey->slug) }}" method="POST">
                    @csrf
                    @foreach ($survey->questions ?? [] as $index => $question)
                        @php
                            $type = $question['type'] ?? 'text';
                            $oldMultipleAnswers = old("answers.$index", []);
                            $oldMultipleAnswers = is_array($oldMultipleAnswers) ? $oldMultipleAnswers : [];
                            $choices = match ($type) {
                                'likert', 'rating' => ['1', '2', '3', '4', '5'],
                                'nps' => range(0, 10),
                                default => $question['options'] ?? [],
                            };
                            $required = !empty($question['required']);
                        @endphp
                        <fieldset class="public-question">
                            <legend>{{ $loop->iteration }}. {{ $question['title'] }} @if($required)<span class="text-danger" aria-label="obligatoria">*</span>@endif</legend>
                            @if ($type === 'text')
                                <textarea name="answers[{{ $index }}]" class="form-control" rows="3" maxlength="10000" @required($required)>{{ old("answers.$index") }}</textarea>
                            @elseif ($type === 'number')
                                <input type="number" step="any" name="answers[{{ $index }}]" class="form-control" value="{{ old("answers.$index") }}" @required($required)>
                            @elseif ($type === 'date')
                                <input type="date" name="answers[{{ $index }}]" class="form-control" value="{{ old("answers.$index") }}" @required($required)>
                            @elseif ($type === 'select')
                                <select name="answers[{{ $index }}]" class="form-control" @required($required)>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($choices as $choice)
                                        <option value="{{ $choice }}" @selected(old("answers.$index") == $choice)>{{ $choice }}</option>
                                    @endforeach
                                </select>
                            @elseif (in_array($type, ['single', 'likert', 'nps', 'rating'], true))
                                @foreach ($choices as $choice)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[{{ $index }}]" id="answer-{{ $index }}-{{ $loop->index }}" value="{{ $choice }}" @checked(old("answers.$index") == $choice) @required($required && $loop->first)>
                                        <label class="form-check-label" for="answer-{{ $index }}-{{ $loop->index }}">{{ $choice }}@if($type === 'rating') ★@endif</label>
                                    </div>
                                @endforeach
                            @elseif ($type === 'multiple')
                                @foreach ($choices as $choice)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="answers[{{ $index }}][]" id="answer-{{ $index }}-{{ $loop->index }}" value="{{ $choice }}" @checked(in_array($choice, $oldMultipleAnswers, true))>
                                        <label class="form-check-label" for="answer-{{ $index }}-{{ $loop->index }}">{{ $choice }}</label>
                                    </div>
                                @endforeach
                            @endif
                            @error("answers.$index")<small class="text-danger d-block">{{ $message }}</small>@enderror
                        </fieldset>
                    @endforeach
                    <button type="submit" class="btn btn-primary btn-lg">Enviar respuestas</button>
                </form>
            @endif
        </section>
    </div>
</main>
@endsection
