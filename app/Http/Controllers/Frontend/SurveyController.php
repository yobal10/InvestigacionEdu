<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    public function show(string $slug)
    {
        $survey = Survey::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('frontend.surveys.show', compact('survey'));
    }

    public function submit(Request $request, string $slug)
    {
        $survey = Survey::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $questions = $survey->questions ?? [];
        $rules = [];

        foreach ($questions as $index => $question) {
            $key = 'answers.'.$index;
            $required = ! empty($question['required']);
            $type = $question['type'] ?? 'text';
            $choices = $this->choicesFor($question);

            if ($type === 'multiple') {
                $rules[$key] = [$required ? 'required' : 'nullable', 'array', $required ? 'min:1' : 'min:0'];
                $rules[$key.'.*'] = ['string', Rule::in($choices)];
            } elseif (in_array($type, ['single', 'select', 'likert', 'rating'], true)) {
                $rules[$key] = [$required ? 'required' : 'nullable', 'string', Rule::in($choices)];
            } elseif ($type === 'nps') {
                $rules[$key] = [$required ? 'required' : 'nullable', 'integer', 'between:0,10'];
            } elseif ($type === 'number') {
                $rules[$key] = [$required ? 'required' : 'nullable', 'numeric', 'between:-1000000000,1000000000'];
            } elseif ($type === 'date') {
                $rules[$key] = [$required ? 'required' : 'nullable', 'date_format:Y-m-d'];
            } else {
                $rules[$key] = [$required ? 'required' : 'nullable', 'string', 'max:10000'];
            }
        }

        $validator = Validator::make($request->all(), $rules);
        $validator->after(function ($validator) use ($request, $questions) {
            $answers = $request->input('answers', []);
            if (! is_array($answers)) {
                $validator->errors()->add('answers', 'Las respuestas enviadas no tienen un formato válido.');
                return;
            }
            foreach (array_keys($answers) as $index) {
                if (! ctype_digit((string) $index) || ! array_key_exists((int) $index, $questions)) {
                    $validator->errors()->add('answers', 'Se recibió una respuesta para una pregunta no válida.');
                    break;
                }
            }
        });
        $data = $validator->validate();

        $survey->responses()->create([
            'answers' => $data['answers'] ?? [],
            'submitted_at' => now(),
        ]);

        return redirect()->route('frontend.surveys.show', $survey->slug)->with('success', '¡Gracias! Tu respuesta fue registrada.');
    }

    private function choicesFor(array $question): array
    {
        return match ($question['type'] ?? '') {
            'likert' => ['1', '2', '3', '4', '5'],
            'rating' => ['1', '2', '3', '4', '5'],
            'nps' => array_map('strval', range(0, 10)),
            default => array_map('strval', $question['options'] ?? []),
        };
    }
}
