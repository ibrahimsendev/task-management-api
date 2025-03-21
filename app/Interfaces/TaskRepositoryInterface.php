<?php

namespace App\Interfaces;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function getAllTasks(array $filters): LengthAwarePaginator;

    public function findTaskById(int $id): ?Task;

    public function createTask(array $data): Task;

    public function updateTask(Task $task, array $data): bool;

    public function deleteTask(Task $task): bool;
}
