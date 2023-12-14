<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{
    public function showTokenForm()
    {
        //dd(Auth::check());
        // Session::flush();
        if (session('access_token.access_token')) {
            return redirect()->route('admins.dashboard');
        }

        //return view('token-form');
        return view('auth.users.signin');
    }

    public function getToken(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        try {
            $client = new Client();
            $app_url = \Str::finish(config('app.api_url'), '/');
            $loginApiEndpoint = $app_url . 'login';
            $roleApiEndpoint = $app_url . 'permissions';

            $loginOptions = [
                'multipart' => [
                    ['name' => 'email', 'contents' => $email],
                    ['name' => 'password', 'contents' => $password],
                ],
            ];
            $loginResponse = $client->post($loginApiEndpoint, $loginOptions);
            $loginData = json_decode($loginResponse->getBody(), true);
            // Check if login was successful
            if (!isset($loginData['access_token'])) {
                throw new \Exception('Login failed');
            }
            $roleOptions = [
                'headers' => [
                    'Authorization' => 'Bearer ' . $loginData['access_token'],
                ],
            ];

            $profileId = $loginData['userType']['ProfileId'];
            $roleApiEndpoint = $app_url . "role-permissions/$profileId";
            // dd($profileId, $roleApiEndpoint);
            $roleResponse = $client->get($roleApiEndpoint, $roleOptions);
            $roleData = json_decode($roleResponse->getBody(), true);

            $permissionNames = [];
            foreach ($roleData['accessPermissions']['permissions'] as $permission) {
                $permissionNames[] = $permission['name'];
            }

            // If you want to remove duplicates, use array_unique
            //$permissionNames = array_unique($permissionNames);
            //dd($permissionNames);

            // $timestamp = 1702931558;
            // $dateTime = date("Y-m-d H:i:s", $timestamp);
            // echo $dateTime;
            // dd($loginData['expires_in']);
            // $permissionNames = array_unique(array_column($permissionResponse['data'], 'name'));

            $tokenData = [
                'access_token' => $loginData['access_token'],
                'authUser' => $loginData['user'],
                'userType' => $loginData['userType'],
                'role' => $loginData['userType']['role']['name'],
                'expires_at' => now()->addMinutes($loginData['expires_in']),
                'rolePermission' => array_unique($permissionNames) ?? [], // Assuming permissions are in 'data' key
            ];
            session()->put('access_token', $tokenData);

            //dd(session()->all());
            //session('access_token.access_token');
            return redirect()->route('admins.dashboard');


            // if ($accessToken) {
            //     $tokenData = [
            //         'access_token' => $accessToken,
            //         'expires_at' => now()->addMinutes($data['expires_in']),
            //     ];
            //     session(['access_token' => $tokenData]);
            // }


        } catch (\Exception $e) {
            return redirect()->route('login.show')->with('error', 'Please check your credentials and try again.');
        }
    }

    public function logout()
    {
        try {
            $response = ApiHttpClient::request('post', 'logout');
            $responseData = $response->json();

            if ($responseData['success'] == true) {
                session()->flush();
                return redirect('/')->with('success', 'Logout successful');
            } else {
                session()->flush();
                return redirect('/')->with('error', 'Logout successful');
            }
        } catch (\Throwable $th) {
            session()->flush();
            return redirect('/')->with('error', 'Logout successful');
        }

    }

}
