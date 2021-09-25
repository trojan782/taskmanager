<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{

    protected $model;
    public function __construct(Task $Task)
    {
        $this->model = $Task;
    }
    public function all()
    {
        return Task::all();
    }
}