<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventSelfDestroyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authUserId = Auth::user()->id;
        $requestUserId = $request->route('user')->id;

        if ($authUserId === $requestUserId) {
            return response()->json([
                'message' => 'Você não pode excluir sua própria conta'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}