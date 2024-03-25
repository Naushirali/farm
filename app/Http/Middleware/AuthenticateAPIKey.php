<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAPIKey
{
    public function handle($request, Closure $next)
    {
        // Check if the API key matches
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey !== '121212') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}


