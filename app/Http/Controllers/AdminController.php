<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Clients\ApiHttpClient;

class AdminController extends Controller
{

   

    public function index()
    {
        $role = Session::get('access_token.role');
        return view('admins.index', compact('role'));
    }

    public function dashboard()
    {
         
        $response = ApiHttpClient::request('get', 'dashboardtotal/superadmin');

       // dd(  $response);
        $data = $response->json()['data'];
        if (isset($data['success'])) {
            if ($data['success'] !== true) {
                abort(403, 'Unauthorized');
            }
        } else {
            if (isset($data['message'])) {
                return $data['message'];
            } else {

                $data = $data;

                return view('admins.dashboard', compact('data'));
                return "API Server Error";
            }
        }
    }

    public function profile()
    {
        // return view('admins.profile');
        return view('admins.my-account');
    }

    public function show($userProfileId)
    {
        return view('admins.show', compact('userProfileId'));
    }
}
