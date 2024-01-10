<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class ClassDocumentController extends Controller
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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tms_batch_schedule_detail_id' => 'required',
            'document_title' => 'required',
            'description' => 'required',
            'doc_file' => 'required'
        ]);

        $document = $request->except('doc_file');

        if ($request->hasFile('doc_file')) {
            $file = $request->file('doc_file');
            // $document['doc_type'] = $file->getClientOriginalExtension();
            $document['doc_type'] = 1;
            $document['document_path'] = $this->classFileUpload($file, $data['tms_batch_schedule_detail_id']);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', 'File not found.')->withInput();
        }
        $data = ApiHttpClient::request('post', 'class-document', $document)->json();

        if ($data['success'] == false) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('schedule-class-documents.index', $request->tms_batch_schedule_detail_id);
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
        $document =  ApiHttpClient::request('get', "class-document/$id")->json();
        $results = ApiHttpClient::request('delete', "class-document/$id")->json();

        if ($results['success'] == true && $document['success'] == true) {
            $filePath = storage_path('app/public/' . $document['data']['document_path']);
            $this->removeFile($filePath);

            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Deleted successfully');
            return redirect()->back();
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Class Document for specific schedule_details_id/class
     */
    public function scheduleDocument(Request $request, $schedule_details_id)
    {
        $results = ApiHttpClient::request('get', 'class-document', [
            'schedule_details_id' => $schedule_details_id,
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $paginator = $this->customPaginate($results, $request, route('schedule-class-documents.index', $schedule_details_id));
            // dd($results);
            return view('schedule-details.class-document', ['schedule_details_id' => $schedule_details_id, 'results' => $results['data'], 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function createDocument($schedule_details_id)
    {
        return view('class-document.create', compact('schedule_details_id'));
    }
}
