<?php

namespace App\Http\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class LoggingHelper
{
    const LIST_ERROR = "Falha ao listar ";
    const SHOW_ERROR = "Falha ao buscar ";
    const CREATE_ERROR = "Falha ao criar ";
    const UPDATE_ERROR = "Falha ao atualizar ";
    const DELETE_ERROR = "Falha ao excluir ";
    
    public static function logAndThrowError(Throwable $th, string $message): void
    {
        Log::error([
            'message' => $th->getMessage(),
            'line' => $th->getLine(),
            'file' => $th->getFile(),
        ]);
        throw new Exception($message);
    }
}
