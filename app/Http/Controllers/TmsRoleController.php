<?php
namespace App\Http\Controllers;
use App\Models\TmsRole;
use Illuminate\Http\Request;

class TmsRoleController extends Controller
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

        $data['tmsRoles'] = TmsRole::paginate();

        return view('tms-role.index', $data);
    }

    public function create()
    {
        $data['tmsRole'] = new TmsRole();
        return view('tms-role.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsRole::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsRole = TmsRole::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsRole created successfully.',
        ];
        return redirect()->route('role.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsRole'] = TmsRole::find($id);

        return view('tms-role.show', $data);
    }

    public function edit($id)
    {
        $data['tmsRole'] = TmsRole::find($id);

        return view('tms-role.edit', $data);
    }

    public function update(Request $request, TmsRole $tmsRole)
    {


        request()->validate(TmsRole::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsRole->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsRole updated successfully.',
        ];
        return redirect()->route('role.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsRole = TmsRole::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsRole deleted successfully.',
        ];
        return redirect()->route('role.index')->with($alert);
    }
}
