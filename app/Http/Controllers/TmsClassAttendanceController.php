<?php
namespace App\Http\Controllers;
use App\Models\TmsClassAttendance;
use Illuminate\Http\Request;

class TmsClassAttendanceController extends Controller
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

        $data['tmsClassAttendances'] = TmsClassAttendance::paginate();

        return view('tms-class-attendance.index', $data);
    }

    public function create()
    {
        $data['tmsClassAttendance'] = new TmsClassAttendance();
        return view('tms-class-attendance.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsClassAttendance::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsClassAttendance = TmsClassAttendance::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsClassAttendance created successfully.',
        ];
        return redirect()->route('class-attendance.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsClassAttendance'] = TmsClassAttendance::find($id);

        return view('tms-class-attendance.show', $data);
    }

    public function edit($id)
    {
        $data['tmsClassAttendance'] = TmsClassAttendance::find($id);

        return view('tms-class-attendance.edit', $data);
    }

    public function update(Request $request, TmsClassAttendance $tmsClassAttendance)
    {


        request()->validate(TmsClassAttendance::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsClassAttendance->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsClassAttendance updated successfully.',
        ];
        return redirect()->route('class-attendance.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsClassAttendance = TmsClassAttendance::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsClassAttendance deleted successfully.',
        ];
        return redirect()->route('class-attendance.index')->with($alert);
    }
}
