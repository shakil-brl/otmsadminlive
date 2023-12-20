<?php
namespace App\Http\Controllers;
use App\Models\TmsInspection;
use Illuminate\Http\Request;

class TmsInspectionController extends Controller
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

        $data['tmsInspections'] = TmsInspection::paginate();

        return view('tms-inspection.index', $data);
    }

    public function create()
    {
        $data['tmsInspection'] = new TmsInspection();
        return view('tms-inspection.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsInspection::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsInspection = TmsInspection::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsInspection created successfully.',
        ];
        return redirect()->route('tms-inspections.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsInspection'] = TmsInspection::find($id);

        return view('tms-inspection.show', $data);
    }

    public function edit($id)
    {
        $data['tmsInspection'] = TmsInspection::find($id);

        return view('tms-inspection.edit', $data);
    }

    public function update(Request $request, TmsInspection $tmsInspection)
    {


        request()->validate(TmsInspection::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsInspection->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsInspection updated successfully.',
        ];
        return redirect()->route('tms-inspections.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsInspection = TmsInspection::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsInspection deleted successfully.',
        ];
        return redirect()->route('tms-inspections.index')->with($alert);
    }
}
