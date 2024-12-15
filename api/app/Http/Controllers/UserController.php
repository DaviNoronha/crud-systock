<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $users = UserService::getAll($request->all());
            $usersResource = UserResource::collection($users)->response()->getData(true);

            return response()->json($usersResource, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function count(): JsonResponse
    {
        try {
            $usersCount = UserService::count();

            return response()->json($usersCount, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $user = UserService::create($request->all());
            $userResource = new UserResource($user);

            return response()->json($userResource, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(User $user): JsonResponse
    {
        try {
            $userResource = new UserResource($user);

            return response()->json($userResource, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        try {
            $user = UserService::update($request->all(), $user);
            $userResource = new UserResource($user);

            return response()->json($userResource, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        try { 
            UserService::delete($user);

            return response()->json(['message' => 'Usuário foi deletado com sucesso'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
