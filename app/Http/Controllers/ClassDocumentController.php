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
        //
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

    /**
     * Class Document for specific schedule_details_id/class
     */
    public function scheduleDocument(Request $request, $schedule_details_id)
    {
        $results = ApiHttpClient::request('get', 'class-document', [
            'schedule_details_id' => $schedule_details_id,
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])
            ->json();

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
