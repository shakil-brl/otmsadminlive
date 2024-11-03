<?php

namespace App\Http\Controllers;

use App\Exports\TraineesExport;
use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TraineeEnrollmentController extends Controller
{
    // show ui for all selected trainees enrollemnt to batch
    public function index(Request $request)
    {
        // $results = ApiHttpClient::request('get', 'detail/trainee-total', [
        //     'page' => $request->page ?? 1,
        //     ...$request->all(),
        // ])->json();

        // if ($results['success'] == true) {
        //     $trainees = $results['data']['data'] ?? [];
        //     $page_from = $results['data']['from'] ?? 1;
        //     $paginator = $this->customPaginate($results, $request, route('traineeEnroll.index'));
        //     return view('traineesenroll.index', ['trainees' => $trainees, 'paginator' => $paginator, 'page_from' => $page_from]);
        // } else {
        //     session()->flash('type', 'Danger');
        //     session()->flash('message', $results['message'] ?? 'Something went wrong');
        //     return back();
        // }

        return view('traineesenroll.index');
    }

    // show ui for induvisual selected trainees enrollemnt to batch
    public function show($userId)
    {
        return view('traineesenroll.show', compact('userId'));
    }

    public function export($batch_id)
    {

        $results = ApiHttpClient::request('get', 'detail/total-batch', [
            'data_type' => 'first',
            'batch_id' => $batch_id,
        ])->json();

        if ($results['success'] == true) {
            $batch = $results['data'];

            $filename = 'Trainee List (' . $batch['batchCode'] . ") " . Carbon::now()->format('d-m-Y h.i.s A') . '.xlsx';

            return Excel::download(new TraineesExport($batch), $filename);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }
}
