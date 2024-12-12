<?php

namespace App\Http\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class LoggingHelper
{
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
