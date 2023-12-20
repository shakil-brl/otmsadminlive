<?php
namespace App\Http\Controllers;
use App\Models\TmsBatchGroup;
use Illuminate\Http\Request;

class TmsBatchGroupController extends Controller
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

        $data['tmsBatchGroups'] = TmsBatchGroup::paginate();

        return view('tms-batch-group.index', $data);
    }

    public function create()
    {
        $data['tmsBatchGroup'] = new TmsBatchGroup();
        return view('tms-batch-group.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsBatchGroup::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsBatchGroup = TmsBatchGroup::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsBatchGroup created successfully.',
        ];
        return redirect()->route('batch-group.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsBatchGroup'] = TmsBatchGroup::find($id);

        return view('tms-batch-group.show', $data);
    }

    public function edit($id)
    {
        $data['tmsBatchGroup'] = TmsBatchGroup::find($id);

        return view('tms-batch-group.edit', $data);
    }

    public function update(Request $request, TmsBatchGroup $tmsBatchGroup)
    {


        request()->validate(TmsBatchGroup::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsBatchGroup->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsBatchGroup updated successfully.',
        ];
        return redirect()->route('batch-group.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsBatchGroup = TmsBatchGroup::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsBatchGroup deleted successfully.',
        ];
        return redirect()->route('batch-group.index')->with($alert);
    }
}
