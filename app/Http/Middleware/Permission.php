<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();
        //dd($routeName);
        $routePermissions = Session::get('rolePermission');
        //dd($routePermissions);
        $authUser = Session::get('authUser');
       
        if ($authUser) {
            $accessArr = array();
            if(count($routePermissions)>0){
                foreach($routePermissions as $access){
                    array_push($accessArr,$access['name']);
                }
            }
            if (!in_array($routeName, $accessArr)) {
                $user = auth()->user();
                return response()->view('errors.unauthorised', compact('authUser'));
                //return redirect()->route('login');
            }
            
            
        }else{
            //return redirect()->route('login.show');
            return redirect()->route('admins.dashboard');
        }
        return $next($request);
    }
}
