<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{

    protected $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function store($data)
    {
        $task = $this->task::create($data);
        return $task;
    }

    public function show(int $id)
    {
        $task = $this->task::findOrFail($id);
        return $task;
    }

    public function all()
    {
        $tasks = $this->task::all();
        return $tasks;
    }

    public function update($data, int $id)
    {
        $task = $this->task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function destroy(int $id)
    {
        $task = $this->task::findOrFail($id);
        return $task->destroy($id);
    }
}
