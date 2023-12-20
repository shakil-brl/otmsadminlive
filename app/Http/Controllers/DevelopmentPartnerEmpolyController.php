<?php
namespace App\Http\Controllers;
use App\Models\DevelopmentPartnerEmpoly;
use Illuminate\Http\Request;

class DevelopmentPartnerEmpolyController extends Controller
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

        $data['developmentPartnerEmpolies'] = DevelopmentPartnerEmpoly::paginate();

        return view('development-partner-empoly.index', $data);
    }

    public function create()
    {
        $data['developmentPartnerEmpoly'] = new DevelopmentPartnerEmpoly();
        return view('development-partner-empoly.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(DevelopmentPartnerEmpoly::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $developmentPartnerEmpoly = DevelopmentPartnerEmpoly::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'DevelopmentPartnerEmpoly created successfully.',
        ];
        return redirect()->route('development-partner-empoly.index')->with($alert);
    }

    public function show($id)
    {
        $data['developmentPartnerEmpoly'] = DevelopmentPartnerEmpoly::find($id);

        return view('development-partner-empoly.show', $data);
    }

    public function edit($id)
    {
        $data['developmentPartnerEmpoly'] = DevelopmentPartnerEmpoly::find($id);

        return view('development-partner-empoly.edit', $data);
    }

    public function update(Request $request, DevelopmentPartnerEmpoly $developmentPartnerEmpoly)
    {


        request()->validate(DevelopmentPartnerEmpoly::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $developmentPartnerEmpoly->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'DevelopmentPartnerEmpoly updated successfully.',
        ];
        return redirect()->route('development-partner-empoly.index')->with($alert);
    }

    public function destroy($id)
    {
        $developmentPartnerEmpoly = DevelopmentPartnerEmpoly::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'DevelopmentPartnerEmpoly deleted successfully.',
        ];
        return redirect()->route('development-partner-empoly.index')->with($alert);
    }
}
