<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        return view('admins.dashboard');
        /*$response = ApiHttpClient::request('get', 'dashboardtotal/superadmin');
        $data = $response->json()['data'];

        $classes = ApiHttpClient::request(
            'get',
            'detail/class-running',
            [
                'per_page' => 1,
                'from_date' => Carbon::now()->toDateString(),
                'to_date' => Carbon::now()->toDateString(),
            ]
        )->json();


        // dd($data);
        if (isset($data['success'])) {
            if ($data['success'] !== true) {
                abort(403, 'Unauthorized');
            }
        } else {
            if (isset($data['message'])) {
                return $data['message'];
            } else {
                $total_ongoing = $classes['data']['total'];

                return view('admins.dashboard', compact('data', 'total_ongoing'));
            }
        }*/
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
