<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'product', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $products = $results['data'];
            $page_from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('products.index'));
            // dd($products);
            return view('products.index', ['results' => $products, 'paginator' => $paginator, 'page_from' => $page_from]);
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
        return view("products.create");
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
            "name" => "required",
        ]);

        $product = $request->except(['isActive']);
        $product["org_id"] = 13;
        if ($request->is_active) {
            $product['is_active'] = 1;
        } else {
            $product['is_active'] = 0;
        }

        $result = ApiHttpClient::request("POST", "product", $product)->json();

        if (isset($result['error'])) {
            $errors = $result['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $errors)->withInput();
        } else if ($result['success'] !== true) {
            session()->flash('type', 'Danger');
            session()->flash('message', $result['message'] ?? 'Something wrong');
            return redirect()->route('products.index');
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $result['message'] ?? 'Created successfully');
            return redirect()->route('products.index');
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
        $results = ApiHttpClient::request('get', "product/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $product = $results['data'];
            return view('products.edit', ['product' => $product]);
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
            "name" => "required",
        ]);

        $product = $request->except(['isActive']);
        $product["org_id"] = 13;
        if ($request->is_active) {
            $product['is_active'] = 1;
        } else {
            $product['is_active'] = 0;
        }

        $result = ApiHttpClient::request("PUT", "product/$id", $product)->json();

        if (isset($result['error'])) {
            $errors = $result['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $errors)->withInput();
        } else if ($result['success'] != true) {
            session()->flash('type', 'Danger');
            session()->flash('message', $result['message'] ?? 'Something wrong');
            return redirect()->route('products.index');
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $result['message'] ?? 'Updated successfully');
            return redirect()->route('products.index');
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
        $results = ApiHttpClient::request('delete', "product/$id")->json();

        if ($results['success'] == true) {
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->route('products.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('products.index');
        }
    }
}
