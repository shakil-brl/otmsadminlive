<?php
namespace App\Http\Controllers;
use App\Models\TmsProvidersTrainer;
use Illuminate\Http\Request;

class TmsProvidersTrainerController extends Controller
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

        $data['tmsProvidersTrainers'] = TmsProvidersTrainer::paginate();

        return view('tms-providers-trainer.index', $data);
    }

    public function create()
    {
        $data['tmsProvidersTrainer'] = new TmsProvidersTrainer();
        return view('tms-providers-trainer.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsProvidersTrainer::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsProvidersTrainer = TmsProvidersTrainer::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvidersTrainer created successfully.',
        ];
        return redirect()->route('providers-trainer.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsProvidersTrainer'] = TmsProvidersTrainer::find($id);

        return view('tms-providers-trainer.show', $data);
    }

    public function edit($id)
    {
        $data['tmsProvidersTrainer'] = TmsProvidersTrainer::find($id);

        return view('tms-providers-trainer.edit', $data);
    }

    public function update(Request $request, TmsProvidersTrainer $tmsProvidersTrainer)
    {


        request()->validate(TmsProvidersTrainer::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsProvidersTrainer->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvidersTrainer updated successfully.',
        ];
        return redirect()->route('providers-trainer.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsProvidersTrainer = TmsProvidersTrainer::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsProvidersTrainer deleted successfully.',
        ];
        return redirect()->route('providers-trainer.index')->with($alert);
    }
}
