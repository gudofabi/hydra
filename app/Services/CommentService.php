<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use App\Repositories\TaskRepository;

class CommentService
{
    protected $commentRepository;
    protected $taskRepository;

    public function __construct(CommentRepository $commentRepository, TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
        $this->commentRepository = $commentRepository;
    }

    public function getAllComment($taskId) {
        return $this->commentRepository->getAll($taskId);
    }

    public function createComment(array $data, $taskId) {
        $task = $this->taskRepository->findById($taskId);
        if (!$task) {
            throw new \Exception('Task not found.');
        }
        $data['task_id'] = $task->id; // Supply the Task ID
        $comment =  $this->commentRepository->create($data);
        return $comment;
    }

    public function updateComment($id, array $data) {
        $comment = $this->commentRepository->findById($id);
        if (!$comment) {
            throw new \Exception('Comment not found.');
        }
        return $this->commentRepository->update($comment, $data);
    }

    public function deleteComment($id) {
        $comment = $this->commentRepository->findById($id);
        if (!$comment) {
            throw new \Exception('Comment not found.');
        }
        $this->commentRepository->delete($comment);
    }
}