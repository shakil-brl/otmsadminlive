<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BatchController extends Controller
{
    // batches for provider for link trainers
    public function index()
    {
        return view('trainingBatch.index');
    }

    // all batches for higher authority
    public function all(Request $request)
    {
        $page = request('page', 1);
        $app_url = Str::finish(config('app.api_url'), '/');
        if ($request['batch_search']) {
            $search_batch = $request['batch_search'] ?? '';

            $results = ApiHttpClient::request('get', 'batches/all?batch=' . $search_batch . '&page=' . $page)->json();
        } else {
            $results = ApiHttpClient::request('get', 'batches/all?page=' . $page)->json();
        }

        if ($results['success'] == true) {
            // dd($results['data']);
            return view('batches.all', ['results' => $results['data']]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return view('batches.all');
        }
    }

    // show batch details
    public function show($batch_id)
    {
        $app_url = Str::finish(config('app.api_url'), '/');

        $results = ApiHttpClient::request('get', 'batches/' . $batch_id . '/show')
            ->json();

        return 1;
    }
}
