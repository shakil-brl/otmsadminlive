<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class LaptopDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'laptop', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $laptop = $results['data'];
            $page_from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('laptop-distribution.index'));
            return view('laptop-distribution.index', ['results' => $laptop, 'paginator' => $paginator, 'page_from' => $page_from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
        // return view('laptop-distribution.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($batch_id)
    {
        $batch_id = decrypt($batch_id);
        $batch_results = ApiHttpClient::request('get', 'batch/' . $batch_id . '/show')
            ->json();
        $results = ApiHttpClient::request('get', "allownce/student-list/date-range", [
            "batch_id" => $batch_id,
            "end_date" => date("Y-m-d"),
        ])->json();

        // dd($results);
        if ($results['success'] == true && $batch_results['success'] == true) {
            $class_details = $results['data'];
            $batch = $batch_results['data'];

            $data = [
                'batch' => $batch,
                'class_details' => $class_details,
            ];

            return view('laptop-distribution.create', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', ($results['message'] ?? $batch_results['message']) ?? 'Something went wrong');
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
        $request->validate(
            [
                'batch_id' => 'required',
                'distribution_date' => 'required|date|before_or_equal:today',
                'total_students' => 'required|integer|gt:0',
                'remark' => 'nullable',
                'applicant_id' => 'required|array|min:1',
                'laptop_serial' => 'required|array|min:1',
                'document' => 'nullable|array|min:1',
                'agr_num' => 'required|array|min:1',
            ]
        );

        $laptop = $request->all();

        $laptop['status'] = 1;
        $laptop['total_laptop'] = count($request->applicant_id);

        // $laptop['holly_bay'] = Carbon::createFromFormat('d/m/Y', $request->holly_bay)->format('Y-m-d');

        $data = ApiHttpClient::request('post', 'laptop', $laptop)->json();
        //dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('laptop-distribution.index');
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
    public function edit($id, $batch_id)
    {
        $batch_id = decrypt($batch_id);

        $trainee_results = ApiHttpClient::request('get', "allownce/student-list/date-range", [
            "batch_id" => $batch_id,
            "end_date" => date("Y-m-d"),
        ])->json();

        $laptop_results = ApiHttpClient::request('get', "laptop/$id")->json();

        // dd($results);
        if ($laptop_results['success'] == true && $trainee_results['success'] == true) {
            $laptop = $laptop_results['data'];
            $class_details = $trainee_results['data'];
            $batch = $laptop_results['data']['training_batch'];

            $data = [
                'laptop' => $laptop,
                'class_details' => $class_details,
                'batch' => $batch
            ];
            return view('laptop-distribution.edit', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', (($trainee_results['message'] ?? $laptop_results['message'])) ?? 'Something went wrong');
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
        $request->validate(
            [
                'batch_id' => 'required',
                'distribution_date' => 'required|date|before_or_equal:today',
                'total_students' => 'required|integer|gt:0',
                'remark' => 'nullable',
                'applicant_id' => 'required|array|min:1',
                'laptop_serial' => 'required|array|min:1',
                'document' => 'nullable|array|min:1',
                'agr_num' => 'required|array|min:1',
            ]
        );

        $laptop = $request->all();

        $laptop['status'] = 1;
        $laptop['total_laptop'] = count($request->applicant_id);

        $data = ApiHttpClient::request('PUT', "laptop/$id", $laptop)->json();
        //dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('laptop-distribution.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $results = ApiHttpClient::request('delete', "laptop/$id")->json();

        if ($results['success'] == true) {
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->route('laptop-distribution.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('laptop-distribution.index');
        }
    }
}
