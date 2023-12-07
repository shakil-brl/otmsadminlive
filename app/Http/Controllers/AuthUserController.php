<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

class AuthUserController extends Controller
{
    public function storeAuthUser(Request $request)
    {
        $flag = $request->input('authStatus');
        $authUser = array();
        if ($flag == 'login') {
            $authUser = $request->input('authUser');
            $rolePermission = $request->input('rolePermission');
            session(['authUser' => $authUser]);
            session(['rolePermission' => $rolePermission]);

            $routePermissions = Session::get('rolePermission');
            $accessArr = array();
            if (count($routePermissions) > 0) {
                foreach ($routePermissions as $access) {
                    array_push($accessArr, $access['name']);
                }
            }
            session(['accessPermission' => $accessArr]);
            $messge = 'AuthUser data stored successfully';
        } elseif ($flag == 'logout') {
            $request->session()->forget(['authUser']);
            $request->session()->forget(['rolePermission']);
            $request->session()->forget(['accessPermission']);

            $request->session()->forget(['accessToken']);
            $request->session()->forget(['tokenType']);

            Session::flush();
            Auth::logout();
            $messge = 'AuthUser data removed successfully';
        }

        return response()->json(['message' => $messge, 'user' => $authUser]);
    }

    public function authError()
    {
        $authUser = Session::get('authUser');
        return response()->view('errors.unauthorised', compact('authUser'));
    }
}
