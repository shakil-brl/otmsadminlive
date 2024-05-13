<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HolydayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'holyday', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $holyday = $results['data'];
            $page_from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('holydays.index'));
            // dd($holyday);
            return view('holyday.index', ['results' => $holyday, 'paginator' => $paginator, 'page_from' => $page_from]);
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
    public function create()
    {
        return view('holyday.create');
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
            'day_name_en' => 'required',
            'day_name_bn' => 'required',
            'holly_bay' => 'required|date_format:d/m/Y'
        ]);

        $holyday = $request->except('holly_bay');

        $holyday['holly_bay'] = Carbon::createFromFormat('d/m/Y', $request->holly_bay)->format('Y-m-d');

        $data = ApiHttpClient::request('post', 'holyday', $holyday)->json();
        //dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
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
        $results = ApiHttpClient::request('get', "holyday/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $holyday = $results['data'];
            return view('holyday.edit', ['holyday' => $holyday]);
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
        // dd($request->all());
        $request->validate([
            'day_name_en' => 'required',
            'day_name_bn' => 'required',
            'holly_bay' => 'required|date_format:d/m/Y'
        ]);

        $holyday = $request->except('holly_bay');

        $holyday['holly_bay'] = Carbon::createFromFormat('d/m/Y', $request->holly_bay)->format('Y-m-d');

        $data = ApiHttpClient::request('put', "holyday/$id", $holyday)->json();
        // dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Updated successfully');
            return redirect()->route('holydays.index');
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
        $results = ApiHttpClient::request('delete', "holyday/$id")->json();

        if ($results['success'] == true) {
            // dd($holyday);
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->route('holydays.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('holydays.index');
        }
    }
}
