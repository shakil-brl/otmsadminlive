<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon; // Add this line

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Check if the access token is in the session
        if (session()->has('access_token')) {
            $tokenData = session('access_token');
            //dd($tokenData);

            // Check the expiration time of the token (replace with actual logic)
            $expirationTime = Carbon::parse($tokenData['expires_at']); // Example, replace with actual expiration time

            // Check if the token has expired
            if ($expirationTime->isPast()) {
                // Token has expired, perform logout or refresh token logic
                session()->forget('access_token');
                // Redirect to login or refresh token endpoint
                return redirect('/login');
            }

            // The token is valid and not expired
            // You can continue with your application logic here
        } else {
            // No access token in the session, perform login or redirect to login page
            return redirect('/login');
        }

        return $next($request);
    }
}
