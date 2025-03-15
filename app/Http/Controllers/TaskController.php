<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController
{
    public function store(StoreTaskRequest $request): JsonResponse
    {
        return new JsonResponse([]);
    }

    public function show(Request $request): JsonResponse
    {
        return new JsonResponse([]);
    }
}
