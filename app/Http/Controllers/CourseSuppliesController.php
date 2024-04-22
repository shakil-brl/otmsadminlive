<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseSuppliesController extends Controller
{
    public function supply(Request $request, $batch_id)
    {
        $batch_id = decrypt($batch_id);
        $batch_results = ApiHttpClient::request('get', 'batch/' . $batch_id . '/show')
            ->json();
        // dd($batch_results['data']);


        if ($batch_results['success'] == true) {
            $batch = $batch_results['data'];
            $phase_id = $batch['batch_phase'] ? $batch['batch_phase']['phase']['id'] : null;

            $combo_results = ApiHttpClient::request('get', 'product-combo', [
                'page' => $request->page ?? 1,
                'search' => $request->search,
                'is_active' => 1,
                'phase_id' => $phase_id,
            ])->json();

            if ($combo_results['success'] == true) {
                $product_combos = $combo_results['data'];
                $paginator = $this->customPaginate($combo_results, $request, route('course-supplies.supply', $batch_id));

                return view('course-supplies.supply', ['batch' => $batch, 'combos' => $product_combos, 'paginator' => $paginator]);
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', ($batch_results['message'] ?? 'Something went wrong'));
                return back();
            }
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', ($batch_results['message'] ?? 'Something went wrong'));
            return back();
        }
        // return view('course-supplies.supply');
    }

    public function distribute($batch_id, $combo_id)
    {
        $batch_id = decrypt($batch_id);

        $combo_results = ApiHttpClient::request('get', "product-combo/$combo_id")->json();
        $results = ApiHttpClient::request('get', "batches/details/$batch_id")->json();

        if ($results['success'] == true && $combo_results['success'] == true) {
            $data = [
                'batch_details' => $results['data'],
                'combo' => $combo_results['data'],
            ];
            return view('course-supplies.student-list', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function allocation(Request $request)
    {
        $request->validate([
            'combo_id' => 'required',
            'training_applicant_ids' => 'required|array',
            'distribution_date' => 'required|date_format:d/m/Y'
        ]);

        $allocation = $request->except('distribution_date');

        $allocation['distribution_date'] = Carbon::createFromFormat('d/m/Y', $request->distribution_date)->format('Y-m-d');
        // dd($allocation);
        $data = ApiHttpClient::request('post', 'material-allocation', $allocation)->json();

        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Distributed successfully');
            return redirect()->back();
        }
    }

    public function show(Request $request, $batch_id)
    {
        $batch_id = decrypt($batch_id);
        $batch_results = ApiHttpClient::request('get', 'batch/' . $batch_id . '/show')
            ->json();
        // dd($batch_results['data']);


        if ($batch_results['success'] == true) {
            $batch = $batch_results['data'];
            $phase_id = $batch['batch_phase'] ? $batch['batch_phase']['phase']['id'] : null;
            // dd($phase_id);
            $combo_results = ApiHttpClient::request('get', "product-combo/phase/$phase_id", [
                'page' => $request->page ?? 1,
                'search' => $request->search,
                'is_active' => 1,
            ])->json();
            // dd($combo_results);
            if ($combo_results['success'] == true) {
                $product_combos = $combo_results['data'];
                $paginator = $this->customPaginate($combo_results, $request, route('course-supplies.supply', $batch_id));

                return view('course-supplies.supply', ['batch' => $batch, 'combos' => $product_combos, 'paginator' => $paginator]);
            } else {
                return view('course-supplies.supply', ['batch' => $batch, 'combos' => 0]);
            }
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', ($batch_results['message'] ?? 'Something went wrong'));
            return back();
        }
    }

    public function distributedList($batch_id, $combo_id)
    {
        $batch_id = decrypt($batch_id);

        $combo_results = ApiHttpClient::request('get', "product-combo/$combo_id")->json();
        $results = ApiHttpClient::request('get', "batches/details/$batch_id")->json();

        if ($results['success'] == true && $combo_results['success'] == true) {
            $data = [
                'batch_details' => $results['data'],
                'combo' => $combo_results['data'],
            ];
            return view('course-supplies.student-list', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }
}
