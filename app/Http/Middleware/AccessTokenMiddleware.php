<?php

// app/Http/Middleware/AccessTokenMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon; // Add this line

class AccessTokenMiddleware
{
    public function handle($request, Closure $next)
    {

        //dd(session('access_token.expires_at'));
        if (session('access_token.access_token')) {
            // $tokenData = session('access_token.access_token');

            $expirationTime = Carbon::parse(session('access_token.expires_at'));
            // dd($expirationTime->isPast());
            if ($expirationTime->isPast()) {
                session()->flush();
                return redirect('/login');
            }
        } else {
            session()->flush();
            return redirect('/login');
        }
        return $next($request);
    }
}

