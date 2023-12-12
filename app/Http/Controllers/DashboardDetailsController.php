<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Clients\ApiHttpClient;

class DashboardDetailsController extends Controller
{
    // 
    public function totalBatches(Request $request)
    {
        $total_batches = ApiHttpClient::request('get', 'batchlist', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($total_batches['success'] == true) {
            $batches = $total_batches['data']['data'];
            // dd($batches);
            $paginator = $this->customPaginate($total_batches, $request, route('dashboard_details.total_batches'));
            return view('dashboard_details.total_batches', ['total_batches' => $batches, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // 
    public function runningBatches(Request $request)
    {
        $running_batches = ApiHttpClient::request('get', 'batch/running-batch', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        if ($running_batches['success'] == true) {
            $batches = $running_batches['data']['data'];
            $paginator = $this->customPaginate($running_batches, $request, route('dashboard_details.running_batches'));

            return view('dashboard_details.running_batches', ['running_batches' => $batches, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // 
    public function completeBatches()
    {
        return view('dashboard_details.complete_batches');
    }

    // 
    public function districts(Request $request)
    {
        $total_districts = ApiHttpClient::request('get', 'districtslist', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        if ($total_districts['success'] == true) {
            $districts = $total_districts['data']['data'];
            $paginator = $this->customPaginate($total_districts, $request, route('dashboard_details.districts'));

            return view('dashboard_details.districts', ['total_districts' => $districts, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // 
    public function upazilas(Request $request)
    {
        $total_upazilas = ApiHttpClient::request('get', 'upazilaslist', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        if ($total_upazilas['success'] == true) {
            $upazilas = $total_upazilas['data']['data'];
            $paginator = $this->customPaginate($total_upazilas, $request, route('dashboard_details.upazilas'));

            return view('dashboard_details.upazilas', ['total_upazilas' => $upazilas, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // 
    public function partners(Request $request)
    {
        $total_partners = ApiHttpClient::request('get', 'partnerslist', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        if ($total_partners['success'] == true) {
            $partners = $total_partners['data']['data'];
            $paginator = $this->customPaginate($total_partners, $request, route('dashboard_details.partners'));

            return view('dashboard_details.partners', ['total_partners' => $partners, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // 
    public function trainers()
    {
        return view('dashboard_details.trainers');
    }

    // 
    public function trainees()
    {
        return view('dashboard_details.trainees');
    }

    // 
    public function allowance()
    {
        return view('dashboard_details.allowance');
    }
}
