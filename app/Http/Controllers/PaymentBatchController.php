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
    public function index()
    {
        //
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
        // dd($request->all());

        $request->validate([
            'batch_id' => 'required|numeric',
            'daily_allowance' => 'required',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y|after_or_equal:start_date',
            'total_payment_amount' => 'required|numeric',
            'remark' => 'nullable|string',
        ]);

        $batch_payment = $request->only(['batch_id', 'daily_allowance', 'total_payment_amount']);

        if ($request->status) {
            $batch_payment['status'] = 1;
        } else {
            $batch_payment['status'] = 0;
        }

        $batch_payment['start_date'] = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $batch_payment['end_date'] = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        dd($batch_payment);
        $data = ApiHttpClient::request('post', 'payment-batches', $batch_payment)->json();
        //dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();

            // return redirect()->route('holydays.index');
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('holydays.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
