<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

//Middleware para la gestión de usuarios
//Se creará un grupo con este middleware en las rutas para controlar el acceso
//También se añadirá la condición en las vistas para no mostrar los accesos (botones) a esas rutas

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user(); // Usuario logueado, null si no hay

        //Si no hay usuario o no es admin (role = true)
        if (!$user || !$user->role) {
            abort(403, 'Acceso denegado');
        }

        return $next($request);
    }
}
