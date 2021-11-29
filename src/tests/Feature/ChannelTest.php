<?php

namespace Tests\Feature;


use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get All Channels Tests
     */
    public function test_all_channels_list_should_be_accessible()
    {
        $response = $this->get(route('channel.all'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Create Channel Tests
     */
    public function test_channel_create_should_be_validated()
    {
        $response = $this->postJson(route('channel.create'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_can_be_create()
    {
        $channel = Channel::factory()->create();

        $response = $this->postJson(route('channel.create'), [
            'name' => $channel->name
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Update Channel Tests
     */
    public function test_channel_update_should_be_validated()
    {
        $response = $this->json('PUT', route('channel.update'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_channel_can_be_update()
    {
        $channel = Channel::factory()->create();

        $response = $this->json('PUT', route('channel.update'), [
            'id' => $channel->id,
            'name' => 'laravel'
        ]);

        $updatedChannel = Channel::find($channel->id);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('laravel', $updatedChannel->name);
    }

    /*
     * Delete Channel Tests
     */
    public function test_channel_deleted_should_be_validate()
    {
        $reponse = $this->json('DELETE', route('channel.delete'));

        $reponse->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_delete_channel()
    {
        $channel = Channel::factory()->create();
        $response = $this->json('DELETE', route('channel.delete'), [
            'id' => $channel->id
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }
}
