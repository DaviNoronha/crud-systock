<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public static function getAllUsers(array $query): LengthAwarePaginator
    {
        return User::orderBy($query['key'] ?? 'nome', $query['order'] ?? 'asc')->paginate($query['pagination']);
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

    public static function updateUserPassword(User $user, array $userData): bool
    {
        return $user->update($userData);
    }

    public static function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}
