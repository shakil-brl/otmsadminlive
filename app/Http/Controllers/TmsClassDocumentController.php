<?php
namespace App\Http\Controllers;
use App\Models\TmsClassDocument;
use Illuminate\Http\Request;

class TmsClassDocumentController extends Controller
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

        $data['tmsClassDocuments'] = TmsClassDocument::paginate();

        return view('tms-class-document.index', $data);
    }

    public function create()
    {
        $data['tmsClassDocument'] = new TmsClassDocument();
        return view('tms-class-document.create', $data);
    }

    public function store(Request $request)
    {
        request()->validate(TmsClassDocument::$rules);


    // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }

        $tmsClassDocument = TmsClassDocument::create($request->all());

        $alert = [
            'type' => 'Success',
            'message' => 'TmsClassDocument created successfully.',
        ];
        return redirect()->route('class-document.index')->with($alert);
    }

    public function show($id)
    {
        $data['tmsClassDocument'] = TmsClassDocument::find($id);

        return view('tms-class-document.show', $data);
    }

    public function edit($id)
    {
        $data['tmsClassDocument'] = TmsClassDocument::find($id);

        return view('tms-class-document.edit', $data);
    }

    public function update(Request $request, TmsClassDocument $tmsClassDocument)
    {


        request()->validate(TmsClassDocument::$rules);

            // try {
    //     $results = ApiHttpClient::request('post', 'attendance/start-class', [$data])->json();

    // } catch (\Exception $e) {
    //     Log::error('API Request Error: ' . $e->getMessage());
    //     return response()->view('errors.api', [], 500);
    // }


        $tmsClassDocument->update($request->all());


        $alert = [
            'type' => 'Success',
            'message' => 'TmsClassDocument updated successfully.',
        ];
        return redirect()->route('class-document.index')->with($alert);
    }

    public function destroy($id)
    {
        $tmsClassDocument = TmsClassDocument::find($id)->delete();

        $alert = [
            'type' => 'Success',
            'message' => 'TmsClassDocument deleted successfully.',
        ];
        return redirect()->route('class-document.index')->with($alert);
    }
}
