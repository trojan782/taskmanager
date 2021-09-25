<?php
namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService extends TaskRepository
{
    protected $taskservice;

    public function __construct(TaskRepository $taskservice)
    {
        $this->taskservice = $taskservice;
    }

    public function store($data)
    {
       return  $this->taskservice->store($data);
    }

    public function show($id)
    {
        return $this->taskservice->show($id);
    }

    public function all()
    {
        return $this->taskservice->all();
    }

    public function update($data,$id)
    {
        return $this->taskservice->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->taskservice->destroy($id);
    }
}