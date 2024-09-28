<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository {
    protected $model;

    public function __construct(Comment $model) {
        $this->model = $model;
    }

    public function getAll($taskId) {
        return $this->model->where('task_id',$taskId)->orderBy('created_at', 'desc')->get();
    }


    public function findById($id) {
        return $this->model->find($id);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(Comment $comment, array $data) {
       $comment->update($data);
       return $comment;
    }

    public function delete(Comment $comment) {
        $comment->delete();
    }

}