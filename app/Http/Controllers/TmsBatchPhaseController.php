<?php

// app/Http/Controllers/Api/TrainingMonitoring/TmsBatchPhaseController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrainingMonitoring\TmsBatchPhase;
use Illuminate\Http\Request;

class TmsBatchPhaseController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $batchPhases = TmsBatchPhase::all();
        return response()->json(['data' => $batchPhases], 200);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'phase_id' => 'required|exists:tms_phases,id',
            'training_batch_id' => 'required|integer',
            'remark' => 'required|string|max:255',
        ]);

        $batchPhase = TmsBatchPhase::create($request->all());

        return response()->json(['data' => $batchPhase], 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $batchPhase = TmsBatchPhase::findOrFail($id);
        return response()->json(['data' => $batchPhase], 200);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'phase_id' => 'required|exists:tms_phases,id',
            'training_batch_id' => 'required|integer',
            'remark' => 'required|string|max:255',
        ]);

        $batchPhase = TmsBatchPhase::findOrFail($id);
        $batchPhase->update($request->all());

        return response()->json(['data' => $batchPhase], 200);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $batchPhase = TmsBatchPhase::findOrFail($id);
        $batchPhase->delete();

        return response()->json(['message' => 'Batch Phase deleted successfully'], 200);
    }
}
