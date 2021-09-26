<?php
namespace App\Repositories;

use App\Models\User;

class UserRepostory implements TaskRepositoryInterface
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    //creating a user
    public function store($data)
    {
        $user = $this->user::create($data);
        return $user;
    }

    //getting a particular user
    public function show($id)
    {
        $user = $this->user::findOrFail($id);
        return $user;
    }

    //getting all users
    public function all()
    {
        $users = $this->user::all();
        return $users;
    }

    // updating a user
    public function update($data, $id)
    {
        $user = $this->user::findOrFail($id);
        $user->update($data);
        return $user;
    }
}
