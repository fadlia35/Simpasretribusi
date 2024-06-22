<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;

class AuthMiddleware extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array|string  $guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (auth($guards[0])->check() || auth('pemilik')->check()) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}

?>