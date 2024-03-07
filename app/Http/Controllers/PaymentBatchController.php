<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'payment-batches', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $payment_batches = $results['data'];
            $page_from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('payment-batches.index'));
            // dd($payment_batches);
            return view('payment-batches.index', ['results' => $payment_batches, 'paginator' => $paginator, 'page_from' => $page_from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('payment-batches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'batch_id' => 'required|numeric',
            'trainees_data' => 'required|string',
            'daily_allowance' => 'required',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y|after_or_equal:start_date',
            'total_payment_amount' => 'required|numeric',
            'remark' => 'nullable|string',
        ]);

        $batch_payment = $request->only(['batch_id', 'trainees_data', 'daily_allowance', 'total_payment_amount', 'remark']);

        // if ($request->status) {
        //     $batch_payment['status'] = 1;
        // } else {
        //     $batch_payment['status'] = 0;
        // }
        $batch_payment['status'] = 1;
        $batch_payment['start_date'] = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $batch_payment['end_date'] = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        // dd($batch_payment);
        $data = ApiHttpClient::request('post', 'payment-batches', $batch_payment)->json();

        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('payment-batches.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decrypt($id);

        $results = ApiHttpClient::request('get', "payment-batches/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $payment_details = $results['data'];
            // dd($payment_details);
            return view('payment-batches.show', ['data' => $payment_details]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = ApiHttpClient::request('get', "payment-batches/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $payment_batch = $results['data'];
            return view('payment-batches.edit', ['payment_batch' => $payment_batch]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $results = ApiHttpClient::request('delete', "payment-batches/$id")->json();

        if ($results['success'] == true) {
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->route('payment-batches.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('payment-batches.index');
        }
    }

    public function batchShow($batch_id)
    {
        $batch_id = decrypt($batch_id);

        $results = ApiHttpClient::request('get', "payment-batches/$batch_id/batch")->json();
        // dd($results);
        if ($results['success'] == true) {
            $payment_batch = $results['data'];
            return view('payment-batches.batch-show', ['payments' => $payment_batch]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }
}
