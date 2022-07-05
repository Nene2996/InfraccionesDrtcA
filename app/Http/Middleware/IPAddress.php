<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IPAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    function checkIp(){
        $ipaddress = '';
       if (isset($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
       else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
       else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];
       else if(isset($_SERVER['REMOTE_ADDR']))
            return $_SERVER['REMOTE_ADDR'];
       else
            return 'UNKNOWN';   
    }

    //Ips permitidas
     protected $valid_ips = [
          '127.0.0.1',
          '190.119.175.43',
          '190.187.46.171',
          '192.168.10.205'
     ];
     public function handle(Request $request, Closure $next)
     {
          $ip = $this->checkIp();
          foreach ($this->valid_ips as $valid_ip) {
          if ($valid_ip == $ip) {
               return $next($request);
               }
          }

          abort(403, "La direccion IP actual no esta autorizada. Comuniquese con el administrador del sistema");
     }
}
