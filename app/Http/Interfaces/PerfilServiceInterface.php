<?php

namespace App\Http\Interfaces;

use Illuminate\Support\Collection;

interface PerfilServiceInterface
{
    public static function getAll(): Collection;
}
