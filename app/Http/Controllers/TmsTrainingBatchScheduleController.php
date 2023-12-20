<?php
namespace App\Http\Controllers;
use App\Models\TmsTrainingBatchSchedule;
use Illuminate\Http\Request;

class TmsTrainingBatchScheduleController extends Controller
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

        $data['tmsTrainingBatchSchedules'] = TmsTrainingBatchSchedule::paginate();

        return view('tms-training-batch-schedule.index', $data);
    }

    public function create()
    {
        $data['tmsTrainingBatchSchedule'] = new TmsTrainingBatchSchedule();
        return view('tms-training-batch-schedule.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsTrainingBatchSchedule::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsTrainingBatchSchedule = TmsTrainingBatchSchedule::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsTrainingBatchSchedule created successfully.',
        ];
        return redirect()->route('batch-schedule.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsTrainingBatchSchedule'] = TmsTrainingBatchSchedule::find($id);

        return view('tms-training-batch-schedule.show', $data);
    }

    public function edit($id)
    {
        $data['tmsTrainingBatchSchedule'] = TmsTrainingBatchSchedule::find($id);

        return view('tms-training-batch-schedule.edit', $data);
    }

    public function update(Request $request, TmsTrainingBatchSchedule $tmsTrainingBatchSchedule)
    {


        request()->validate(TmsTrainingBatchSchedule::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsTrainingBatchSchedule->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsTrainingBatchSchedule updated successfully.',
        ];
        return redirect()->route('batch-schedule.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsTrainingBatchSchedule = TmsTrainingBatchSchedule::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsTrainingBatchSchedule deleted successfully.',
        ];
        return redirect()->route('batch-schedule.index')->with($alert);
    }
}
