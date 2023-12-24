<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProviderBatchesController extends Controller
{
    protected $app_url;
    public function __construct()
    {
        $this->app_url = Str::finish(config('app.api_url'), '/');
    }
    public function index()
    {
        return view('provider_batches.index');
    }

    public function details()
    {
        return view('provider_batches.details');
    }

    

   
}
