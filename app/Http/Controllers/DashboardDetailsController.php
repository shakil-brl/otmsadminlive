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
        $total_batches = ApiHttpClient::request('get', 'detail/total-batch', [
            ...$request->all(),
            'page' => $request->page ?? 1,
        ])->json();
        //dd($total_batches);
        if ($total_batches['success'] == true) {
            $batches = $total_batches['data']['data'];
            // dd($batches);
            $paginator = $this->customPaginate($total_batches, $request, route('dashboard_details.total_batches'));
            return view('dashboard_details.total_batches', ['total_batches' => $batches, 'paginator' => $paginator, 'from_no' => $total_batches['data']['from']]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $total_batches['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    // 
    public function runningBatches(Request $request)
    {
        $running_batches = ApiHttpClient::request('get', 'detail/running-batch', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($running_batches);
        if ($running_batches['success'] == true) {
            $batches = $running_batches['data']['data'];
            $paginator = $this->customPaginate($running_batches, $request, route('dashboard_details.running_batches'));
            $from = $running_batches['data']['from'];

            return view('dashboard_details.running_batches', ['running_batches' => $batches, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $running_batches['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    // 
    public function completeBatches(Request $request)
    {
        $complete_batches = ApiHttpClient::request('get', 'detail/complete-batch', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($complete_batches);
        if ($complete_batches['success'] == true) {
            $batches = $complete_batches['data']['data'];
            $paginator = $this->customPaginate($complete_batches, $request, route('dashboard_details.complete_batches'));
            $from = $complete_batches['data']['from'];

            return view('dashboard_details.complete_batches', ['complete_batches' => $batches, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $complete_batches['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
        //return view('dashboard_details.complete_batches');
    }

    // 
    public function ongoingClasses(Request $request)
    {
        return view('dashboard_details.ongoing_classes', ['status' => $request->status ?? '']);
    }

    // 
    public function completeClasses(Request $request)
    {
        $complete_classes = ApiHttpClient::request('get', 'detail/class-complete', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($complete_classes);
        if ($complete_classes['success'] == true) {
            $batches = $complete_classes['data']['data'];
            $paginator = $this->customPaginate($complete_classes, $request, route('dashboard_details.complete_classes'));
            $from = $complete_classes['data']['from'];

            return view('dashboard_details.complete_classes', ['complete_classes' => $batches, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $complete_classes['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
        //return view('dashboard_details.complete_batches');
    }

    public function districts(Request $request)
    {
        $total_districts = ApiHttpClient::request('get', 'detail/district', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        if ($total_districts['success'] == true) {
            $districts = $total_districts['data']['data'];
            $paginator = $this->customPaginate($total_districts, $request, route('dashboard_details.districts'));
            $from = $total_districts['data']['from'];

            return view('dashboard_details.districts', ['total_districts' => $districts, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $total_districts['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    // 
    public function upazilas(Request $request)
    {
        $total_upazilas = ApiHttpClient::request('get', 'detail/upazila', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
            'new_data' => 'yes',
        ])->json();

        if ($total_upazilas['success'] == true) {
            $upazilas = $total_upazilas['data']['data'];
            $paginator = $this->customPaginate($total_upazilas, $request, route('dashboard_details.upazilas'));
            $from = $total_upazilas['data']['from'];

            return view('dashboard_details.upazilas', ['total_upazilas' => $upazilas, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $total_upazilas['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    // 
    public function partners(Request $request)
    {
        $total_partners = ApiHttpClient::request('get', 'detail/development-partner', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($total_partners);
        if ($total_partners['data'] == true) {
            $partners = $total_partners['data']['data'];
            $paginator = $this->customPaginate($total_partners, $request, route('dashboard_details.partners'));
            $from = $total_partners['data']['from'];

            return view('dashboard_details.partners', ['total_partners' => $partners, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $total_partners['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    // 
    public function trainers(Request $request)
    {
        $total_trainers = ApiHttpClient::request('get', 'detail/trainer-total', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        // dd($total_trainers);
        if ($total_trainers['success'] == true) {

            $trainers = $total_trainers['data']['data'];
            //  dd($trainers);
            $paginator = $this->customPaginate($total_trainers, $request, route('dashboard_details.trainers'));
            $from = $total_trainers['data']['from'];
            // dd($from);
            return view('dashboard_details.trainers', ['total_trainers' => $trainers, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $total_trainers['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
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
