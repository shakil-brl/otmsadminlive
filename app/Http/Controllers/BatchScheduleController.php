<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BatchScheduleController extends Controller
{


    public function scheduleDetailCreate(Request $request, $training_batch_id)
    {

        $response = ApiHttpClient::request('get', 'batch/' . $training_batch_id . '/show')
            ->json();
        return view('batch_schedule.batch-scheedule-create', ['batch' => $response['data']]);

    }
    public function scheduleDetailStore(Request $request, $training_batch_id)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        $response = ApiHttpClient::request(
            'POST',
            'schedule/schedule-detail-store/' . $training_batch_id,
            [
                ...$request->all(),
                'start_time' => Carbon::createFromFormat('H:i', $request->start_time)->format('H:i:s'),
                'end_time' => Carbon::createFromFormat('H:i', $request->end_time)->format('H:i:s'),
            ]
        )
            ->json();


        if (isset($response['error'])) {
            $error = $response['error'];
            $errorMessage = $response['message'];
            return redirect()->back()->withInput()->withErrors($errorMessage);
        } else {
            if ($response['success'] == false) {
                session()->flash('type', 'Warning');
                session()->flash('message', $response['message']);
                return redirect()->back()->withInput();
            } else {
                session()->flash('type', 'Success');
                session()->flash('message', $response['message']);
                return redirect()->back();
            }

        }

    }


    public function scheduleDetailDestroy(Request $request, $schedule_detail_id)
    {
        $response = ApiHttpClient::request('delete', 'schedule/schedule-detail-destroy/' . $schedule_detail_id)
            ->json();
        if ($response['success'] == true) {
            session()->flash('type', 'Success');
        } else {
            session()->flash('type', 'Warning');
        }
        session()->flash('message', $response['message'] ?? 'Something went wrong');
        return redirect()->back();

    }
    // all batches
    public function batches(Request $request)
    {
        $page = request('page', 1);
        $app_url = Str::finish(config('app.api_url'), '/');
        $results = ApiHttpClient::request('get', 'batch/list', $request->all())
            ->json();


        if ($results['success'] == true) {
            $from = $results['data']['from'] ?? 1;
            $paginator = $this->customPaginate($results, $request, route('batch-schedule.batches'));
            return view('batches.index', ['results' => $results['data'], 'from' => $from, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return view('batches.index');
        }
    }

    public function trainerBatch()
    {
        $page = request('page', 1);

        $results = ApiHttpClient::request('get', 'attendance/batch-list')
            ->json();

        if ($results['success']) {
            return view('batches.trainer_batch', ['results' => $results['data']]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return view('batches.trainer_batch');
        }
    }

    // all batch schedules 

    public function index($schedule_id, $batch_id)
    {
        $schedule_id = decrypt($schedule_id);
        $batch_id = decrypt($batch_id);

        $userRole = Session::get('access_token.role');
        $results = ApiHttpClient::request('get', 'batch/' . $batch_id . '/show')
            ->json();
        $schedule_details = ApiHttpClient::request('get', 'all-schedule/' . $schedule_id)
            ->json();

        if ($results['success'] == true && $schedule_details['success'] == true) {
            $batch = $results['data'];

            return view('batch_schedule.index', ['schedule_details' => $schedule_details['data'] ?? [], 'batch' => $batch, 'role' => $userRole]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // create batch schedule
    public function create($batch_id)
    {
        $batch_id = decrypt($batch_id);
        $error = session('error') ?? '';
        $results = ApiHttpClient::request('get', 'batch/' . $batch_id . '/show')
            ->json();
        if ($results['success'] == true) {
            $batch = $results['data'];
            return view('batch_schedule.create', compact(['batch', 'error']));
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return view('batch_schedule.create');
        }
    }

    // store batch schedule
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'class_days' => 'required|array|min:1',
            'start_date' => 'required|date_format:d/m/Y',
            'class_time' => 'required|date_format:H:i',
            'class_duration' => 'required|integer|gt:0',
            'total_days' => 'required|integer|gt:0',
        ]);

        $schedule = $request->except('start_date', 'class_days');

        if ($request->class_days != null) {
            $schedule['class_days'] = implode(',', $request->class_days);
        }

        $schedule['start_date'] = Carbon::createFromFormat('d/m/Y', $request->start_date)
            ->format('Y-m-d');

        $data = ApiHttpClient::request('post', 'schedule/create', $schedule)->json();

        if (isset($data['errors'])) {
            $error = $data['errors'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error', $error)->withInput();

            return redirect('batch_schedules');
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect('batch_schedules');
        }
    }

    // show batch schedule
    public function show($schedule_id, $batch_id)
    {
        $results = ApiHttpClient::request('get', 'batches/' . $batch_id . '/show')
            ->json();
        $schedule_details = ApiHttpClient::request('get', 'all-schedule/' . $schedule_id)
            ->json();
        if ($results['success'] == true && $schedule_details['success'] == true) {
            $batch = $results['data'];

            return view('batch_schedule.index_office', ['schedule_details' => $schedule_details['data'] ?? [], 'batch' => $batch]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // running batches
    public function runningBatches(Request $request)
    {

        //dd('dd');
        $running_batches = ApiHttpClient::request('get', 'detail/running-batch', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        //dd($running_batches);
        if ($running_batches['success'] == true) {
            $batches = $running_batches['data']['data'];

            //dd($batches);
            $paginator = $this->customPaginate($running_batches, $request, route('batch-schedule.runningBatches'));

            return view('batch_schedule.running_batch', ['running_batches' => $batches, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $running_batches['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function runningClassList(Request $request)
    {
        $running_batches = ApiHttpClient::request('get', 'detail/running-batch', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($running_batches);
        if ($running_batches['success'] == true) {
            $batches = $running_batches['data']['data'];
            $paginator = $this->customPaginate($running_batches, $request, route('batch-schedule.runningBatches'));

            return view('batch_schedule.running-class-list', ['running_batches' => $batches, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $running_batches['message'] ?? 'Something went wrong');
            return back();
        }
    }

    // edit
    public function edit($batch_id)
    {
        dd($batch_id);
    }

    // 
    public function destroy($batch_id)
    {
        $results = ApiHttpClient::request('delete', "schedule/destroy/$batch_id")->json();

        if ($results['success'] == true) {
            // dd($holyday);
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->back();
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    // 
    public function clean($batch_id)
    {
        $previousRouteUrl = url()->previous();
        $previousRouteName = app('router')->getRoutes()->match(app('request')->create($previousRouteUrl))->getName();
        // dd($previousRouteName);
        $results = ApiHttpClient::request('delete', "schedule/schedule-clean/$batch_id")->json();

        if ($results['success'] == true) {
            // dd($holyday);
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Schedule Details Clean successfully');
            if ($previousRouteName == "batch-schedule.index") {
                return redirect()->route('batch-schedule.batches');
            }
            return redirect()->route('batches.all');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }
}
