<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'exam', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $exam = $results['data'];
            $paginator = $this->customPaginate($results, $request, route('exam.index'));

            return view('exam.index', ['results' => $exam, 'paginator' => $paginator]);
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
    public function create($batch_id, $exam_config_id)
    {
        // dd($exam_config_id);
        $batch_id = decrypt($batch_id);
        $ec_results = ApiHttpClient::request('get', "exam-config/$exam_config_id")->json();
        $results = ApiHttpClient::request('get', "get-batch-show/$batch_id")->json();
        // dd($ec_results);
        if ($results['success'] == true && $ec_results['success'] == true) {
            $batch_data = $results['data'];
            $exam_config = $ec_results['data'];
            // dd($batch_data);
            return view('exam.create', ['result' => $batch_data, 'exam_config' => $exam_config]);
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
        $exam = $request->except('exact_exam_date', 'trainees', 'obtained_marks');

        $exam['exact_exam_date'] = Carbon::createFromFormat('d/m/Y', $request->exact_exam_date)->format('Y-m-d');
        $trainees = $request['trainees'];
        $obtain_marks = $request['obtained_marks'];
        $trainees_marks = array_combine($trainees, $obtain_marks);
        $exam['trainees_marks'] = $trainees_marks;
        // dd($exam);
        $data = ApiHttpClient::request('post', 'exam', $exam)->json();
        // dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            // dd($error_message);
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('exam.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function result($batch_id, $ec_id)
    {
        $batch_id = decrypt($batch_id);
        // dd($batch_id);
        $result = ApiHttpClient::request('get', "exam-result/$batch_id/$ec_id")->json();
        // dd($result);
        if ($result['success'] == true) {
            $exam = $result['data'];
            // $paginator = $this->customPaginate($results, $request, route('exam.index'));

            return view('exam.result', ['result' => $exam]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $result['message'] ?? 'Something went wrong');
            return back();
        }
    }
}
