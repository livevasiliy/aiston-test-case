<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_task_creation()
    {
        $response = $this->postJson('/api/tasks', [
            'audio_url' => 'http://example.com/audio.mp3',
            'Authorization' => 'your-secret-token',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['task_id']);
    }
}
