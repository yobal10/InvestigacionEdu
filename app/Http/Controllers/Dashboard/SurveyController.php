<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    private const QUESTION_TYPES = [
        'single',
        'multiple',
        'text',
        'likert',
        'nps',
        'rating',
        'select',
        'number',
        'date',
    ];

    public function index()
    {
        $search = trim((string) request()->query('q', ''));
        $surveys = Survey::query()
            ->when(auth()->user()->role !== 3, fn ($query) => $query->where('user_id', auth()->id()))
            ->when($search !== '', fn ($query) => $query->where(function ($nested) use ($search) {
                $nested->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            }))
            ->with('user')
            ->withCount('responses')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('dashboard.surveys.index', compact('surveys', 'search'));
    }

    public function create()
    {
        return view('dashboard.surveys.form', ['survey' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedSurvey($request);
        $survey = Survey::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'slug' => $this->uniqueSlug($data['title']),
            'description' => $data['description'] ?? null,
            'questions' => $data['questions'],
        ]);

        return redirect()->route('dashboard.surveys.edit', $survey)->with('success', 'Encuesta creada. Ya puedes publicarla.');
    }

    public function edit(int $id)
    {
        $survey = $this->findOwnedSurvey($id);

        return view('dashboard.surveys.form', compact('survey'));
    }

    public function update(Request $request, int $id)
    {
        $survey = $this->findOwnedSurvey($id);
        $data = $this->validatedSurvey($request);
        $survey->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'questions' => $data['questions'],
        ]);

        return redirect()->route('dashboard.surveys.edit', $survey)->with('success', 'Encuesta actualizada.');
    }

    public function destroy(int $id)
    {
        $this->findOwnedSurvey($id)->delete();

        return redirect()->route('dashboard.surveys.index')->with('success', 'Encuesta y sus respuestas eliminadas.');
    }

    public function publish(int $id)
    {
        $survey = $this->findOwnedSurvey($id);
        $survey->is_published = ! $survey->is_published;
        $survey->save();

        return back()->with('success', $survey->is_published ? 'Encuesta publicada.' : 'Encuesta despublicada.');
    }

    public function duplicate(int $id)
    {
        $survey = $this->findOwnedSurvey($id);
        $copy = $survey->replicate(['slug', 'is_published']);
        $copy->title = $survey->title.' (copia)';
        $copy->slug = $this->uniqueSlug($copy->title);
        $copy->is_published = false;
        $copy->save();

        return redirect()->route('dashboard.surveys.edit', $copy)->with('success', 'Se creó una copia en borrador.');
    }

    public function responses(int $id)
    {
        $survey = $this->findOwnedSurvey($id);
        $responses = $survey->responses()->latest('submitted_at')->paginate(25);
        $questions = $survey->questions ?? [];
        $questionSummaries = [];
        foreach ($questions as $index => $question) {
            $type = $question['type'] ?? 'text';
            $choices = match ($type) {
                'likert', 'rating' => ['1', '2', '3', '4', '5'],
                'nps' => array_map('strval', range(0, 10)),
                'single', 'multiple', 'select' => $question['options'] ?? [],
                default => [],
            };
            $questionSummaries[$index] = [
                'title' => $question['title'],
                'answered' => 0,
                'counts' => array_fill_keys($choices, 0),
            ];
        }

        foreach ($survey->responses()->select('answers')->cursor() as $response) {
            foreach ($questionSummaries as $index => &$summary) {
                $answer = ($response->answers ?? [])[$index] ?? null;
                if ($answer === null || $answer === '') {
                    continue;
                }
                $summary['answered']++;
                $values = is_array($answer) ? $answer : [$answer];
                foreach ($values as $value) {
                    $value = (string) $value;
                    if (array_key_exists($value, $summary['counts'])) {
                        $summary['counts'][$value]++;
                    }
                }
            }
            unset($summary);
        }

        return view('dashboard.surveys.responses', compact('survey', 'responses', 'questionSummaries'));
    }

    public function export(int $id)
    {
        $survey = $this->findOwnedSurvey($id);
        $questions = $survey->questions ?? [];
        $filename = Str::slug($survey->title).'-respuestas.csv';

        return Response::streamDownload(function () use ($survey, $questions) {
            $output = fopen('php://output', 'w');
            $headers = array_merge(['ID', 'Fecha de envío'], array_column($questions, 'title'));
            fputcsv($output, array_map(fn ($value) => $this->safeCsvValue((string) $value), $headers), ';');

            foreach ($survey->responses()->orderBy('submitted_at')->cursor() as $response) {
                $answers = $response->answers ?? [];
                $row = [$response->id, $response->submitted_at->toDateTimeString()];
                foreach ($questions as $index => $question) {
                    $value = $answers[$index] ?? '';
                    $row[] = $this->safeCsvValue(is_array($value) ? implode(', ', $value) : (string) $value);
                }
                fputcsv($output, $row, ';');
            }

            fclose($output);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    private function validatedSurvey(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'questions' => ['required', 'array', 'min:1', 'max:100'],
            'questions.*.title' => ['required', 'string', 'max:500'],
            'questions.*.type' => ['required', Rule::in(self::QUESTION_TYPES)],
            'questions.*.required' => ['nullable', 'boolean'],
            'questions.*.options' => ['nullable', 'string', 'max:5000'],
        ]);
        $validator->after(function ($validator) use ($request) {
            $questions = $request->input('questions', []);
            if (! is_array($questions)) {
                return;
            }
            foreach ($questions as $index => $question) {
                if (! is_array($question) || ! in_array($question['type'] ?? '', ['single', 'multiple', 'select'], true)) {
                    continue;
                }
                $optionText = $question['options'] ?? '';
                if (! is_string($optionText)) {
                    continue;
                }
                $options = collect(preg_split('/\r\n|\r|\n/', $optionText))
                    ->map(fn ($option) => trim($option))
                    ->filter()
                    ->unique();
                if ($options->count() < 2) {
                    $validator->errors()->add("questions.$index.options", 'Agrega al menos dos opciones diferentes para esta pregunta.');
                }
            }
        });
        $data = $validator->validate();

        $data['questions'] = collect($data['questions'])->values()->map(function (array $question) {
            $options = collect(preg_split('/\r\n|\r|\n/', $question['options'] ?? ''))
                ->map(fn ($option) => trim($option))
                ->filter()
                ->unique()
                ->take(50)
                ->values()
                ->all();

            return [
                'title' => trim($question['title']),
                'type' => $question['type'],
                'required' => (bool) ($question['required'] ?? false),
                'options' => in_array($question['type'], ['single', 'multiple', 'select'], true) ? $options : [],
            ];
        })->all();

        return $data;
    }

    private function findOwnedSurvey(int $id): Survey
    {
        return Survey::query()
            ->whereKey($id)
            ->when(auth()->user()->role !== 3, fn ($query) => $query->where('user_id', auth()->id()))
            ->firstOrFail();
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'encuesta';
        $slug = $base;
        $suffix = 2;

        while (Survey::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    private function safeCsvValue(string $value): string
    {
        if (! is_numeric($value) && preg_match('/^[=+\-@\t\r]/', $value)) {
            return "'".$value;
        }

        return $value;
    }
}
