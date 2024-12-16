<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {
            $response = AuthService::login($request->toArray());
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
