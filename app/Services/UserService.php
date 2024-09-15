<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

use App\Events\UserRegistered;
use App\Events\UserLoggedIn;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function register(array $data) {
        $user = $this->userRepository->create($data);
        $token = $user->createToken('auth_token')->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }

    public function login(array $credentials) {
        if (!Auth::attempt($credentials)) {
            return null;
        }
        $user = $this->userRepository->findByEmail($credentials['email']);
        $token = $user->createToken('auth_token')->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }

    public function logout($user) {
        $user->currentAccessToken()->delete();
    }
}