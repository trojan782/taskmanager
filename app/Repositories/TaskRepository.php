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

    public function show($id)
    {
        $task = $this->task::findOrFail($id);
        return $task;
    }

    public function all()
    {
        $tasks = $this->task::all();
        return $tasks;
    }

    public function update($data, $id)
    {
        $task = $this->task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function destroy($id)
    {
        $task = $this->task::findOrFail($id);
        return $task->destroy();
    }
}