<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskController
{
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create([
            'audio_url' => $request->validated()['audio_url'],
            'metadata' => $request->validated()['metadata'] ?? null,
        ]);

        return new JsonResponse(['taskId' => $task->id], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $task = Task::with(['transcription', 'qualityScore'])->findOrFail($id);
        return new JsonResponse($task);
    }
}
