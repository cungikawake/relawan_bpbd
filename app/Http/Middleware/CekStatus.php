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
        //dd($request->user()->hasRole($roles));
        //cek midelware sama role user login
        if($request->user()->hasRole($roles))
        {
            return $next($request);
        }
        return redirect('/');
    }

    private function CekRoute($route)
    {
        $actions = $route->getAction(); 
         
        return isset($actions['cekstatus']) ? $actions['cekstatus'] : null;
    }
}
