<?php

namespace App\Http\Services;

use App\Http\Helpers\LoggingHelper;
use App\Http\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserService implements UserServiceInterface
{
    const ENTITY = "usuário";

    public static function getAll(): LengthAwarePaginator
    {
        try {
            return User::orderBy('nome')->paginate(10);
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, self::LIST_ERROR . self::ENTITY . "s");
        }
    }

    public static function getById(string $id): User
    {
        try {
            return User::findOrFail($id);
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, self::SHOW_ERROR . self::ENTITY);
        }
    }

    public static function create(array $request): User
    {
        try {
            Log::info($request);
            return User::create([
                'nome'      => $request['nome'],
                'cpf'       => $request['cpf'],
                'email'     => $request['email'],
                'perfil_id' => $request['perfil_id'],
                'password'  => bcrypt($request['password']),
            ]);
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, self::CREATE_ERROR . self::ENTITY);
        }
    }

    public static function update(array $request, User $user): User
    {
        try {
            $user->update([
                'nome'      => $request['nome'],
                'cpf'       => $request['cpf'],
                'email'     => isset($request['email']) ? $request['email'] : null,
                'perfil_id' => $request['perfil_id'],
            ]);

            return $user;
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, self::UPDATE_ERROR . self::ENTITY);
        }
    }

    public static function delete(User $user): bool
    {
        try {
            return $user->delete();
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, self::DELETE_ERROR . self::ENTITY);
        }
    }
}