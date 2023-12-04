<?php

namespace App\Http\Controllers;

use App\Models\Audittask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AudittaskController
 * @package App\Http\Controllers
 */
class AudittaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audittasks = Audittask::paginate();

        return view('audittask.index', compact('audittasks'))
            ->with('i', (request()->input('page', 1) - 1) * $audittasks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $audittask = new Audittask();
        $trainingtitles = DB::table('training_titles')->pluck('Name', 'id')->prepend('', 'Select')->toArray();
        $batches = DB::table('training_batches')->pluck('batchCode', 'id')->prepend('', 'Select')->toArray();
        return view('audittask.create', compact('audittask', 'trainingtitles', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Audittask::$rules);

        $audittask = Audittask::create($request->all());

        return redirect()->route('audittasks.index')
            ->with('success', 'Audittask created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audittask = Audittask::find($id);

        return view('audittask.show', compact('audittask'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audittask = Audittask::find($id);

        return view('audittask.edit', compact('audittask'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Audittask $audittask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audittask $audittask)
    {
        request()->validate(Audittask::$rules);

        $audittask->update($request->all());

        return redirect()->route('audittasks.index')
            ->with('success', 'Audittask updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $audittask = Audittask::find($id)->delete();

        return redirect()->route('audittasks.index')
            ->with('success', 'Audittask deleted successfully');
    }
}
