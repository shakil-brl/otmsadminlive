<?php
namespace App\Http\Controllers;
use App\Models\TmsEvaluationForTrainer;
use Illuminate\Http\Request;

class TmsEvaluationForTrainerController extends Controller
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

        $data['tmsEvaluationForTrainers'] = TmsEvaluationForTrainer::paginate();

        return view('tms-evaluation-for-trainer.index', $data);
    }

    public function create()
    {
        $data['tmsEvaluationForTrainer'] = new TmsEvaluationForTrainer();
        return view('tms-evaluation-for-trainer.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsEvaluationForTrainer::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsEvaluationForTrainer = TmsEvaluationForTrainer::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsEvaluationForTrainer created successfully.',
        ];
        return redirect()->route('evaluation-for-trainer.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsEvaluationForTrainer'] = TmsEvaluationForTrainer::find($id);

        return view('tms-evaluation-for-trainer.show', $data);
    }

    public function edit($id)
    {
        $data['tmsEvaluationForTrainer'] = TmsEvaluationForTrainer::find($id);

        return view('tms-evaluation-for-trainer.edit', $data);
    }

    public function update(Request $request, TmsEvaluationForTrainer $tmsEvaluationForTrainer)
    {


        request()->validate(TmsEvaluationForTrainer::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsEvaluationForTrainer->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsEvaluationForTrainer updated successfully.',
        ];
        return redirect()->route('evaluation-for-trainer.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsEvaluationForTrainer = TmsEvaluationForTrainer::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsEvaluationForTrainer deleted successfully.',
        ];
        return redirect()->route('evaluation-for-trainer.index')->with($alert);
    }
}
