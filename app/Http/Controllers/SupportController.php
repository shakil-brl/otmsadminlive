<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function allBatch(Request $request)
    {
        $running_batches = ApiHttpClient::request('get', 'detail/running-batch', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($running_batches);
        if ($running_batches['success'] == true) {
            $batches = $running_batches['data']['data'];
            $paginator = $this->customPaginate($running_batches, $request, route('dashboard_details.running_batches'));
            $from = $running_batches['data']['from'];

            return view('support.all-batch', ['running_batches' => $batches, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $running_batches['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }
    public function allScheduleDetails($batch_id, $schedule_id)
    {
        $userRole = Session::get('access_token.role');
        $results = ApiHttpClient::request('get', 'batch/' . $batch_id . '/show')
            ->json();

        $schedule_details = ApiHttpClient::request('get', 'all-schedule/' . $schedule_id)
            ->json();

        if ($results['success'] == true && $schedule_details['success'] == true) {
            $batch = $results['data'];
            $schedule_details_waiting = [];
            foreach ($schedule_details['data'] as $schedule_details) {
                $date = Carbon::createFromFormat('Y-m-d', $schedule_details['date']);
                if ($schedule_details['status'] == 1 && $date <= Carbon::now()) {
                    $schedule_details_waiting[] = $schedule_details;
                }
            }
            // dd($schedule_details_waiting);
            return view('support.schedule-details', ['schedule_details' => $schedule_details_waiting ?? [], 'batch' => $batch, 'role' => $userRole]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function startAll(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|numeric',
            'schedule_id' => 'required|numeric',
            'schedule_detail_ids' => 'array|required'
        ]);

        $schedule_detail_ids = $request['schedule_detail_ids'];
        // dd($request->all());
        $action_status = false;
        foreach ($schedule_detail_ids as $sd_id) {
            $results = ApiHttpClient::request('post', 'attendance/start-class', [
                'schedule_detail_id' => $sd_id,
                'streaming_link' => 'https://meet.google.com/',
                'static_link' => 'https://www.facebook.com/'
            ])->json();

            if (isset($results['success'])) {
                if ($results['success'] == true) {
                    if (!$action_status) {
                        $action_status = true;
                    }
                } else {
                    $action_status = false;
                    break;
                }
            }
        }

        if (isset($action_status)) {
            if ($action_status) {
                session()->flash('type', 'success');
                session()->flash('message', 'Class started successfully');
                return redirect()->route('support.running-class', [$request['batch_id'], $request['schedule_id']]);
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', 'Something went wrong');
                return redirect()->back();
            }
        }
    }
    public function allStartDetails($batch_id, $schedule_id)
    {
        $userRole = Session::get('access_token.role');
        $results = ApiHttpClient::request('get', 'batch/' . $batch_id . '/show')
            ->json();

        $schedule_details = ApiHttpClient::request('get', 'all-schedule/' . $schedule_id)
            ->json();

        if ($results['success'] == true && $schedule_details['success'] == true) {
            $batch = $results['data'];
            $schedule_details_running = [];
            foreach ($schedule_details['data'] as $schedule_details) {
                $date = Carbon::createFromFormat('Y-m-d', $schedule_details['date']);
                if ($schedule_details['status'] == 2) {
                    $schedule_details_running[] = $schedule_details;
                }
            }
            // dd($schedule_details_running);
            return view('support.running-class', ['schedule_details' => $schedule_details_running ?? [], 'batch' => $batch, 'role' => $userRole]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function endAll(Request $request)
    {
        $request->validate([
            'schedule_detail_ids' => 'array|required'
        ]);

        $schedule_detail_ids = $request['schedule_detail_ids'];
        // dd($request->all());
        $action_status = false;
        foreach ($schedule_detail_ids as $id) {
            $results_attendance = ApiHttpClient::request('get', "attendance/$id/student-list")
                ->json();
            $attendance = $results_attendance['data'];
            $attend_trainees = [];
            foreach ($attendance as $data) {
                $attend_trainees[] = $data['ProfileId'];
            }
            // dd($attend_trainees);
            $results_end = ApiHttpClient::request('post', 'attendance/end-class', [
                'trainees' => $attend_trainees,
                'schedule_detail_id' => $id,
            ])->json();

            if (isset($results_attendance['success']) && $results_end['success']) {
                if ($results_attendance['success'] == true && $results_end['success'] == true) {
                    if (!$action_status) {
                        $action_status = true;
                    }
                } else {
                    $action_status = false;
                    break;
                }
            }
        }

        if (isset($action_status)) {
            if ($action_status) {
                session()->flash('type', 'success');
                session()->flash('message', 'Class end successfully');
                return redirect()->route('support.all-batch');
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', 'Something went wrong');
                return redirect()->back();
            }
        }
    }
}
