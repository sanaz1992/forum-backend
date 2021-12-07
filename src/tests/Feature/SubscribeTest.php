<?php

namespace Tests\Feature;


use App\Models\Thread;
use App\Models\User;
use App\Notifications\NewReplySubmitted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_subscribe_to_a_thread()
    {
        Sanctum::actingAs(User::factory()->create());

        $thread = Thread::factory()->create();

        $response = $this->postJson(route('subscribe', [$thread]))->assertSuccessful();
        $response->assertJson([
            'message' => 'user subscribe successfully.'
        ]);
    }

    /** @test */
    public function user_can_unsubscribe_to_a_thread()
    {
        Sanctum::actingAs(User::factory()->create());

        $thread = Thread::factory()->create();

        $response = $this->postJson(route('unSubscribe', [$thread]))->assertSuccessful();
        $response->assertJson([
            'message' => 'user unsubscribe successfully.'
        ]);
    }

    /** @test */
    public function notification_will_send_to_subscribes_of_a_thread()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Notification::fake();

        $thread = Thread::factory()->create();

        $subscribe_response = $this->postJson(route('subscribe', [$thread]))->assertSuccessful();
        $subscribe_response->assertJson([
            'message' => 'user subscribe successfully.'
        ]);

        $answer_response = $this->postJson(route('answers.store'), [
            'content' => 'Foo',
            'thread_id' => $thread->id
        ])->assertSuccessful();
        $answer_response->assertJson([
            'message' => 'answer created successfully.'
        ]);
        Notification::assertSentTo($user, NewReplySubmitted::class);
    }
}
