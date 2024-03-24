<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié et a le rôle d'administrateur
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // Rediriger l'utilisateur vers une page d'erreur ou une autre page appropriée
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}
