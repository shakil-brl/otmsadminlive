<?php
namespace App\Http\Controllers;
use App\Models\TrainingTitle;
use Illuminate\Http\Request;

class TrainingTitleController extends Controller
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

        $data['trainingTitles'] = TrainingTitle::paginate();

        return view('training-title.index', $data);
    }

    public function create()
    {
        $data['trainingTitle'] = new TrainingTitle();
        return view('training-title.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TrainingTitle::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $trainingTitle = TrainingTitle::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TrainingTitle created successfully.',
        ];
        return redirect()->route('training-title.index')->with($alert);
    }

    public function show($id)
    {
        $data['trainingTitle'] = TrainingTitle::find($id);

        return view('training-title.show', $data);
    }

    public function edit($id)
    {
        $data['trainingTitle'] = TrainingTitle::find($id);

        return view('training-title.edit', $data);
    }

    public function update(Request $request, TrainingTitle $trainingTitle)
    {


        request()->validate(TrainingTitle::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $trainingTitle->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TrainingTitle updated successfully.',
        ];
        return redirect()->route('training-title.index')->with($alert);
    }

    public function destroy($id)
    {
        $trainingTitle = TrainingTitle::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TrainingTitle deleted successfully.',
        ];
        return redirect()->route('training-title.index')->with($alert);
    }
}
