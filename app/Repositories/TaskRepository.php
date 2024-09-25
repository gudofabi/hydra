<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class TaskRepository {
    protected $model;

    public function __construct(Task $model) {
        $this->model = $model;
    }

    public function findById($id) {
        return $this->model->find($id);
    }

    public function getAll() {
        return $this->model->orderBy('created_at', 'desc')->paginate(10);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(Task $task, array $data) {
       $task->update($data);
       return $task;
    }

}