<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
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
        //dd($request->user()->hasRole($roleName));
        if(!Auth::check())
            return redirect('/');

        if (Auth::user()->role == 'Administrador') {
            return $next($request);
        }elseif(Auth::user()->role == 'Asistente Administrativo'){
            return $next($request);
        }elseif(Auth::user()->role == 'Asistente de Caja'){
            return $next($request);
        }else{
            return response()->json('Solicite la actualizacion de permisos correspondientes con el administrador del sistema');
        }


        

        
        
    }
}
