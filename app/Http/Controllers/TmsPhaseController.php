<?php

// app/Http/Controllers/Api/TrainingMonitoring/TmsPhaseController.php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use App\Http\Controllers\Controller;
use App\Models\TrainingMonitoring\TmsPhase;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables\DataTables;

class TmsPhaseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $perPage = $request->input('length', 10);
            $page = $request->input('page', 1);
            $searchTerm = $request->input('searchTerm');

            // Make the API request to get paginated data
            $response = ApiHttpClient::request('get', 'tms-phases', ['page' => $page, 'perPage' => $perPage, 'searchTerm' => $searchTerm]);
            // dd($response);
            // Check if the API request was successful
            if ($response->successful()) {
                $data = $response->json();
                $pagination = $data['meta']['pagination'];

                return Datatables::of($data['data'])
                    ->addIndexColumn()
                    ->addColumn('isActive', function ($row) {
                        return isset($row['isActive']) ? ($row['isActive'] == 1 ? 'Active' : 'Inactive') : '';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '
                        <div class="d-flex gap-1 justify-content-center">
                            <a data-id="' . $row['id'] . '" class="link-batch btn btn-info btn-sm text-center">Link Batch</a>
                            <a data-id="' . $row['id'] . '" class="view btn btn-info btn-sm text-center">View</a>
                            <a data-id="' . $row['id'] . '" class="edit-action btn btn-success btn-sm text-center">Edit</a>
                            <a data-id="' . $row['id'] . '" class="delete-action btn btn-danger btn-sm text-center">Delete</a>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->setTotalRecords($pagination['total'])
                    ->make(true);
            } else {
                return response()->json(['error' => 'Failed to fetch data from API'], 500);
            }
        }

        return view('tmsphasec.index_test');
    }


    // public function index(Request $request)
    // {
    //     // ApiHttpClient::request('get', 'tms-phases', )->json();
    //     if ($request->ajax()) {
    //         // Define the API endpoint and query parameters for pagination
    //         $perPage = $request->input('length', 10); // Adjust the perPage value according to your API's pagination settings
    //         $page = $request->input('page', 1); // Get the current page from the request

    //         // Make the API request to get paginated data
    //         $response = ApiHttpClient::request('get', 'tms-phases', ['page' => $page, 'perPage' => $perPage]);
    //         // dd($response);
    //         // Check if the API request was successful
    //         if ($response->successful()) {
    //             $data = $response->json(); // Assuming the API response is in JSON format
    //             $pagination = $data['meta']['pagination'];

    //             // Manually create a LengthAwarePaginator instance using Laravel's paginator
    //             $paginator = new LengthAwarePaginator(
    //                 $data['data'],
    //                 $pagination['total'],
    //                 $perPage,
    //                 $page,
    //                 ['path' => route('tms-phase.index')] // Add your route here
    //             );

    //             return response()->json([
    //                 'data' => $paginator->items(),
    //                 'meta' => [
    //                     'pagination' => [
    //                         'total' => $paginator->total(),
    //                         'per_page' => $paginator->perPage(),
    //                         'current_page' => $paginator->currentPage(),
    //                         'last_page' => $paginator->lastPage(),
    //                         'from' => $paginator->firstItem(),
    //                         'to' => $paginator->lastItem(),
    //                     ],
    //                 ],
    //             ]);
    //         } else {
    //             // Handle the API error if the request was not successful
    //             return response()->json(['error' => 'Failed to fetch data from API'], 500);
    //         }
    //     }

    //     return view('tmsphasec.index_test');
    // }

    // sow create form
    public function create()
    {
        return view('tmsphasec.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_bn' => 'required|string|max:50',
            'remark' => 'nullable|string|max:255',
        ]);

        $phase = $request->except(['isActive']);

        if ($request->isActive) {
            $phase['isActive'] = 1;
        } else {
            $phase['isActive'] = 0;
        }
        // dd($phase);
        $data = ApiHttpClient::request('post', 'tms-phases', $phase)->json();

        if (isset($data['errors'])) {
            $error_message = $data['errors'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('tms-phase.index');
        }
    }

    // Display the specified resource.
    public function show($id)
    {
        if ($id) {
            $results = ApiHttpClient::request('get', "tms-phases/$id")->json();

            if ($results['success'] == true) {
                $phase = $results['data'];
                // dd($phase);
                return view('tmsphasec.show', compact('phase'));
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', 'Something went wrong');
                return redirect()->back();
            }
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $results = ApiHttpClient::request('get', "tms-phases/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $phase = $results['data'];
            return view('tmsphasec.edit', ['phase' => $phase]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_bn' => 'required|string|max:50',
            'remark' => 'nullable|string|max:255',
        ]);

        $phase = $request->except(['isActive']);

        if ($request->isActive) {
            $phase['isActive'] = 1;
        } else {
            $phase['isActive'] = 0;
        }
        // dd($phase);
        $data = ApiHttpClient::request('put', "tms-phases/$id", $phase)->json();

        if (isset($data['errors'])) {
            $error_message = $data['errors'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Updated successfully');
            return redirect()->route('tms-phase.index');
        }

        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_bn' => 'nullable|string|max:50',
            'remark' => 'required|string|max:255',
        ]);

        $phase = TmsPhase::findOrFail($id);
        $phase->update($request->all());

        return response()->json(['data' => $phase], 200);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $phase = TmsPhase::findOrFail($id);
        $phase->delete();

        return response()->json(['message' => 'Phase deleted successfully'], 200);
    }


    /**
     * link with batch
     */
    public function linkBatch($id)
    {
        if ($id) {
            $results = ApiHttpClient::request('get', 'tms-phases/' . $id)->json();
            $bp_results = ApiHttpClient::request('get', 'tms-batch-phases')->json();

            if ($results['success'] == true && $bp_results['success'] == true) {
                $phase = $results['data'];
                $batch_phases = $bp_results['data'];
                $data = [
                    'phase' => $phase,
                    'batch_phases' => $batch_phases
                ];
                // dd($batch_phases);
                return view('tmsphasec.link_batches', $data);
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', 'Something went wrong');
                return redirect()->back();
            }
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }
}
