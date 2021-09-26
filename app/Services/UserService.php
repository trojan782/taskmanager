<?php
namespace App\Services;

use App\Repositories\UserRepository;

class TaskService extends UserRepository
{
    protected $userservice;

    public function __construct(UserRepository $userservice)
    {
        $this->userservice = $userservice;
    }

    public function store($data)
    {
        return $this->userservice->store($data);
    }

    public function show($id)
    {
        return $this->userservice->show($id);
    }

    public function all()
    {
        return $this->userservice->all();
    }

    public function update($data, $id)
    {
        return $this->userservice->update($data, $id);
    }
}
