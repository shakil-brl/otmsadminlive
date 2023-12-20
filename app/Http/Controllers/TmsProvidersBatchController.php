<?php
namespace App\Http\Controllers;
use App\Models\TmsProvidersBatch;
use Illuminate\Http\Request;

class TmsProvidersBatchController extends Controller
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

        $data['tmsProvidersBatches'] = TmsProvidersBatch::paginate();

        return view('tms-providers-batch.index', $data);
    }

    public function create()
    {
        $data['tmsProvidersBatch'] = new TmsProvidersBatch();
        return view('tms-providers-batch.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsProvidersBatch::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsProvidersBatch = TmsProvidersBatch::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvidersBatch created successfully.',
        ];
        return redirect()->route('providers-batche.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsProvidersBatch'] = TmsProvidersBatch::find($id);

        return view('tms-providers-batch.show', $data);
    }

    public function edit($id)
    {
        $data['tmsProvidersBatch'] = TmsProvidersBatch::find($id);

        return view('tms-providers-batch.edit', $data);
    }

    public function update(Request $request, TmsProvidersBatch $tmsProvidersBatch)
    {


        request()->validate(TmsProvidersBatch::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsProvidersBatch->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvidersBatch updated successfully.',
        ];
        return redirect()->route('providers-batche.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsProvidersBatch = TmsProvidersBatch::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvidersBatch deleted successfully.',
        ];
        return redirect()->route('providers-batche.index')->with($alert);
    }
}
