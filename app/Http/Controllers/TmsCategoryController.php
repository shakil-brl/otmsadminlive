<?php
namespace App\Http\Controllers;
use App\Models\TmsCategory;
use Illuminate\Http\Request;

class TmsCategoryController extends Controller
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

        $data['tmsCategories'] = TmsCategory::paginate();

        return view('tms-category.index', $data);
    }

    public function create()
    {
        $data['tmsCategory'] = new TmsCategory();
        return view('tms-category.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsCategory::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsCategory = TmsCategory::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsCategory created successfully.',
        ];
        return redirect()->route('tms-categorie.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsCategory'] = TmsCategory::find($id);

        return view('tms-category.show', $data);
    }

    public function edit($id)
    {
        $data['tmsCategory'] = TmsCategory::find($id);

        return view('tms-category.edit', $data);
    }

    public function update(Request $request, TmsCategory $tmsCategory)
    {


        request()->validate(TmsCategory::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsCategory->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsCategory updated successfully.',
        ];
        return redirect()->route('tms-categorie.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsCategory = TmsCategory::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsCategory deleted successfully.',
        ];
        return redirect()->route('tms-categorie.index')->with($alert);
    }
}
