<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use PDF;

class CertificateController extends Controller
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
    public function create($batch_id)
    {
        $batch_id = decrypt($batch_id);
        $results = ApiHttpClient::request('get', "get-batch-show/$batch_id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $batch_data = $results['data'];

            $hasCertificates = false;

            foreach ($batch_data['trainees'] as $trainee) {
                if (isset($trainee['certificate'])) {
                    $hasCertificates = true;
                    break; // Exit the loop as soon as a certificate is found
                }
            }
            // dd($hasCertificates);

            return view('certificate.create', ['batch' => $batch_data, 'has_certificate' => $hasCertificates]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
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
            'training_applicant_ids' => 'required|array',
        ]);
        $data = $request->all();
        // dd($data);
        $data = ApiHttpClient::request('post', 'certificates', $data)->json();
        // dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Distributed successfully');
            return redirect()->back();
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

    public function eligible($batch_id)
    {
        $batch_id = decrypt($batch_id);
        $results = ApiHttpClient::request('get', "get-batch-show/$batch_id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $batch_data = $results['data'];

            $hasCertificates = false;

            foreach ($batch_data['trainees'] as $trainee) {
                if (isset($trainee['certificate'])) {
                    $hasCertificates = true;
                    break; // Exit the loop as soon as a certificate is found
                }
            }
            // dd($hasCertificates);

            return view('certificate.eligible', ['batch' => $batch_data, 'has_certificate' => $hasCertificates]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function print(Request $request)
    {
        $data = [
            'foo' => 'bar'
        ];

        // return view('certificate.document', $data);
        $pdf = PDF::loadView('certificate.document', $data, [], [
            'title' => 'Another Title',
            'margin_top' => 0,
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_bottom' => 0,
        ]);

        return $pdf->stream('document.pdf');
    }



}
