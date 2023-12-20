<?php
namespace App\Http\Controllers;
use App\Models\TmsUserType;
use Illuminate\Http\Request;

class TmsUserTypeController extends Controller
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

        $data['tmsUserTypes'] = TmsUserType::paginate();

        return view('tms-user-type.index', $data);
    }

    public function create()
    {
        $data['tmsUserType'] = new TmsUserType();
        return view('tms-user-type.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsUserType::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsUserType = TmsUserType::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsUserType created successfully.',
        ];
        return redirect()->route('user-type.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsUserType'] = TmsUserType::find($id);

        return view('tms-user-type.show', $data);
    }

    public function edit($id)
    {
        $data['tmsUserType'] = TmsUserType::find($id);

        return view('tms-user-type.edit', $data);
    }

    public function update(Request $request, TmsUserType $tmsUserType)
    {


        request()->validate(TmsUserType::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsUserType->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsUserType updated successfully.',
        ];
        return redirect()->route('user-type.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsUserType = TmsUserType::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsUserType deleted successfully.',
        ];
        return redirect()->route('user-type.index')->with($alert);
    }
}
