<?php

namespace App\Http\Middleware;

use Closure;

class AccessControlAdmin
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

        if (auth()->user()->role === 'ROLE_USER') {
            flash('Você não tem permissão para acessar a area administrativa de lojas!')->warning();

            return redirect()->route('home');
        }

        return $next($request);
    }
}
