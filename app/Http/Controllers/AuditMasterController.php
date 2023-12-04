<?php

namespace App\Http\Controllers;

use App\Models\AuditMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AuditMasterController
 * @package App\Http\Controllers
 */
class AuditMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auditMasters = AuditMaster::paginate();

        return view('audit-master.index', compact('auditMasters'))
            ->with('i', (request()->input('page', 1) - 1) * $auditMasters->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auditMaster = new AuditMaster();
        $batches = DB::table('training_batches')->pluck('batchCode', 'id')->prepend('', 'Select')->toArray();

        $users = DB::table('users')->pluck('username', 'id')->prepend('', 'Select')->toArray();

        return view('audit-master.create', compact('auditMaster', 'batches', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AuditMaster::$rules);

        $auditMaster = AuditMaster::create($request->all());

        return redirect()->route('audit-masters.index')
            ->with('success', 'AuditMaster created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auditMaster = AuditMaster::find($id);

        return view('audit-master.show', compact('auditMaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auditMaster = AuditMaster::find($id);

        return view('audit-master.edit', compact('auditMaster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AuditMaster $auditMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditMaster $auditMaster)
    {
        request()->validate(AuditMaster::$rules);

        $auditMaster->update($request->all());

        return redirect()->route('audit-masters.index')
            ->with('success', 'AuditMaster updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $auditMaster = AuditMaster::find($id)->delete();

        return redirect()->route('audit-masters.index')
            ->with('success', 'AuditMaster deleted successfully');
    }
}