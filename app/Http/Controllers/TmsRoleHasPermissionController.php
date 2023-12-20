<?php
namespace App\Http\Controllers;
use App\Models\TmsRoleHasPermission;
use Illuminate\Http\Request;

class TmsRoleHasPermissionController extends Controller
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

        $data['tmsRoleHasPermissions'] = TmsRoleHasPermission::paginate();

        return view('tms-role-has-permission.index', $data);
    }

    public function create()
    {
        $data['tmsRoleHasPermission'] = new TmsRoleHasPermission();
        return view('tms-role-has-permission.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsRoleHasPermission::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsRoleHasPermission = TmsRoleHasPermission::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsRoleHasPermission created successfully.',
        ];
        return redirect()->route('permission.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsRoleHasPermission'] = TmsRoleHasPermission::find($id);

        return view('tms-role-has-permission.show', $data);
    }

    public function edit($id)
    {
        $data['tmsRoleHasPermission'] = TmsRoleHasPermission::find($id);

        return view('tms-role-has-permission.edit', $data);
    }

    public function update(Request $request, TmsRoleHasPermission $tmsRoleHasPermission)
    {


        request()->validate(TmsRoleHasPermission::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsRoleHasPermission->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsRoleHasPermission updated successfully.',
        ];
        return redirect()->route('permission.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsRoleHasPermission = TmsRoleHasPermission::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsRoleHasPermission deleted successfully.',
        ];
        return redirect()->route('permission.index')->with($alert);
    }
}
