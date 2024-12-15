<?php

namespace App\Http\Interfaces;

use Illuminate\Support\Collection;

interface PerfilRepositoryInterface
{
    public static function orderPerfilByNome(): Collection;
    
    public static function countUsersByPerfil(): Collection;
}
