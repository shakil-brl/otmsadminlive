<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{

    public function batchList(Request $request)
    {
        $results = ApiHttpClient::request('get', 'detail/total-batch', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
            'trainer_count' => 2,
        ])->json();
        if ($results['success'] == true) {
            $paginator = $this->customPaginate($results, $request, route('evaluation-head.index'));
            return view('evaluations.batch-list', ['total_batches' => $results['data']['data'], 'paginator' => $paginator, 'page_from' => $results['data']['from']]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return view('evaluations.batch-list');
        }
    }
    public function traineeList(Request $request, $batch_id)
    {
        $results = ApiHttpClient::request('get', 'detail/trainee-total', [
            'page' => $request->page ?? 1,
            'without_dropout' => $request->search,
            'batch_id' => $batch_id,
            'data_type' => 'get',
        ])->json();

        if ($results['success'] == true) {
            return view('evaluations.trainee-list', ['students' => $results['data']]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return view('evaluations.batch-list');
        }
    }

    public function evaluationForm($training_applicant_id)
    {
        $student = ApiHttpClient::request('get', 'detail/trainee-total', [
            'applicant_id' => $training_applicant_id,
            'data_type' => 'first',
        ])->json();

        $heads = ApiHttpClient::request('get', 'evaluation-head', [
            'type' => 1,
            'status' => 1,
            'data_type' => 'get',
        ])
            ->json();

        return view('evaluations.head', [
            'heads' => $heads['data'],
            'student' => $student['data'],
        ]);


    }
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'evaluation-head', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $page_from = $results['data']['from'];
            $evaluation = $results['data']['data'];
            $paginator = $this->customPaginate($results, $request, route('evaluation-head.index'));
            return view('head-evaluation.index', ['evaluation' => $evaluation, 'paginator' => $paginator, 'page_from' => $page_from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }


    public function trainerScheduleDetailsList(Request $request)
    {
        $results = ApiHttpClient::request('get', 'schedule-details', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        if ($results['success'] == true) {
            // dd($results['data']);
            $page_from = $results['data']['from'];
            $evaluation = $results['data']['data'];
            $paginator = $this->customPaginate($results, $request, route('trainer-schedule-details.lists'));
            return view('evaluations.index', ['evaluation' => $evaluation, 'paginator' => $paginator, 'page_from' => $page_from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function scheduleClassStudents($id, $batchId = null)
    {
        $results = ApiHttpClient::request('get', "attendance/$id/student-list")
            ->json();

        if (isset($results['success'])) {
            // dd($results['data']);
            if ($results['success'] == true) {
                return view('evaluations.studentList', ['detail_id' => $id, 'students' => $results['data'] ?? []]);
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', $results['message'] ?? 'Something went wrong');
                return view('evaluations.studentList');
            }
        }
        return $results['message'] ?? 'Something went wrong';
    }

    public function showStudentEvaluation($class_att_id)
    {
        $results = ApiHttpClient::request('get', "attendance/$class_att_id/student-info")
            ->json();

        $evaluation_head = ApiHttpClient::request('get', 'evaluation-head-user/' . '1')
            ->json();

        if (isset($results['success']) && isset($evaluation_head['success'])) {
            $head = $evaluation_head['data'];
            if ($results['success'] == true && $evaluation_head['success'] == true) {
                return view('evaluations.head', ['class_att_id' => $class_att_id, 'students' => $results['data'] ?? [], 'head' => $head]);
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', $results['message'] ?? 'Something went wrong');
                return view('evaluations.head');
            }
        }
        return $results['message'] ?? 'Something went wrong';
    }

    public function storeStudentEvaluation(Request $request, $class_att_id)
    {
        $request['class_att_id'] = $class_att_id;

        $results = ApiHttpClient::request('post', "store-student-evaluation/$class_att_id", $request->all())
            ->json();
        if (isset($results['error'])) {
            $error = $results['error'];
            $errorMessage = $results['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Created successfully');
            if (isset($results['schedule_detail_id'])) {
                return redirect()->route('trainer-schedule-details.students', $results['schedule_detail_id']);
            } else {
                return redirect()->back();
            }
        }
    }
}
