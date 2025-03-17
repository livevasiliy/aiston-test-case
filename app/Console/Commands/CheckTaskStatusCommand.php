<?php

namespace App\Console\Commands;

use App\Jobs\ProcessTask;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

class CheckTaskStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-task-status-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check task status command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('status', '=', 'new')->get();
        foreach ($tasks as $task) {
            dispatch(new ProcessTask($task));
        }
    }
}
