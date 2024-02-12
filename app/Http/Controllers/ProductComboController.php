<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class ProductComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'product-combo', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $product_combos = $results['data'];
            $page_from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('product-combos.index'));
            // dd($product_combos);
            return view('product_combos.index', ['results' => $product_combos, 'paginator' => $paginator, 'page_from' => $page_from]);
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
        $results = ApiHttpClient::request('get', 'tms-phases')->json();
        $products_results = ApiHttpClient::request('get', 'product')->json();
        if ($results['data'] && $products_results['success'] == true) {
            $data = [
                'phases' => $results['data'],
                'products' => $products_results['data']['data']
            ];
            // dd($data);
            return view('product_combos.create', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
        return view('product-combos.create');
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
            'name' => 'required',
            'phase_id' => 'required',
            'products' => 'required|array|min:1',
            'quantities' => 'required|array|min:1',
        ]);

        $product_combo = $request->except(['isActive']);
        $product_combo["org_id"] = 13;

        if ($request->is_active) {
            $product_combo['is_active'] = 1;
        } else {
            $product_combo['is_active'] = 0;
        }

        $result = ApiHttpClient::request("POST", "product-combo", $product_combo)->json();

        if (isset($result['error'])) {
            $errors = $result['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $errors)->withInput();
        } else if ($result['success'] != true) {
            session()->flash('type', 'Danger');
            session()->flash('message', $result['message'] ?? 'Something wrong');
            return redirect()->route('product-combos.index');
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $result['message'] ?? 'Created successfully');
            return redirect()->route('product-combos.index');
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
        $results = ApiHttpClient::request('get', "product-combo/$id")->json();
        $results_phase = ApiHttpClient::request('get', 'tms-phases')->json();
        $products_results = ApiHttpClient::request('get', 'product')->json();

        if ($results['success'] == true && $results_phase['data'] && $products_results['success'] == true) {
            $product_combo = $results['data'];
            $data = [
                'product_combo' => $product_combo,
                'phases' => $results_phase['data'],
                'products' => $products_results['data']['data']
            ];

            return view('product_combos.edit', $data);
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
        $request->validate([
            'name' => 'required',
            'phase_id' => 'required',
            'products' => 'required|array|min:1',
            'quantities' => 'required|array|min:1',
        ]);

        $product_combo = $request->except(['isActive']);
        $product_combo["org_id"] = 13;

        if ($request->is_active) {
            $product_combo['is_active'] = 1;
        } else {
            $product_combo['is_active'] = 0;
        }

        $result = ApiHttpClient::request("PUT", "product-combo/$id", $product_combo)->json();
        // dd($result);
        if (isset($result['error'])) {
            $errors = $result['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $errors)->withInput();
        } else if ($result['success'] != true) {
            session()->flash('type', 'Danger');
            session()->flash('message', $result['message'] ?? 'Something wrong');
            return redirect()->route('product-combos.index');
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $result['message'] ?? 'Updated successfully');
            return redirect()->route('product-combos.index');
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
        $results = ApiHttpClient::request('delete', "product-combo/$id")->json();

        if ($results['success'] == true) {
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->route('product-combos.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('product-combos.index');
        }
    }
}
