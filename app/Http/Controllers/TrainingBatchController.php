<?php
namespace App\Http\Controllers;
use App\Models\TrainingBatch;
use Illuminate\Http\Request;

class TrainingBatchController extends Controller
{
    public function index()
    {

// try {
//     $data = ApiHttpClient::request('get', 'dashboardtotal/superadmin')->json()['data'];
//     return ($data['success'] ?? true) !== true ? abort(403, 'Unauthorized') : ($data['message'] ?? view('admins.dashboard', compact('data')));
//     } catch (\Exception $e) {
//     Log::error('API Request Error: ' . $e->getMessage());
//     return response()->view('errors.api', [], 500);
//     }

        $data['trainingBatches'] = TrainingBatch::paginate();

        return view('training-batch.index', $data);
    }

    public function create()
    {
        $data['trainingBatch'] = new TrainingBatch();
        return view('training-batch.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TrainingBatch::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $trainingBatch = TrainingBatch::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TrainingBatch created successfully.',
        ];
        return redirect()->route('training-batche.index')->with($alert);
    }

    public function show($id)
    {
        $data['trainingBatch'] = TrainingBatch::find($id);

        return view('training-batch.show', $data);
    }

    public function edit($id)
    {
        $data['trainingBatch'] = TrainingBatch::find($id);

        return view('training-batch.edit', $data);
    }

    public function update(Request $request, TrainingBatch $trainingBatch)
    {


        request()->validate(TrainingBatch::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $trainingBatch->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TrainingBatch updated successfully.',
        ];
        return redirect()->route('training-batche.index')->with($alert);
    }

    public function destroy($id)
    {
        $trainingBatch = TrainingBatch::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TrainingBatch deleted successfully.',
        ];
        return redirect()->route('training-batche.index')->with($alert);
    }
}
