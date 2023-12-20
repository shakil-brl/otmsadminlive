<?php
namespace App\Http\Controllers;
use App\Models\TmsPermission;
use Illuminate\Http\Request;

class TmsPermissionController extends Controller
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

        $data['tmsPermissions'] = TmsPermission::paginate();

        return view('tms-permission.index', $data);
    }

    public function create()
    {
        $data['tmsPermission'] = new TmsPermission();
        return view('tms-permission.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsPermission::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsPermission = TmsPermission::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsPermission created successfully.',
        ];
        return redirect()->route('role-permision.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsPermission'] = TmsPermission::find($id);

        return view('tms-permission.show', $data);
    }

    public function edit($id)
    {
        $data['tmsPermission'] = TmsPermission::find($id);

        return view('tms-permission.edit', $data);
    }

    public function update(Request $request, TmsPermission $tmsPermission)
    {


        request()->validate(TmsPermission::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsPermission->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsPermission updated successfully.',
        ];
        return redirect()->route('role-permision.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsPermission = TmsPermission::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsPermission deleted successfully.',
        ];
        return redirect()->route('role-permision.index')->with($alert);
    }
}
