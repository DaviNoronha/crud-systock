<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Collection;

interface ServiceInterface
{
    const LIST_ERROR = "Falha ao listar ";
    const SHOW_ERROR = "Falha ao buscar ";
    const CREATE_ERROR = "Falha ao criar ";
    const UPDATE_ERROR = "Falha ao atualizar ";
    const DELETE_ERROR = "Falha ao excluir ";

    public static function getAll(): Collection;
}
