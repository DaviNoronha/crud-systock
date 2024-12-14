<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Helpers\LoggingHelper;
use App\Http\Interfaces\UserServiceInterface;
use App\Http\Repositories\PerfilRepository;
use App\Http\Repositories\UserRepository;
use App\Models\Perfil;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

class UserService implements UserServiceInterface
{
    const ENTITY = "usuário";

    public static function getAll(): LengthAwarePaginator
    {
        try {
            return UserRepository::orderUserByNome();
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