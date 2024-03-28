<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class  Returntologinregisterrestricted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
{
    if (Auth::guard($guard)->check()) {
        // User is authenticated, redirect them away from restricted pages
        return redirect('/welcome'); // Change '/welcome' to the page you want authenticated users to see.
    }




    $response = $next($request);

    $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $response->headers->set('Pragma', 'no-cache');
    $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

    return $response;



}

}
