<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    const ENTITY = "usuário";

    public static function orderUserByNome(): LengthAwarePaginator
    {
        return User::orderBy('nome')->paginate(10);
    }

    public static function getUserById(string $id): User
    {
        return User::findOrFail($id);
    }

    public static function createUser(array $userData): User
    {
        return User::create($userData);
    }

    public static function updateUser(User $user, array $userData): bool
    {
        return $user->update($userData);
    }

    public static function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}