<?php
namespace App\Http\Controllers;
use App\Models\DevelopmentPartner;
use Illuminate\Http\Request;

class DevelopmentPartnerController extends Controller
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

        $data['developmentPartners'] = DevelopmentPartner::paginate();

        return view('development-partner.index', $data);
    }

    public function create()
    {
        $data['developmentPartner'] = new DevelopmentPartner();
        return view('development-partner.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(DevelopmentPartner::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $developmentPartner = DevelopmentPartner::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'DevelopmentPartner created successfully.',
        ];
        return redirect()->route('development-partner.index')->with($alert);
    }

    public function show($id)
    {
        $data['developmentPartner'] = DevelopmentPartner::find($id);

        return view('development-partner.show', $data);
    }

    public function edit($id)
    {
        $data['developmentPartner'] = DevelopmentPartner::find($id);

        return view('development-partner.edit', $data);
    }

    public function update(Request $request, DevelopmentPartner $developmentPartner)
    {


        request()->validate(DevelopmentPartner::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $developmentPartner->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'DevelopmentPartner updated successfully.',
        ];
        return redirect()->route('development-partner.index')->with($alert);
    }

    public function destroy($id)
    {
        $developmentPartner = DevelopmentPartner::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'DevelopmentPartner deleted successfully.',
        ];
        return redirect()->route('development-partner.index')->with($alert);
    }
}
