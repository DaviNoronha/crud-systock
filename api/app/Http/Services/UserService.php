<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Perfil;
use App\Http\Helpers\LoggingHelper;
use App\Http\Interfaces\UserServiceInterface;
use App\Http\Repositories\PerfilRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;
use Throwable;

class UserService implements UserServiceInterface
{
    const ENTITY = "usuário";

    public static function getAll(array $request): LengthAwarePaginator
    {
        try {
            return UserRepository::getAllUsers($request);
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, LoggingHelper::LIST_ERROR . self::ENTITY . "s");
        }
    }

    public static function count(): Collection
    {
        try {
            return PerfilRepository::countUsersByPerfil();
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, LoggingHelper::SHOW_ERROR . self::ENTITY);
        }
    }

    public static function getById(string $id): User
    {
        try {
            return UserRepository::getUserById($id);
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, LoggingHelper::SHOW_ERROR . self::ENTITY);
        }
    }

    public static function create(array $request): User
    {
        try {
            $perfil = Perfil::where('nome', $request['perfil'])->first();

            return UserRepository::createUser([
                'nome'      => $request['nome'],
                'cpf'       => $request['cpf'],
                'email'     => $request['email'],
                'perfil_id' => $perfil->id,
                'password'  => bcrypt($request['password']),
            ]);
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, LoggingHelper::CREATE_ERROR . self::ENTITY);
        }
    }

    public static function update(array $request, User $user): User
    {
        try {
            $perfil = Perfil::where('nome', $request['perfil'])->first();

            UserRepository::updateUser($user, [
                'nome'      => $request['nome'],
                'cpf'       => $request['cpf'],
                'email'     => $request['email'],
                'perfil_id' => $perfil->id,
            ]);

            if ($request['password']) {
                UserRepository::updateUserPassword($user, ['password' => bcrypt($request['password'])]);
            }

            return $user;
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, LoggingHelper::UPDATE_ERROR . self::ENTITY);
        }
    }

    public static function delete(User $user): bool
    {
        try {
            return UserRepository::deleteUser($user);
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, LoggingHelper::DELETE_ERROR . self::ENTITY);
        }
    }
}