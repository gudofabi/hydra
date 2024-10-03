<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $registration = $this->userService->register($validatedData);
        if (!$registration) {
            return response()->json(['message' => 'Registration failed'], 400);
        }

        return response()->json(['user' => $registration['user']]
        );
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $login = $this->userService->login($credentials);

        if (!$login) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        return response()->json(['user' => $login['user'],]);
    }

    public function logout(Request $request) {
        $this->userService->logout($request->user());
        return response()->json(['message' => 'Successfully logged out!']);
    }

}
