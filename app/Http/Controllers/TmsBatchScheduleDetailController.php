<?php
namespace App\Http\Controllers;
use App\Models\TmsBatchScheduleDetail;
use Illuminate\Http\Request;

class TmsBatchScheduleDetailController extends Controller
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

        $data['tmsBatchScheduleDetails'] = TmsBatchScheduleDetail::paginate();

        return view('tms-batch-schedule-detail.index', $data);
    }

    public function create()
    {
        $data['tmsBatchScheduleDetail'] = new TmsBatchScheduleDetail();
        return view('tms-batch-schedule-detail.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsBatchScheduleDetail::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsBatchScheduleDetail = TmsBatchScheduleDetail::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsBatchScheduleDetail created successfully.',
        ];
        return redirect()->route('tms-batch-schedule-detail.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsBatchScheduleDetail'] = TmsBatchScheduleDetail::find($id);

        return view('tms-batch-schedule-detail.show', $data);
    }

    public function edit($id)
    {
        $data['tmsBatchScheduleDetail'] = TmsBatchScheduleDetail::find($id);

        return view('tms-batch-schedule-detail.edit', $data);
    }

    public function update(Request $request, TmsBatchScheduleDetail $tmsBatchScheduleDetail)
    {


        request()->validate(TmsBatchScheduleDetail::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsBatchScheduleDetail->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsBatchScheduleDetail updated successfully.',
        ];
        return redirect()->route('tms-batch-schedule-detail.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsBatchScheduleDetail = TmsBatchScheduleDetail::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsBatchScheduleDetail deleted successfully.',
        ];
        return redirect()->route('tms-batch-schedule-detail.index')->with($alert);
    }
}
