<?php
namespace App\Http\Controllers;
use App\Models\Geoupazila;
use Illuminate\Http\Request;

class GeoupazilaController extends Controller
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

        $data['geoupazilas'] = Geoupazila::paginate();

        return view('geoupazila.index', $data);
    }

    public function create()
    {
        $data['geoupazila'] = new Geoupazila();
        return view('geoupazila.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(Geoupazila::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $geoupazila = Geoupazila::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'Geoupazila created successfully.',
        ];
        return redirect()->route('geoupazilas.index')->with($alert);
    }

    public function show($id)
    {
        $data['geoupazila'] = Geoupazila::find($id);

        return view('geoupazila.show', $data);
    }

    public function edit($id)
    {
        $data['geoupazila'] = Geoupazila::find($id);

        return view('geoupazila.edit', $data);
    }

    public function update(Request $request, Geoupazila $geoupazila)
    {


        request()->validate(Geoupazila::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $geoupazila->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'Geoupazila updated successfully.',
        ];
        return redirect()->route('geoupazilas.index')->with($alert);
    }

    public function destroy($id)
    {
        $geoupazila = Geoupazila::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'Geoupazila deleted successfully.',
        ];
        return redirect()->route('geoupazilas.index')->with($alert);
    }
}
