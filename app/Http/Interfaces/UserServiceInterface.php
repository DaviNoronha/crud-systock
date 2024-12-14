<?php

namespace App\Http\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public static function getAll(): LengthAwarePaginator;

    public static function getById(string $id) : User;

    public static function create(array $request): User;

    public static function update(array $request, User $user): User;

    public static function delete(User $user): bool;
}
