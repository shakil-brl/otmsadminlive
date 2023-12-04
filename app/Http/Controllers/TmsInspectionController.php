<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use Ramsey\Uuid\Rfc4122\TimeTrait;
use Session;
use \App\Models\TmsInspection;

class TmsInspectionController extends Controller
{
    use TimeTrait;
    public function index()
    {
        return view('tms-inspection.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return auth()->user();
        $data = $request->all();
        $data['tmsInspection'] = new TmsInspection();
        return view('tms-inspection.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $all = request()->validate(TmsInspection::$rules);


        $response = Http::withHeaders([
            'Authorization' => Session::get('tokenType') . ' ' . Session::get('accessToken'),
        ])->post($this->app_url . 'inspection', $request->all());

        $data = $response->json();
        $data = $response->json();

        if (isset($data['error'])) {
            if ($data['error'] == true) {
                $error = $data['message'];
                return redirect()->back()->with('error', $error)->withInput();
            }
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Schedule created succesfully');
            //return redirect('batch_schedules');
            return to_route('inspaction.index');
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Schedule created succesfully');
            return to_route('inspaction.index');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tmsInspection = Http::withHeaders([
            'Authorization' => Session::get('tokenType') . ' ' . Session::get('accessToken'),
        ])
            ->get($this->app_url . "inspection/$id")
            ->json();

        // dd($tmsInspection);

        return view('tms-inspection.show', compact('tmsInspection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tmsInspection = TmsInspection::find($id);

        return view('tms-inspection.edit', compact('tmsInspection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TmsInspection $tmsInspection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TmsInspection $tmsInspection)
    {
        request()->validate(TmsInspection::$rules);

        $tmsInspection->update($request->all());

        return redirect()->route('tms-inspections.index')
            ->with('success', 'TmsInspection updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tmsInspection = TmsInspection::find($id)->delete();

        return redirect()->route('tms-inspections.index')
            ->with('success', 'TmsInspection deleted successfully');
    }
}