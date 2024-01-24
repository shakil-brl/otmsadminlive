<?php

// app/Http/Controllers/Api/TrainingMonitoring/TmsPhaseController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingMonitoring\TmsPhase;
use Illuminate\Http\Request;

class TmsPhaseController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        return view('tmsphasec.index');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_bn' => 'nullable|string|max:50',
            'remark' => 'required|string|max:255',
        ]);

        $phase = TmsPhase::create($request->all());

        return response()->json(['data' => $phase], 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $phase = TmsPhase::findOrFail($id);
        return response()->json(['data' => $phase], 200);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_bn' => 'nullable|string|max:50',
            'remark' => 'required|string|max:255',
        ]);

        $phase = TmsPhase::findOrFail($id);
        $phase->update($request->all());

        return response()->json(['data' => $phase], 200);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $phase = TmsPhase::findOrFail($id);
        $phase->delete();

        return response()->json(['message' => 'Phase deleted successfully'], 200);
    }
}
