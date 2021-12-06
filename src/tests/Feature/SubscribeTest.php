<?php

namespace Tests\Feature;


use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $response=$this->postJson(route('subscribe',[$thread]))->assertSuccessful();
        $response->assertJson([
            'message'=>'user subscribe successfully.'
        ]);
    }

    /** @test */
    public function user_can_unsubscribe_to_a_thread()
    {
        Sanctum::actingAs(User::factory()->create());

        $thread = Thread::factory()->create();

        $response=$this->postJson(route('unSubscribe',[$thread]))->assertSuccessful();
        $response->assertJson([
            'message'=>'user unsubscribe successfully.'
        ]);
    }
}
