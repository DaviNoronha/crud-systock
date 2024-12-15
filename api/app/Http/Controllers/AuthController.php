<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {
            $auth = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            if (!$auth) {
                throw new Exception("Credenciais incorretas!");
            }

            $user = Auth::user();
            $token = $user->createToken('Systock')->plainTextToken;

            return response()->json($token, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
