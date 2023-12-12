<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function showTokenForm()
    {
        //dd(Auth::check());
        // dd(session()->all());
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
            $loginApiEndpoint = 'http://127.0.0.1:8080/tms-api/login';
            $roleApiEndpoint = 'http://127.0.0.1:8080/tms-api/permissions';
            // Update with your actual role endpoint
            //$apiEndpoint = 'http://127.0.0.1:8080/tms-api/login';
            // Step 1: Make the login API call
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
            $roleResponse = $client->get($roleApiEndpoint, $roleOptions);
            $roleData = json_decode($roleResponse->getBody(), true);

            $permissionNames = [];
            foreach ($roleData['data'] as $permission) {
                $permissionName = $permission['name'];
                //$permissionNames[] = $permissionName;
                $permissionNames = array_unique(array_column($roleData['data'], 'name'));
            }

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
                'rolePermission' => $permissionNames ?? [], // Assuming permissions are in 'data' key
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
}
