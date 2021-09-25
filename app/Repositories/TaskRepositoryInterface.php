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
     * Update a task
     */
    public function update($data, $id);
    
    /**
     * Delete a task
     */
    public function destroy($id);
    /**
     * Search
     */
    // public function search($key, $value);
}

