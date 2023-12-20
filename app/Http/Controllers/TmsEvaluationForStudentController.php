<?php
namespace App\Http\Controllers;
use App\Models\TmsEvaluationForStudent;
use Illuminate\Http\Request;

class TmsEvaluationForStudentController extends Controller
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

        $data['tmsEvaluationForStudents'] = TmsEvaluationForStudent::paginate();

        return view('tms-evaluation-for-student.index', $data);
    }

    public function create()
    {
        $data['tmsEvaluationForStudent'] = new TmsEvaluationForStudent();
        return view('tms-evaluation-for-student.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsEvaluationForStudent::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsEvaluationForStudent = TmsEvaluationForStudent::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsEvaluationForStudent created successfully.',
        ];
        return redirect()->route('evaluation-student.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsEvaluationForStudent'] = TmsEvaluationForStudent::find($id);

        return view('tms-evaluation-for-student.show', $data);
    }

    public function edit($id)
    {
        $data['tmsEvaluationForStudent'] = TmsEvaluationForStudent::find($id);

        return view('tms-evaluation-for-student.edit', $data);
    }

    public function update(Request $request, TmsEvaluationForStudent $tmsEvaluationForStudent)
    {


        request()->validate(TmsEvaluationForStudent::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsEvaluationForStudent->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsEvaluationForStudent updated successfully.',
        ];
        return redirect()->route('evaluation-student.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsEvaluationForStudent = TmsEvaluationForStudent::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsEvaluationForStudent deleted successfully.',
        ];
        return redirect()->route('evaluation-student.index')->with($alert);
    }
}
