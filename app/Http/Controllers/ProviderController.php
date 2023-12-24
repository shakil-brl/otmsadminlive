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
        $provider_results = ApiHttpClient::request('get', 'partnerslist', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        // dd($results);
        if ($provider_results['success'] == true) {
            $data['providers'] = $provider_results['data']['data'];
            $data['page_from'] = $provider_results['data']['from'];
            $data['paginator'] = $this->customPaginate($provider_results, $request, route('providers.index'));

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
        $previousRouteUrl = url()->previous();
        $previousRouteName = app('router')->getRoutes()->match(app('request')->create($previousRouteUrl))->getName();
        $from_edit = false;
        // dd($previousRouteName);
        if ($previousRouteName == "providers.show") {
            $from_edit = true;
        }
        // dd($from_edit);
        if ($provider_id) {
            $results = ApiHttpClient::request('get', 'providers/' . $provider_id . '/show')->json();

            if ($results['success'] == true) {
                $provider = $results['data'];
                // dd($provider);
                return view('providers.enroll_batches', compact('provider', 'from_edit'));
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
