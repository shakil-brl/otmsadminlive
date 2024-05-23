<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TmsBatchClosingController extends Controller
{
    public function create(Request $request)
    {
        $batch_id = decrypt($request['batch_id']);
        $batch_results = ApiHttpClient::request('get', 'batch/' . $batch_id . '/show')
            ->json();
        // dd($batch_results['data']);
        if ($batch_results['success'] == true) {
            $batch = $batch_results['data'];

            $data = [
                'batch' => $batch,
            ];

            return view('batch-closing.create', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', ($batch_results['message']) ?? 'Something went wrong');
            return back();
        }
    }

    public function close(Request $request)
    {
        $batch_closing = [];

        if ($request['is_class_completed']) {
            $batch_closing['is_class_completed'] = 1;
        }
        if ($request['is_material_distributed']) {
            $batch_closing['is_material_distributed'] = 1;
        }
        if ($request['is_laptop_distributed']) {
            $batch_closing['is_laptop_distributed'] = 1;
        }
        if ($request['is_payment_completed']) {
            $batch_closing['is_payment_completed'] = 1;
        }

        if ($request['action'] == 'update') {
            $batch_closing_id = $request['batch_closing_id'];
            $data = ApiHttpClient::request('PATCH', "batch-closing/$batch_closing_id", $batch_closing)->json();
        } else {
            $batch_closing['training_batch_id'] = $request['training_batch_id'];
            $data = ApiHttpClient::request('post', 'batch-closing', $batch_closing)->json();
        }

        dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Action successfully');
            return redirect()->route('dashboard_details.total_batches');
        }
    }
}
