<?php
// GlobalVariableServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class GlobalVariableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     dd('global');
    //     $sessionVariable = Session::get('access_token.authUser');
    //     $testong = Session::get('access_token.role');

    //     View::share([

    //     ]);
    // }

    public function boot()
    {
        View::composer('*', function ($view) {
            $userAuth = Session::get('access_token.authUser') ?? 0;
            $userRole = Session::get('access_token.role') ?? 0;
            $routePermissions = Session::get('access_token.rolePermission') ?? 0;
            $roleRoutePermissions = Session::get('access_token.rolePermission') ?? 0;
            $role = Session::get('access_token.role') ?? 0;
            $authToken = Session::get('access_token.access_token');
            $view->with([
                'userAuth' => $userAuth,
                'userRole' => $userRole,
                'routePermissions' => $routePermissions,
                'roleRoutePermissions' => $roleRoutePermissions,
                'role' => $role,
                'authToken' => 'Bearer ' . $authToken,
            ]);
        });
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // If you need to register any services
    }
}
