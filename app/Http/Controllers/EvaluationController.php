<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Call api for all evaluation data
     * And Display a listing of the evaluation data.
     */
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

    /**
     * Call api for all trainer schedule details data
     * And Display a listing of trainer schedule details data.
     */
    public function trainerScheduleDetailsList(Request $request)
    {
        $results = ApiHttpClient::request('get', 'schedule-details', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        if ($results['success'] == true) {
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
