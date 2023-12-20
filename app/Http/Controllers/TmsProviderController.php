<?php
namespace App\Http\Controllers;
use App\Models\TmsProvider;
use Illuminate\Http\Request;

class TmsProviderController extends Controller
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

        $data['tmsProviders'] = TmsProvider::paginate();

        return view('tms-provider.index', $data);
    }

    public function create()
    {
        $data['tmsProvider'] = new TmsProvider();
        return view('tms-provider.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsProvider::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsProvider = TmsProvider::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvider created successfully.',
        ];
        return redirect()->route('provider.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsProvider'] = TmsProvider::find($id);

        return view('tms-provider.show', $data);
    }

    public function edit($id)
    {
        $data['tmsProvider'] = TmsProvider::find($id);

        return view('tms-provider.edit', $data);
    }

    public function update(Request $request, TmsProvider $tmsProvider)
    {


        request()->validate(TmsProvider::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsProvider->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvider updated successfully.',
        ];
        return redirect()->route('provider.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsProvider = TmsProvider::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvider deleted successfully.',
        ];
        return redirect()->route('provider.index')->with($alert);
    }
}
