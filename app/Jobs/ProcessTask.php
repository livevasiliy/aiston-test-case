<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\Transcription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessTask implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Task $task)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Имитация задержки
        sleep(rand(5, 15));

        // Фейковые данные транскрибации
        $fakeTranscription = [
            [
                "speaker" => "S1",
                "start" => 0.0,
                "end" => 5.0,
                "text" => "Добрый день, как я могу помочь?"
            ],
            [
                "speaker" => "S2",
                "start" => 5.0,
                "end" => 10.0,
                "text" => "Здравствуйте, у меня проблема с заказом."
            ]
        ];

        // Сохранение транскрибации

        Transcription::create([
            'task_id' => $this->task->id,
            'data' => json_encode($fakeTranscription),
        ]);
        $this->task->update(['status' => 'completed']);

        // Передача данных в LLM-систему
        dispatch(new EvaluateQuality($this->task));
    }
}
