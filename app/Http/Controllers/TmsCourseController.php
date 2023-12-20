<?php
namespace App\Http\Controllers;
use App\Models\TmsCourse;
use Illuminate\Http\Request;

class TmsCourseController extends Controller
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

        $data['tmsCourses'] = TmsCourse::paginate();

        return view('tms-course.index', $data);
    }

    public function create()
    {
        $data['tmsCourse'] = new TmsCourse();
        return view('tms-course.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsCourse::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsCourse = TmsCourse::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsCourse created successfully.',
        ];
        return redirect()->route('tms-course.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsCourse'] = TmsCourse::find($id);

        return view('tms-course.show', $data);
    }

    public function edit($id)
    {
        $data['tmsCourse'] = TmsCourse::find($id);

        return view('tms-course.edit', $data);
    }

    public function update(Request $request, TmsCourse $tmsCourse)
    {


        request()->validate(TmsCourse::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsCourse->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsCourse updated successfully.',
        ];
        return redirect()->route('tms-course.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsCourse = TmsCourse::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsCourse deleted successfully.',
        ];
        return redirect()->route('tms-course.index')->with($alert);
    }
}
