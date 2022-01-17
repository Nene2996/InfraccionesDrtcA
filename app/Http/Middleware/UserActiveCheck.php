<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserActiveCheck
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
        if(Auth::user()->role == 'Administrador' && Auth::user()->status == 1){
            return $next($request);
        }elseif(Auth::user()->role == 'Asistente Administrativo' && Auth::user()->status == 1){
            return $next($request);
        }elseif(Auth::user()->role == 'Asistente de Caja' && Auth::user()->status == 1){
            return $next($request);
        }else{
            abort(403, "Su cuenta de usuario ha sido desactivada.");
           // return response()->json('Su cuenta de usuario ha sido desactivada. Comuniquese con el administrador del sistema.');
        }
        
    }
}
