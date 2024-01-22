<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainingProviderPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'provider-partner')->json();

        if ($results['success'] == true) {
            $partners = $results['data'];
            $data = [
                'results' => $partners,
            ];
            $page_from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('training-provider-partners.index'));
            // dd($partners);
            return view('development_partner.index', $data);
            return view('development_partner.index', ['results' => $partners, 'paginator' => $paginator, 'page_from' => $page_from]);
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
        $provider_results = ApiHttpClient::request('get', 'providers')->json();

        // dd($provider_results);
        if ($provider_results['success'] == true) {
            $data['providers'] = $provider_results['data'];

            return view('development_partner.create', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
        // return view('development_partner.create');
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
            'developmentPartnerId' => 'required',
            'onBoardDate' => 'required|date_format:d/m/Y'
        ]);

        $partner = $request->except(['onBoardDate', 'isActive']);

        if ($request->isActive) {
            $partner['isActive'] = 1;
        } else {
            $partner['isActive'] = 0;
        }

        $partner['onBoardDate'] = Carbon::createFromFormat('d/m/Y', $request->onBoardDate)->format('Y-m-d');

        $data = ApiHttpClient::request('post', 'provider-partner', $partner)->json();

        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('training-provider-partners.index');
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
        $results = ApiHttpClient::request('get', "provider-partner/$id")->json();
        $provider_results = ApiHttpClient::request('get', 'providers')->json();

        if ($results['success'] == true && $provider_results['success'] == true) {
            $data['providers'] = $provider_results['data'];
            $data['partner'] = $results['data'];
            return view('development_partner.edit', $data);
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
            'developmentPartnerId' => 'required',
            'onBoardDate' => 'required|date_format:d/m/Y'
        ]);

        $partner = $request->except(['onBoardDate', 'isActive']);

        if ($request->isActive) {
            $partner['isActive'] = 1;
        } else {
            $partner['isActive'] = 0;
        }

        $partner['onBoardDate'] = Carbon::createFromFormat('d/m/Y', $request->onBoardDate)->format('Y-m-d');

        $data = ApiHttpClient::request("put", "provider-partner/$id", $partner)->json();

        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Updated successfully');
            return redirect()->route('training-provider-partners.index');
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
        $results = ApiHttpClient::request('delete', "provider-partner/$id")->json();

        if ($results['success'] == true) {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Deleted successfully');
            return redirect()->route('training-provider-partners.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('training-provider-partners.index');
        }
    }
}
