<?php

namespace App\Interfaces;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskServiceInterface
{
    public function listTasks(array $filters): LengthAwarePaginator;

    public function getTask(int $id): ?Task;

    public function createTask(array $data): Task;

    public function updateTask(int $id, array $data): ?Task;

    public function deleteTask(int $id): bool;
}
