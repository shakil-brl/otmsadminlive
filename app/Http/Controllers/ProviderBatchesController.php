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
    public function index(Request $request)
    {
        $request->search = 'Resource';
        $provider_batches = ApiHttpClient::request('get', 'vendor-batches', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        
        if ($provider_batches['success'] == true) {
            $batches = $provider_batches['data']['data'];
            $paginator = $this->customPaginate($provider_batches, $request, route('provider_batches.provider_batches'));

            return view('provider_batches.provider_batches', ['provider_batches' => $batches, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
        //return view('dashboard_details.complete_batches');
    }

   
}
