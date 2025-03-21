<?php

namespace App\Services;

use App\Interfaces\TaskServiceInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskService implements TaskServiceInterface
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository
    ) {}

    public function listTasks(array $filters): LengthAwarePaginator
    {
        return $this->taskRepository->getAllTasks($filters);
    }

    public function getTask(int $id): ?Task
    {
        return $this->taskRepository->findTaskById($id);
    }

    public function createTask(array $data): Task
    {
        return $this->taskRepository->createTask($data);
    }

    public function updateTask(int $id, array $data): ?Task
    {
        $task = $this->taskRepository->findTaskById($id);

        if (!$task) {
            throw new ModelNotFoundException("Task not found.");
        }

        $this->taskRepository->updateTask($task, $data);
        return $task->fresh();
    }

    public function deleteTask(int $id): bool
    {
        $task = $this->taskRepository->findTaskById($id);

        if (!$task) {
            throw new ModelNotFoundException("Task not found.");
        }

        return $this->taskRepository->deleteTask($task);
    }
}
