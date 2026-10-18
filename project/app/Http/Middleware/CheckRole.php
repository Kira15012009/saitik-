<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Гость — отказ
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Войдите в аккаунт');
        }

       
        $userRole = auth()->user()->role->name ?? null;

        if (!in_array($userRole, $roles)) {
            abort(403, 'Доступ запрещён. У вас нет прав для этого раздела.');
        }

        return $next($request);
    }
}