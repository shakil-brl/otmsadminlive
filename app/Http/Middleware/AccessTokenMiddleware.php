<?php

// app/Http/Middleware/AccessTokenMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon; // Add this line

class AccessTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        if (session()->has('access_token')) {
            $tokenData = session('access_token');
            $expirationTime = Carbon::parse($tokenData['expires_at']);
            // dd($expirationTime->isPast());
            if ($expirationTime->isPast()) {
                session()->forget('access_token');
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
        return $next($request);
    }
}

