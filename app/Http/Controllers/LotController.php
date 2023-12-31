<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'lot', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $lots = $results['data'];
            $page_from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('lots.index'));
            // dd($lots);
            return view('lot.index', ['results' => $lots, 'paginator' => $paginator, 'page_from' => $page_from]);
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
        return view('lot.create');
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
            'name_bn' => 'required',
            'name_en' => 'required',
            'code' => 'required',
            'remark' => 'required'
        ]);

        $lot = $request->all();


        $data = ApiHttpClient::request('post', 'lot/', $lot)->json();
        // dd($data['message']);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('lots.index');
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
        $results = ApiHttpClient::request('get', "lot/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $group = $results['data'];
            return view('lot.show', ['lot' => $group]);
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
        $results = ApiHttpClient::request('get', "lot/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $group = $results['data'];
            return view('lot.edit', ['group' => $group]);
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
        // dd($id);
        $request->validate([
            'name_bn' => 'required',
            'name_en' => 'required',
            'code' => 'required',
            'remark' => 'required'
        ]);

        $lot = $request->all();

        $data = ApiHttpClient::request('put', "lot/$id", $lot)->json();
        // dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Updated successfully');
            return redirect()->route('lots.index');
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
        $results = ApiHttpClient::request('delete', "lot/$id")->json();

        if ($results['success'] == true) {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Deleted successfully');
            return redirect()->route('lots.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('lots.index');
        }
    }

    /**
     * link with batch
     */
    public function linkBatch($id)
    {
        // dd($id);
        if ($id) {
            $results = ApiHttpClient::request('get', 'lot/' . $id)->json();

            if ($results['success'] == true) {
                $lot = $results['data'];
                // dd($lot);
                return view('lot.link_batches', compact('lot'));
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
