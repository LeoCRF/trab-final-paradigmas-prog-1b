<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCompanyLicense
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        if (!$user->company) {
            return response()->json(['message' => 'Usuário não possui empresa vinculada.'], 403);
        }

        if (!$user->company->licensed) {
            return response()->json(['message' => 'Licença da empresa está expirada ou inativa.'], 403);
        }

        return $next($request);
    }
}
