<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class TmsSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'tms-settings', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($results);
        if ($results['success'] == true) {
            $paginator = $this->customPaginate($results, $request, route('tms-settings.index'));
            // dd($results);
            return view('tms-setting.index', ['results' => $results['data'], 'paginator' => $paginator]);
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
        return view('tms-setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $data = $request->validate([
            'key' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png,gif,txt|max:5120',
        ]);

        $document = $request->except('file');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $document['type'] = $file->getClientOriginalExtension();
            // dd($document['type']);
            $document['value'] = $this->fileUpload($file);

            if (strlen($document['value']) > 100) {
                $filePath = storage_path('app/public/' . $document['value']);
                $this->removeFile($filePath);
                session()->flash('type', 'Danger');
                session()->flash('message', 'File name is too long.');
                return redirect()->back()->withInput();
            }
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'File not found.');
            return redirect()->back()->withInput();
        }
        $data = ApiHttpClient::request('post', 'tms-settings', $document)->json();

        if ($data['success'] == false) {
            $this->removeFile(storage_path('app/public/' . $document['value']));
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('tms-settings.index');
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
        $results = ApiHttpClient::request('get', "tms-settings/$id")->json();

        if ($results['success'] == true) {
            $data = $results['data'];

            return view('file-setting.edit', ['file' => $data]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
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
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = ApiHttpClient::request('get', "tms-settings/$id")->json();
        $results = ApiHttpClient::request('delete', "tms-settings/$id")->json();

        if ($results['success'] == true && $file['success'] == true) {
            $filePath = storage_path('app/public/' . $file['data']['value']);
            $this->removeFile($filePath);

            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->back();
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }
}
