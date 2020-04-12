<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;


class CekStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = $this->CekRoute($request->route());
        
        foreach($roles as $role){
            if($request->user()->hasRole($role) == $role)
            {
                return $next($request);
            }
        }
       
        return abort(503, 'Anda tidak memiliki hak akses, silahkan menghubungi tim IT kami.');
    }

    private function CekRoute($route)
    {
        $actions = $route->getAction(); 
        
        return isset($actions['cekstatus']) ? $actions['cekstatus'] : null;
    }
}
