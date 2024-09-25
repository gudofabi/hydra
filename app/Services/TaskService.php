<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(taskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTask() {
        return $this->taskRepository->getAll();
    }

    public function createTask(array $data) {
        $task =  $this->taskRepository->create($data);
        $task->load('user');
        return $task;
    }

    public function updateTask($id, array $data) {
        $task = $this->taskRepository->findById($id);
        if (!$task) {
            throw new \Exception('Task not found.');
        }
        return $this->taskRepository->update($task, $data);
    }
}