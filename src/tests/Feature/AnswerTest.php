<?php

namespace Tests\Feature;


use App\Models\Answer;
use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_answers_should_be_accessible()
    {
        $response = $this->get(route('answers.index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function create_answer_should_be_validated()
    {
        $response = $this->postJson(route('answers.store'), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['content', 'thread_id']);
    }

    /** @test */
    public function can_submit_new_answer_for_thread()
    {
        Sanctum::actingAs(User::factory()->create());

        $thread = Thread::factory()->create();
        $response = $this->postJson(route('answers.store'), [
            'content' => 'Bar',
            'thread_id' => $thread->id
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'message' => 'answer created successfully.'
        ]);
        $this->assertTrue($thread->answers()->whereContent('Bar')->exists());
    }

    /** @test */
    public function user_score_will_increase_by_submit_new_answer()
    {
        $user=User::factory()->create();
        Sanctum::actingAs($user);

        $thread = Thread::factory()->create();
        $this->postJson(route('answers.store'), [
            'content' => 'Foo',
            'thread_id' => $thread->id
        ])->assertSuccessful();

        $user->refresh();
        $this->assertEquals(10,$user->score);
    }

    /** @test */
    public function user_score_will_do_not_increase_with_own_by_submit_new_answer()
    {
        $user=User::factory()->create();
        Sanctum::actingAs($user);

        $thread = Thread::factory()->create([
            'title' => 'Foo',
            'content' => 'Bar',
            'channel_id' => (Channel::factory()->create())->id,
            'user_id'=>$user->id
        ]);
        $this->postJson(route('answers.store'), [
            'content' => 'Foo',
            'thread_id' => $thread->id
        ])->assertSuccessful();

        $user->refresh();
        $this->assertEquals(0,$user->score);
    }

    /** @test */
    public function update_answer_should_be_validated()
    {
        $answer = Answer::factory()->create();
        $response = $this->putJson(route('answers.update', [$answer]), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['content']);
    }

    /** @test */
    public function can_update_own_answer()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $thread = Thread::factory()->create();

        $answer = Answer::factory()->create([
            'content' => 'Foo',
            'thread_id' => $thread->id,
            'user_id' => $user->id
        ]);

        $response = $this->putJson(route('answers.update', [$answer]), [
            'content' => 'Bar'
        ])->assertSuccessful();

        $response->assertJson([
            'message' => 'answer updated successfully.'
        ]);

        $answer->refresh();
        $this->assertEquals('Bar', $answer->content);
    }

    /** @test */
    public function can_delete_own_answer()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $answer = Answer::factory()->create([
            'content' => 'Bar',
            'thread_id' => (Thread::factory()->create())->id,
            'user_id' => $user->id
        ]);

        $response = $this->delete(route('answers.destroy', $answer))
            ->assertSuccessful();

        $response->assertJson([
            'message' => 'answer delete successfully.'
        ]);

        $this->assertFalse(Answer::whereContent('Bar')->exists());
    }
}
