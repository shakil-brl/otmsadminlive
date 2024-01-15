<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    // show ui for all provider item
    public function index(Request $request)
    {
        // dd($request->search);
        $provider_results = ApiHttpClient::request('get', 'providerlist', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        // dd($provider_results);
        if ($provider_results['items'] == true) {
            $data['providers'] = $provider_results['items']['data'];
            $data['page_from'] = $provider_results['items']['from'];
            $data['paginator'] = $this->customPaginate2($provider_results, $request, route('providers.index'));

            return view('providers.index', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    // show ui for induvisual provider item
    public function show($id)
    {
        if ($id) {
            $results = ApiHttpClient::request('get', 'providers/' . $id . '/show')->json();

            if ($results['success'] == true) {
                $provider = $results['data'];
                // dd($provider);
                return view('providers.show', compact('provider'));
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', 'Something went wrong');
                return redirect()->back();
            }
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function allTrainer()
    {
        return 0;
    }

    public function enrollBatch($provider_id, Request $request)
    {
        if ($provider_id) {
            $results = ApiHttpClient::request('get', 'providers/' . $provider_id . '/show')->json();

            if ($results['success'] == true) {
                $provider = $results['data'];
                // dd($provider);
                return view('providers.enroll_batches', compact('provider'));
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', 'Something went wrong');
                return redirect()->back();
            }
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }
}
