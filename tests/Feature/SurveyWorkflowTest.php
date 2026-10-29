<?php

namespace Tests\Feature;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SurveyWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_publish_and_collect_survey_responses(): void
    {
        $user = $this->createUser('survey-owner');
        $this->actingAs($user)
            ->post(route('dashboard.surveys.store'), [
                'title' => 'Encuesta de prueba',
                'description' => 'Descripción',
                'questions' => [
                    [
                        'title' => '¿Qué método prefieres?',
                        'type' => 'single',
                        'required' => '1',
                        'options' => "Cuantitativo\nCualitativo",
                    ],
                    [
                        'title' => 'Edad',
                        'type' => 'number',
                        'options' => '',
                    ],
                ],
            ])
            ->assertRedirect(route('dashboard.surveys.edit', 1));

        $survey = Survey::firstOrFail();
        $this->assertSame(['Cuantitativo', 'Cualitativo'], $survey->questions[0]['options']);

        $this->actingAs($user)
            ->post(route('dashboard.surveys.publish', $survey))
            ->assertSessionHas('success', 'Encuesta publicada.');

        $this->post(route('frontend.surveys.submit', $survey->slug), [
            'answers' => [0 => 'No disponible'],
        ])->assertSessionHasErrors('answers.0');
        $this->assertDatabaseCount('survey_responses', 0);

        $this->post(route('frontend.surveys.submit', $survey->slug), [
            'answers' => [0 => 'Cuantitativo', 1 => '24'],
        ])->assertRedirect(route('frontend.surveys.show', $survey->slug));

        $this->assertDatabaseCount('survey_responses', 1);
        $this->assertSame(['Cuantitativo', '24'], array_values($survey->responses()->firstOrFail()->answers));
    }

    public function test_a_user_cannot_edit_another_users_survey(): void
    {
        $owner = $this->createUser('owner');
        $intruder = $this->createUser('intruder');
        $survey = Survey::create([
            'user_id' => $owner->id,
            'title' => 'Privada',
            'slug' => 'privada',
            'questions' => [['title' => 'Pregunta', 'type' => 'text', 'required' => false, 'options' => []]],
        ]);

        $this->actingAs($intruder)
            ->get(route('dashboard.surveys.edit', $survey))
            ->assertNotFound();
    }

    public function test_a_user_can_duplicate_a_survey_as_an_unpublished_copy(): void
    {
        $user = $this->createUser('duplicator');
        $survey = Survey::create([
            'user_id' => $user->id,
            'title' => 'Encuesta base',
            'slug' => 'encuesta-base',
            'questions' => [['title' => 'Pregunta', 'type' => 'text', 'required' => true, 'options' => []]],
            'is_published' => true,
        ]);

        $this->actingAs($user)
            ->post(route('dashboard.surveys.duplicate', $survey))
            ->assertRedirect(route('dashboard.surveys.edit', 2));

        $copy = Survey::findOrFail(2);
        $this->assertSame('Encuesta base (copia)', $copy->title);
        $this->assertFalse($copy->is_published);
        $this->assertSame($survey->questions, $copy->questions);
    }

    private function createUser(string $username): User
    {
        return User::create([
            'name' => ucfirst($username),
            'username' => $username,
            'email' => $username.'@example.test',
            'password' => 'password',
            'role' => User::IS_VISITOR,
            'status' => true,
        ]);
    }
}
