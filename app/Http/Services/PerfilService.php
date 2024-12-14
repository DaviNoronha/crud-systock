<?php

namespace App\Http\Services;

use App\Http\Helpers\LoggingHelper;
use App\Http\Interfaces\PerfilServiceInterface;
use App\Http\Repositories\PerfilRepository;
use Illuminate\Support\Collection;
use Throwable;

class PerfilService implements PerfilServiceInterface
{
    const ENTITY = "perfi";

    public static function getAll(): Collection
    {
        try {
            return PerfilRepository::orderPerfilByNome();
        } catch (Throwable $th) {
            LoggingHelper::logAndThrowError($th, LoggingHelper::LIST_ERROR . self::ENTITY . "s");
        }
    }
}