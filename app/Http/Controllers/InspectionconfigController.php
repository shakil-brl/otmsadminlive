<?php

namespace App\Http\Controllers;

use App\Models\Inspectionconfig;
use Illuminate\Http\Request;

/**
 * Class InspectionconfigController
 * @package App\Http\Controllers
 */
class InspectionconfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspectionconfigs = Inspectionconfig::paginate();

        return view('inspectionconfig.index', compact('inspectionconfigs'))
            ->with('i', (request()->input('page', 1) - 1) * $inspectionconfigs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inspectionconfig = new Inspectionconfig();
        return view('inspectionconfig.create', compact('inspectionconfig'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        request()->validate(Inspectionconfig::$rules);

        $inspectionconfig = Inspectionconfig::create($request->all());
        //dd($inspectionconfig);

        return redirect()->route('inspectionconfigs.index')
            ->with('success', 'Inspectionconfig created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inspectionconfig = Inspectionconfig::find($id);

        return view('inspectionconfig.show', compact('inspectionconfig'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inspectionconfig = Inspectionconfig::find($id);

        return view('inspectionconfig.edit', compact('inspectionconfig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Inspectionconfig $inspectionconfig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspectionconfig $inspectionconfig)
    {
        request()->validate(Inspectionconfig::$rules);

        $inspectionconfig->update($request->all());

        return redirect()->route('inspectionconfigs.index')
            ->with('success', 'Inspectionconfig updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $inspectionconfig = Inspectionconfig::find($id)->delete();

        return redirect()->route('inspectionconfigs.index')
            ->with('success', 'Inspectionconfig deleted successfully');
    }
}