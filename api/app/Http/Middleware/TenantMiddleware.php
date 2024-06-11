<?php

namespace App\Http\Middleware;

use Closure;

use App\BO\EmpresaBO;
use Illuminate\Support\Facades\Auth;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $empresa = "";
        if ($user->roles[0]['name'] != "Administrador")
        {
            $empresa = (new EmpresaBO)->findById($user->id_empresa);    
            if (isset($empresa))
            {
                \Tenant::setTenant($empresa);
            }        
        }
        
        return $next($request);
    }
}
