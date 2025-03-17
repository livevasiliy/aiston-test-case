<?php

namespace App\Jobs;

use App\Models\QualityScore;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class EvaluateQuality implements ShouldQueue
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
    public function handle()
    {
        // Имитация задержки
        sleep(rand(2, 5));

        // Фейковая оценка качества
        $fakeScore = [
            'overall_score' => rand(70, 100),
            'clarity' => rand(60, 90),
            'politeness' => rand(70, 95),
        ];

        // Сохранение оценки
        QualityScore::create([
            'task_id' => $this->task->id,
            'data' => $fakeScore
        ]);
        $this->task->update(['status' => 'evaluated']);
    }
}
