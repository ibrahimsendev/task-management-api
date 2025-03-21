<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Interfaces\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskServiceInterface $taskService
    ) {}

    /**
     * Get all tasks with filtering and pagination.
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['status', 'priority', 'date_from', 'date_to', 'sort_by', 'sort_order']);
        $tasks = $this->taskService->listTasks($filters);
        return TaskResource::collection($tasks)->response();
    }

    /**
     * Create a new task.
     */
    public function store(TaskStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $task = $this->taskService->createTask($data);
        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * Update an existing task.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $data = $request->validated();
        $updatedTask = $this->taskService->updateTask($task->id, $data);
        return response()->json($updatedTask);
    }

    /**
     * Delete a task.
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->taskService->deleteTask($task->id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
