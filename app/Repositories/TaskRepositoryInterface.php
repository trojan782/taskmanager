<?php
namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function store($data);
    /**
     * Get Task by ID
     */
    public function show($id);

    /**
     * Show All task
     */
    public function all();

    /**
     * Delete a task
     */
    public function delete($id);

    /**
     * Update a task
     */
    public function update($id, $data);

    /**
     * Search
     */
    public function search($key, $value);
}

