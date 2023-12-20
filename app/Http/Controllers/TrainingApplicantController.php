<?php
namespace App\Http\Controllers;
use App\Models\TrainingApplicant;
use Illuminate\Http\Request;

class TrainingApplicantController extends Controller
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

        $data['trainingApplicants'] = TrainingApplicant::paginate();

        return view('training-applicant.index', $data);
    }

    public function create()
    {
        $data['trainingApplicant'] = new TrainingApplicant();
        return view('training-applicant.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TrainingApplicant::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $trainingApplicant = TrainingApplicant::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TrainingApplicant created successfully.',
        ];
        return redirect()->route('training-applicant.index')->with($alert);
    }

    public function show($id)
    {
        $data['trainingApplicant'] = TrainingApplicant::find($id);

        return view('training-applicant.show', $data);
    }

    public function edit($id)
    {
        $data['trainingApplicant'] = TrainingApplicant::find($id);

        return view('training-applicant.edit', $data);
    }

    public function update(Request $request, TrainingApplicant $trainingApplicant)
    {


        request()->validate(TrainingApplicant::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $trainingApplicant->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TrainingApplicant updated successfully.',
        ];
        return redirect()->route('training-applicant.index')->with($alert);
    }

    public function destroy($id)
    {
        $trainingApplicant = TrainingApplicant::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TrainingApplicant deleted successfully.',
        ];
        return redirect()->route('training-applicant.index')->with($alert);
    }
}
