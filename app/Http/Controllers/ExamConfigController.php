<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use View;

class ExamConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'exam-config', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $exam_configs = $results['data'];
            $paginator = $this->customPaginate($results, $request, route('exam-config.index'));

            return view('exam-config.index', ['results' => $exam_configs, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = ApiHttpClient::request('get', 'training_title')
            ->json();

        if ($results['success'] == true) {
            $data = $results['data'];
            return view('exam-config.create', ['trainings' => $data]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'training_id' => 'required',
            'exam_title' => 'required',
            'exam_date' => 'required|date_format:d/m/Y',
            'total_mark' => 'required',
            'pass_mark' => 'required',
        ]);

        $exam_config = $request->except('exam_date');

        $exam_config['exam_date'] = Carbon::createFromFormat('d/m/Y', $request->exam_date)->format('Y-m-d');

        $result = ApiHttpClient::request('post', 'exam-config', $exam_config)->json();

        if (isset($result['error'])) {
            $error_message = $result['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $result['message'] ?? 'Created successfully');
            return redirect()->route('exam-config.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = ApiHttpClient::request('get', "exam-config/$id")->json();
        $trainingResults = ApiHttpClient::request('get', 'training_title')->json();

        if ($results['success'] == true && $trainingResults['success'] == true) {
            $exam_config = $results['data'];
            $data = $trainingResults['data'];

            return view('exam-config.edit', ['exam_config' => $exam_config, 'trainings' => $data]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'training_id' => 'required',
            'exam_title' => 'required',
            'exam_date' => 'required|date_format:d/m/Y',
            'total_mark' => 'required',
            'pass_mark' => 'required',
        ]);

        $exam_config = $request->except('exam_date');

        $exam_config['exam_date'] = Carbon::createFromFormat('d/m/Y', $request->exam_date)->format('Y-m-d');

        $result = ApiHttpClient::request('put', "exam-config/$id", $exam_config)->json();

        if (isset($result['error'])) {
            $error_message = $result['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $result['message'] ?? 'Updated successfully');
            return redirect()->route('exam-config.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $results = ApiHttpClient::request('delete', "exam-config/$id")->json();

        if ($results['success'] == true) {
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->route('exam-config.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('exam-config.index');
        }
    }

    public function trainingExam(Request $request, $batch_id, $training_id = null)
    {
        $batch_id = decrypt($batch_id);
        $batch_results = ApiHttpClient::request('get', "get-batch-show/$batch_id")->json();

        if ($batch_results['success'] == true) {
            $batch_data = $batch_results['data'];
            $results = ApiHttpClient::request('get', 'exam-config', [
                'training_id' => $training_id ?? $batch_data['get_training']['id'],
            ])->json();
            if ($results['success'] == true) {
                $exam_configs = $results['data'];
                $paginator = $this->customPaginate($results, $request, route('exam-config.index'));
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', $results['message'] ?? 'Something went wrong');
                return back();
            }
            // dd($batch_data);
            return view('exam-config.all', ['results' => $exam_configs, 'paginator' => $paginator, 'batch_data' => $batch_data]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $batch_results['message'] ?? 'Something went wrong');
            return back();
        }
    }
}
