<?php
namespace App\Http\Controllers;
use App\Models\Geodistrict;
use Illuminate\Http\Request;

class GeodistrictController extends Controller
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

        $data['geodistricts'] = Geodistrict::paginate();

        return view('geodistrict.index', $data);
    }

    public function create()
    {
        $data['geodistrict'] = new Geodistrict();
        return view('geodistrict.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(Geodistrict::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $geodistrict = Geodistrict::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'Geodistrict created successfully.',
        ];
        return redirect()->route('geodistrict.index')->with($alert);
    }

    public function show($id)
    {
        $data['geodistrict'] = Geodistrict::find($id);

        return view('geodistrict.show', $data);
    }

    public function edit($id)
    {
        $data['geodistrict'] = Geodistrict::find($id);

        return view('geodistrict.edit', $data);
    }

    public function update(Request $request, Geodistrict $geodistrict)
    {


        request()->validate(Geodistrict::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $geodistrict->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'Geodistrict updated successfully.',
        ];
        return redirect()->route('geodistrict.index')->with($alert);
    }

    public function destroy($id)
    {
        $geodistrict = Geodistrict::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'Geodistrict deleted successfully.',
        ];
        return redirect()->route('geodistrict.index')->with($alert);
    }
}
