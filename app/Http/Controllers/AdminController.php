<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // admin users view files

    public function index()
    {
        return view('admins.index');
    }

    public function dashboard()
    {

        $app_url = Str::finish(config('app.api_url'), '/');

        $response = Http::withHeaders([
            'Authorization' => Session::get('tokenType') . ' ' . Session::get('accessToken'),
        ])->get($app_url . 'dashboard/summery');
        // dd($response->json());

        $data = $response->json()['data'];


        if (isset($data['success'])) {
            if ($data['success'] !== true) {
                abort(403, 'Unauthorized');
            }
        } else {
            if (isset($data['message'])) {
                return $data['message'];
            } else {

                return view('admins.dashboard', compact('data'));
                return "API Server Error";
            }
        }
    }

    public function profile()
    {
        return view('admins.profile');
    }

    public function show($userProfileId)
    {
        return view('admins.show', compact('userProfileId'));
    }
}
