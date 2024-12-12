<?php

namespace App\Http\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    const LIST_ERROR = "Falha ao listar ";
    const SHOW_ERROR = "Falha ao buscar ";
    const CREATE_ERROR = "Falha ao criar ";
    const UPDATE_ERROR = "Falha ao atualizar ";
    const DELETE_ERROR = "Falha ao excluir ";

    public static function getAll() : LengthAwarePaginator;

    public static function getById(string $id) : User;

    public static function create(array $request): User;

    public static function update(array $request, User $user): User;

    public static function delete(User $user): bool;
}
