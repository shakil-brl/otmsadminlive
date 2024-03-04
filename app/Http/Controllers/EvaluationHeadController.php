<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationHeadController extends Controller
{
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'evaluation-head', [
            ...$request->all(),
        ])->json();

        if ($results['success'] == true) {
            $evaluation = $results['data']['data'];
            $from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('evaluation-head.index'));
            return view('head-evaluation.index', ['evaluations' => $evaluation, 'paginator' => $paginator, 'from' => $from, 'request' => $request]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }


    public function create()
    {
        return view('head-evaluation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'is_bool' => 'required',
            'type' => 'required|integer|gte:1',
            'mark' => 'required|integer|gt:0',
            'status' => 'required|integer|in:1,0',
        ]);
        $requestData = $request->all();
        $data = ApiHttpClient::request('post', 'evaluation-head/', $requestData)->json();
        if (isset($data['error'])) {
            $errorMessage = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->withInput()->withErrors($errorMessage);
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('evaluation-head.index');
        }
    }


    public function edit($id)
    {
        $results = ApiHttpClient::request('get', "evaluation-head/$id")->json();
        if ($results['success'] == true) {
            $evaluation = $results['data'];
            return view('head-evaluation.edit', ['evaluation' => $evaluation]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    /**
     * Call specefic item data api for update data into database
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'is_bool' => 'required',
            'type' => 'required|integer|gte:1',
            'mark' => 'required|integer|gt:0',
            'status' => 'required|integer|in:1,0',
        ]);

        $data = ApiHttpClient::request('patch', "evaluation-head/$id", $request->all())->json();
        if (isset($data['error'])) {
            $error = $data['error'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error', $error)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Updated successfully');
            return redirect()->route('evaluation-head.index');
        }
    }

    /**
     * Call specefic item data api for delete data into database
     */
    public function destroy($id)
    {
        $results = ApiHttpClient::request('delete', "evaluation-head/$id")->json();

        if ($results['success'] == true) {
            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->route('evaluation-head.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('evaluation-head.index');
        }
    }


}
