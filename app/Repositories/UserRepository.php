<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository {
    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function create(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->model->create($data);
    }

    public function findByEmail($email) {
        return $this->model->where('email', $email)->first();
    }
}