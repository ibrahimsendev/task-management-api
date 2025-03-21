<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasks(array $filters): LengthAwarePaginator
    {
        $query = Task::query();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
            $query->whereBetween('due_date', [$filters['date_from'], $filters['date_to']]);
        }

        if (!empty($filters['sort_by']) && in_array($filters['sort_by'], ['title', 'due_date', 'priority'])) {
            $query->orderBy($filters['sort_by'], $filters['sort_order'] ?? 'asc');
        }

        return $query->paginate(10);
    }

    public function findTaskById(int $id): ?Task
    {
        return Task::find($id);
    }

    public function createTask(array $data): Task
    {
        return Task::create($data);
    }

    public function updateTask(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function deleteTask(Task $task): bool
    {
        return $task->delete();
    }
}
