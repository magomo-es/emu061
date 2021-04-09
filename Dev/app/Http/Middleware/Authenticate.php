<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            echo '<script>console.log("Authenticate.php -> Authenticate class -> redirectTo: redirects by ! $request->expectsJson())")</script>';
            return view('/');
        }
    }
}
