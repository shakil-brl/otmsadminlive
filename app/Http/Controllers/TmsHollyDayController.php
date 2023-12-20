<?php
namespace App\Http\Controllers;
use App\Models\TmsHollyDay;
use Illuminate\Http\Request;

class TmsHollyDayController extends Controller
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

        $data['tmsHollyDays'] = TmsHollyDay::paginate();

        return view('tms-holly-day.index', $data);
    }

    public function create()
    {
        $data['tmsHollyDay'] = new TmsHollyDay();
        return view('tms-holly-day.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsHollyDay::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsHollyDay = TmsHollyDay::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsHollyDay created successfully.',
        ];
        return redirect()->route('tms-holly-day.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsHollyDay'] = TmsHollyDay::find($id);

        return view('tms-holly-day.show', $data);
    }

    public function edit($id)
    {
        $data['tmsHollyDay'] = TmsHollyDay::find($id);

        return view('tms-holly-day.edit', $data);
    }

    public function update(Request $request, TmsHollyDay $tmsHollyDay)
    {


        request()->validate(TmsHollyDay::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsHollyDay->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsHollyDay updated successfully.',
        ];
        return redirect()->route('tms-holly-day.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsHollyDay = TmsHollyDay::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsHollyDay deleted successfully.',
        ];
        return redirect()->route('tms-holly-day.index')->with($alert);
    }
}
