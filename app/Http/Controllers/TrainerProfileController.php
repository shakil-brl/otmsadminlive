<?php
namespace App\Http\Controllers;
use App\Models\TrainerProfile;
use Illuminate\Http\Request;

class TrainerProfileController extends Controller
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

        $data['trainerProfiles'] = TrainerProfile::paginate();

        return view('trainer-profile.index', $data);
    }

    public function create()
    {
        $data['trainerProfile'] = new TrainerProfile();
        return view('trainer-profile.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TrainerProfile::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $trainerProfile = TrainerProfile::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TrainerProfile created successfully.',
        ];
        return redirect()->route('trainer-profile.index')->with($alert);
    }

    public function show($id)
    {
        $data['trainerProfile'] = TrainerProfile::find($id);

        return view('trainer-profile.show', $data);
    }

    public function edit($id)
    {
        $data['trainerProfile'] = TrainerProfile::find($id);

        return view('trainer-profile.edit', $data);
    }

    public function update(Request $request, TrainerProfile $trainerProfile)
    {


        request()->validate(TrainerProfile::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $trainerProfile->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TrainerProfile updated successfully.',
        ];
        return redirect()->route('trainer-profile.index')->with($alert);
    }

    public function destroy($id)
    {
        $trainerProfile = TrainerProfile::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TrainerProfile deleted successfully.',
        ];
        return redirect()->route('trainer-profile.index')->with($alert);
    }
}
