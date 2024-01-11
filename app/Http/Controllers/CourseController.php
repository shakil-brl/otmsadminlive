<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'course', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $courses = $results['data'];
            $page_from = $results['data']['from'];
            $paginator = $this->customPaginate($results, $request, route('courses.index'));
            // dd($page_from);
            return view('courses.index', ['results' => $courses, 'paginator' => $paginator, 'page_from' => $page_from]);
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
        return view('courses.create');
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
            'name_en' => 'required',
            'name_bn' => 'required',
        ]);

        $course = $request->all();

        $data = ApiHttpClient::request('post', 'course/', $course)->json();
        //dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();

            // return redirect()->route('holydays.index');
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Created successfully');
            return redirect()->route('courses.index');
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
        $results = ApiHttpClient::request('get', "course/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $course = $results['data'];
            return view('courses.edit', ['course' => $course]);
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
            'name_en' => 'required',
            'name_bn' => 'required',
        ]);

        $course = $request->all();
        // dd($course);
        $data = ApiHttpClient::request('put', "course/$id", $course)->json();
        // dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Updated successfully');
            return redirect()->route('courses.index');
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
        $results = ApiHttpClient::request('delete', "course/$id")->json();

        if ($results['success'] == true) {
            // dd($holyday);
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Deleted successfully');
            return redirect()->route('courses.index');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->route('courses.index');
        }
    }
}
