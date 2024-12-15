<?php

namespace App\Http\Controllers;

use App\Http\Resources\PerfilResource;
use App\Http\Services\PerfilService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PerfilController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $perfis = PerfilService::getAll();
            $perfisResource = PerfilResource::collection($perfis);

            return response()->json($perfisResource, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
