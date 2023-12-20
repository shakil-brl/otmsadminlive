<?php
namespace App\Http\Controllers;
use App\Models\Geodivision;
use Illuminate\Http\Request;

class GeodivisionController extends Controller
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

        $data['geodivisions'] = Geodivision::paginate();

        return view('geodivision.index', $data);
    }

    public function create()
    {
        $data['geodivision'] = new Geodivision();
        return view('geodivision.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(Geodivision::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $geodivision = Geodivision::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'Geodivision created successfully.',
        ];
        return redirect()->route('geodivision.index')->with($alert);
    }

    public function show($id)
    {
        $data['geodivision'] = Geodivision::find($id);

        return view('geodivision.show', $data);
    }

    public function edit($id)
    {
        $data['geodivision'] = Geodivision::find($id);

        return view('geodivision.edit', $data);
    }

    public function update(Request $request, Geodivision $geodivision)
    {


        request()->validate(Geodivision::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $geodivision->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'Geodivision updated successfully.',
        ];
        return redirect()->route('geodivision.index')->with($alert);
    }

    public function destroy($id)
    {
        $geodivision = Geodivision::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'Geodivision deleted successfully.',
        ];
        return redirect()->route('geodivision.index')->with($alert);
    }
}
