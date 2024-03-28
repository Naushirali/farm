<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Returntowelcomepageresricted
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::guard($guards)->check()) {
            return redirect('/login'); // Change '/firstpage' to the URL of your first page.
        }

        $response = $next($request);

        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
    }
}

