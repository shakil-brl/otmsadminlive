<?php // app/Http/Clients/ApiHttpClient.php

namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApiHttpClient
{
    public static function request($method, $url, $options = [])
    {
        $app_url = Str::finish(config('app.api_url'), '/');
        $accessToken = session('access_token');
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken['access_token']
        ];
        // dd($headers, $app_url . $url);
        return Http::withHeaders($headers)->$method($app_url . $url, $options);
    }
}
