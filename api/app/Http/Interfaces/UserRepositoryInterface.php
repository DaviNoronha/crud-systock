<?php

namespace App\Http\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public static function getAllUsers(array $query): LengthAwarePaginator;

    public static function getUserById(string $id): User;

    public static function createUser(array $userData): User;

    public static function updateUser(User $user, array $userData): bool;

    public static function updateUserPassword(User $user, array $userData): bool;

    public static function deleteUser(User $user): bool;
}
