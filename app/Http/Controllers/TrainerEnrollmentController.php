<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class TrainerEnrollmentController extends Controller
{
    // show ui for all selected trainers enrollemnt to batch
    public function index(Request $request)
    {
        $total_trainers = ApiHttpClient::request('get', 'detail/trainer-total', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        $userRole = Session::get('access_token.role');

        if ($total_trainers['success'] == true) {

            $trainers = $total_trainers['data']['data'];
            //  dd($trainers);
            $paginator = $this->customPaginate($total_trainers, $request, route('dashboard_details.trainers'));
            $from = $total_trainers['data']['from'];
            $data =
                [
                    'total_trainers' => $trainers,
                    'paginator' => $paginator,
                    'from' => $from,
                    'userRole' => $userRole
                ];
            return view('trainersenroll.index', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $total_trainers['message'] ?? 'Something went wrong');
            return redirect()->back();
        }

        // return view('trainersenroll.index');
    }

    // show ui for induvisual selected trainees enrollemnt to batch
    public function show($userId)
    {
        return view('trainersenroll.show', compact('userId'));
    }

    // all batches to enroll traineer
    public function batches(Request $request)
    {
        $total_batches = ApiHttpClient::request('get', 'trainer-enroll/batches', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($total_batches);
        if ($total_batches['success'] == true) {
            $batches = $total_batches['data']['data'];
            $paginator = $this->customPaginate($total_batches, $request, route('dashboard_details.total_batches'));
            return view('trainersenroll.batches', ['total_batches' => $batches, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $total_batches['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }
}
