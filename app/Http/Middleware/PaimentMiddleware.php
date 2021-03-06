<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaimentMiddleware
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
        if(Auth::user()->role == 'Administrador' || Auth::user()->role == 'Asistente de Caja')
            return $next($request);
        return response()->json('Solicite la actualizacion de permisos correspondientes con el administrador del sistemas');
        
    }
}
