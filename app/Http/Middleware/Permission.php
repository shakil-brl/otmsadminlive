<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Permission
{
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();

        //$routePermissions = Session::get('rolePermission');
        $routePermissions = session('access_token.rolePermission', []);
        $authUser = Session::get('access_token.authUser');
        //dd($routeName, $routePermissions, $authUser);
        // if ($authUser) {
        //     $accessArr = array();
        //     if (count($routePermissions) > 0) {
        //         foreach ($routePermissions as $access) {
        //             array_push($accessArr, $access['name']);
        //         }
        //     }

        //     dd($routeName, $authUser);
        //     if (!in_array($routeName, $accessArr)) {
        //         $user = auth()->user();
        //         return response()->view('errors.unauthorised', compact('authUser'));
        //         //return redirect()->route('login');
        //     }


        // } else {
        //     return redirect()->route('login.show');
        //     //return redirect()->route('admins.dashboard');
        // }

        //dd($routeName, $rolePermission);
        //dd(!in_array($routeName, $rolePermission));
        if (!in_array($routeName, $routePermissions)) {
            $user = auth()->user();
            return response()->view('errors.unauthorised', compact('authUser'));
            //return redirect()->route('login');
        }
        //dd($request);
        return $next($request);
    }
}
