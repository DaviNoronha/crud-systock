<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\PerfilRepositoryInterface;
use App\Models\Perfil;
use Illuminate\Support\Collection;

class PerfilRepository implements PerfilRepositoryInterface
{
    public static function orderPerfilByNome(): Collection
    {
        return Perfil::orderBy('nome')->get();
    }

    public static function countUsersByPerfil(): Collection
    {
        return Perfil::withCount('users')
            ->pluck('users_count', 'nome');
    }
}
