<?php

namespace App\Http\Controllers;

use App\Models\AuditMasterDetail;
use Illuminate\Http\Request;

/**
 * Class AuditMasterDetailController
 * @package App\Http\Controllers
 */
class AuditMasterDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auditMasterDetails = AuditMasterDetail::paginate();

        return view('audit-master-detail.index', compact('auditMasterDetails'))
            ->with('i', (request()->input('page', 1) - 1) * $auditMasterDetails->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auditMasterDetail = new AuditMasterDetail();
        return view('audit-master-detail.create', compact('auditMasterDetail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AuditMasterDetail::$rules);

        $auditMasterDetail = AuditMasterDetail::create($request->all());

        return redirect()->route('audit-master-details.index')
            ->with('success', 'AuditMasterDetail created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auditMasterDetail = AuditMasterDetail::find($id);

        return view('audit-master-detail.show', compact('auditMasterDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auditMasterDetail = AuditMasterDetail::find($id);

        return view('audit-master-detail.edit', compact('auditMasterDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AuditMasterDetail $auditMasterDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditMasterDetail $auditMasterDetail)
    {
        request()->validate(AuditMasterDetail::$rules);

        $auditMasterDetail->update($request->all());

        return redirect()->route('audit-master-details.index')
            ->with('success', 'AuditMasterDetail updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $auditMasterDetail = AuditMasterDetail::find($id)->delete();

        return redirect()->route('audit-master-details.index')
            ->with('success', 'AuditMasterDetail deleted successfully');
    }
}