<?php

namespace Tests\Feature;

use App\Jobs\EvaluateQuality;
use App\Jobs\ProcessTask;
use App\Models\Task;
use App\Models\QualityScore;
use App\Models\Transcription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaskJobTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Создаем задачу в статусе "новая"
        $this->task = \App\Models\Task::factory()->create([
            'status' => 'new',
            'audio_url' => 'http://example.com/audio.mp3',
            'metadata' => json_encode([])
        ]);
    }

    public function test_task_creation()
    {
        $response = $this->postJson('/api/tasks', [
            'audio_url' => 'http://example.com/audio.mp3',
            'metadata' => ['key' => 'value'],
        ], [
            'Authorization' => config('auth.defaults.token'), // Токен аутентификации
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['taskId']);

        $this->assertDatabaseHas('tasks', [
            'audio_url' => 'http://example.com/audio.mp3',
            'status' => 'new',
        ]);
    }

    public function test_task_creation_with_invalid_data()
    {
        $response = $this->postJson('/api/tasks', [
            'audio_url' => 'invalid-url', // Некорректный URL
        ], [
            'Authorization' => config('auth.defaults.token'),
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['audio_url']);
    }

    public function test_scheduler_updates_task_status()
    {
        $task = \App\Models\Task::factory()->create([
            'status' => 'new',
            'audio_url' => 'http://example.com/audio.mp3',
            'metadata' => json_encode([])
        ]);
        // Запускаем команду проверки статуса
        Artisan::call('app:check-task-status-command');

        // Выполняем задачи из очереди
        Artisan::call('queue:work', ['--once' => true]);

        // Проверяем, что статус задачи обновился
        $task->refresh();
        $this->assertEquals('evaluated', $task->status);
    }

    public function test_queue_updates_task_status()
    {
        // Добавляем задачу в очередь
        dispatch(new ProcessTask($this->task));

        // Выполняем задачи из очереди
        Artisan::call('queue:work', ['--once' => true]);

        // Проверяем, что статус задачи обновился
        $this->task->refresh();
        $this->assertEquals('evaluated', $this->task->status);
    }
}
