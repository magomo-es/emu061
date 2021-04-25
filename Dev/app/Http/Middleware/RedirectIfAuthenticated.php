<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {

                //echo '<script>console.log("RedirectIfAuthenticated.php -> handle -> redirect")</script>';

                switch(Auth::user()->rols_id) {
                    case 1: // Admin
                        return redirect(RouteServiceProvider::ADMIN);
                        break;
                    case 2: // CECOS
                        return redirect(RouteServiceProvider::CECOS);
                        break;
                    case 3: // Recurs
                        return redirect(RouteServiceProvider::RECURS);
                        break;
                    default: // to login
                        return redirect(RouteServiceProvider::LOGIN);
                }

            } else {

                return redirect(RouteServiceProvider::LOGIN);

            }

        }

        return $next($request);
    }
}
