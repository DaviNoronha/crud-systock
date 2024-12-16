<?php

namespace App\Http\Services;

use App\Http\Interfaces\AuthServiceInterface;
use App\Http\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{

    public static function login(array $request): array
    {
        $auth = Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ]);

        if (!$auth) {
            throw new AuthenticationException("Credenciais incorretas!");
        }

        $user = Auth::user();
        $token = $user->createToken('Systock')->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' => $token
        ];
    }
}
