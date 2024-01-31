<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PDF;

class BatchReportController extends Controller
{
    // show ui for all provider item
    public function index(Request $request)
    {
        // dd($request->search);
        $provider_results = ApiHttpClient::request('get', 'providerlist', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        if ($provider_results['items'] == true) {
            $data['providers'] = $provider_results['items']['data'];
            $data['page_from'] = $provider_results['items']['from'];
            $data['paginator'] = $this->customPaginate2($provider_results, $request, route('batch.report'));
            return view('batch-report.index', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    // all batches for specific vendor
    public function vendorBatches($vendorId ,Request $request)
    {
        $results = ApiHttpClient::request('get', 'vendor-batches/'.$vendorId, [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $page_from = $results['data']['from'];
            $provider = $results['vendorInfo'];
            $paginator = $this->customPaginate2($results, $request, route('vendor.batches',$vendorId));
            return view('batch-report.batches', ['results' => $results['data']['data'],'provider' => $provider, 'paginator' => $paginator, 'page_from'=> $page_from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // all schedule details for specific vendor batch
    public function vendorBatchSchedule($scheduleId ,Request $request)
    {
        $results = ApiHttpClient::request('get', 'vendor-batch-schedule/'.$scheduleId)->json();   
       
        if ($results['success'] == true) {
            return view('batch-report.schedule', ['results' => $results['data']]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // all schedule details for specific vendor batch
    public function vendorBatchScheduleAttendance($scheduleDetailsId ,Request $request)
    {
        $results = ApiHttpClient::request('get', 'vendor-batch-schedule-attendance/'.$scheduleDetailsId)->json();   
       //dd($results);
        if ($results['success'] == true) {
            return view('batch-report.attendance', ['results' => $results['data']]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

  
    // all batches for specific vendor
    public function batchesWithoutSchedule(Request $request)
    {
        $results = ApiHttpClient::request('get', 'batches/without-schedule', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json(); 
        if ($results['success'] == true) {
            $data['without_schedule'] = $results['items']['data'];
            $data['page_from'] = $results['items']['from'];
            //$data['paginator'] = $this->customPaginate2($results, $request, route('without-batch-schedule.report'));
            $data['paginator'] = $this->customPaginate2($results, $request, route('without-schedule.report'));
            
            return view('batch-report.without_batch_schedule', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // all batches for specific vendor
    public function batchesScheduleNotStartClass(Request $request)
    {
        $results = ApiHttpClient::request('get', 'batches/not-started-schedule', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json(); 
        if ($results['success'] == true) {
            $data['not_schedule'] = $results['items']['data'];
            $data['page_from'] = $results['items']['from'];
            //$data['paginator'] = $this->customPaginate2($results, $request, route('without-batch-schedule.report'));
            $data['paginator'] = $this->customPaginate2($results, $request, route('not-start-class.report'));
            
            return view('batch-report.not_start_class', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function batchWithoutSchedulePdf(Request $request){
        $page = $request->page;
        $search = $request->search == 'null' ? ' ': $request->search;
        $results = ApiHttpClient::request('get', 'batches/without-schedule', [
            'page' => $request->page ?? 1,
            'search' => $search,
        ])->json(); 
        $page_from = $results['items']['from'];

        $pdf = PDF::loadView('batch-report.without_batch_schedule_pdf', compact('results','page_from'));
        return $pdf->stream('withoutBatchSchedule.pdf'); 

    }

    public function batchesScheduleNotStartClassPdf(Request $request){
        $page = $request->page;
        $search = $request->search == 'null' ? ' ': $request->search;
        $results = ApiHttpClient::request('get', 'batches/not-started-schedule', [
            'page' => $request->page ?? 1,
            'search' => $search,
        ])->json(); 

        $pdf = PDF::loadView('batch-report.not_start_class_pdf', compact('results'));
        return $pdf->stream('notStartBatchScheduleClass.pdf'); 

    }
    

}
