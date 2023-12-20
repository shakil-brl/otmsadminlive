<?php
namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
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

        $data['profiles'] = Profile::paginate();

        return view('profile.index', $data);
    }

    public function create()
    {
        $data['profile'] = new Profile();
        return view('profile.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(Profile::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $profile = Profile::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'Profile created successfully.',
        ];
        return redirect()->route('profile.index')->with($alert);
    }

    public function show($id)
    {
        $data['profile'] = Profile::find($id);

        return view('profile.show', $data);
    }

    public function edit($id)
    {
        $data['profile'] = Profile::find($id);

        return view('profile.edit', $data);
    }

    public function update(Request $request, Profile $profile)
    {


        request()->validate(Profile::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $profile->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'Profile updated successfully.',
        ];
        return redirect()->route('profile.index')->with($alert);
    }

    public function destroy($id)
    {
        $profile = Profile::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'Profile deleted successfully.',
        ];
        return redirect()->route('profile.index')->with($alert);
    }
}
