<?php

// app/Http/Middleware/ApiTokenMiddleware.php

namespace App\Http\Middleware;

use Closure;

class ApiTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        $accessToken = session('access_token');
        $request->headers->add(['Authorization' => 'Bearer ' . $accessToken['access_token']]);
        return $next($request);
    }
}
