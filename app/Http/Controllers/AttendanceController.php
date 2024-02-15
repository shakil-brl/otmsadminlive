<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    protected $app_url;
    public function __construct()
    {
        $this->app_url = Str::finish(config('app.api_url'), '/');
    }
    public function show($scheduleId)
    {
        return view('attendance.show', compact('scheduleId'));
    }

    public function start(Request $request, $id)
    {
        $request->validate([
            'streaming_link' => [
                'required',
                'url',
                'starts_with:https',
            ],
            'static_link' => [
                'required',
                'url',
                'starts_with:https',
                'different:streaming_link',
                'not_regex:/^(https?:\/\/)?(www\.)?(facebook\.com|youtube\.com)\//'
            ]
        ]);

        $results = ApiHttpClient::request('post', 'attendance/start-class', [
            'schedule_detail_id' => decrypt($id),
            ...$request->only('streaming_link', 'static_link'),
        ])->json();

        if (isset($results['success'])) {
            if ($results['success'] == true) {
                return redirect()->route('attendance.form', $id);
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', $results['message'] ?? 'Something went wrong');
                return view('batch_schedule.index');
            }
        }
        return $data['message'] ?? 'Something went wrong';
    }

    public function updateLink(Request $request)
    {
        $request->validate([
            'streaming_link' => [
                'required',
                'url',
                'starts_with:https',
            ],
            'static_link' => [
                'required',
                'url',
                'starts_with:https',
                'different:streaming_link',
                'not_regex:/^(https?:\/\/)?(www\.)?(facebook\.com|youtube\.com)\//'
            ]
        ]);

        $results = ApiHttpClient::request('post', 'attendance/change-live-link', [
            ...$request->only('schedule_detail_id', 'streaming_link', 'static_link'),
        ])->json();

        if (isset($results['success'])) {
            if ($results['success'] == true) {
                session()->flash('type', 'Success');
                session()->flash('message', 'Link Updated Successfully');
                return redirect()->back();
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', $results['message'] ?? 'Something went wrong');
                return redirect()->back();
            }
        }
        return $data['message'] ?? 'Something went wrong';
    }

    public function attendanceForm($id, $batchId = null)
    {
        $id = decrypt($id);
        // dd($id);
        $schedule_details = ApiHttpClient::request('get', 'batch-schedule-details/' . $id)
            ->json();

        $results = ApiHttpClient::request('get', "attendance/$id/student-list")
            ->json();
        //dd($results);

        if (isset($results['success']) && isset($schedule_details['success'])) {
            if ($schedule_details['success'] == true && $results['success'] == true) {
                // dd($schedule_details['data']);
                return view('attendance.attendance_form', ['detail_id' => $id, 'schedule_detail' => $schedule_details['data'] ?? [], 'students' => $results['data'] ?? []]);
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', 'Something went wrong');
                return view('attendance.attendance_form');
            }
        }
        return $results['message'] ?? 'Something went wrong';
    }

    public function showAttendance($schedule_details_id)
    {
        $results = ApiHttpClient::request('get', 'attendance/show/' . $schedule_details_id)
            ->json();

        if (isset($results['success'])) {
            if ($results['success'] == true) {
                return view('attendance.attendance_list', ['trainees' => $results['data']]);
            }
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return back();
        }
    }

    public function takeAttendance(Request $request, $id)
    {
        $request->validate([
            'submit' => 'required|in:attendance,end',
            'schedule_detail_id' => 'required|integer',
            'attendance' => 'required|array|min:1',
            'attendance.*' => 'required|integer',
        ]);

        if ($request->submit == 'attendance') {

            $results = ApiHttpClient::request('post', 'attendance/take', [
                'trainees' => $request->attendance,
                'batch_schedule_detail_id' => $id,
            ])->json();

            if (isset($results['success'])) {
                if ($results['success'] == true) {
                    session()->flash('type', 'Success');
                    session()->flash('message', $results['data'] ?? 'Something went wrong');
                    return redirect()->back();
                } else {
                    session()->flash('type', 'Danger');
                    session()->flash('message', $results['message'] ?? 'Something went wrong');
                    return view('attendance.attendance_form');
                }
                session()->flash('type', 'Danger');
                session()->flash('message', $results['message'] ?? 'Something went wrong');
                return view('attendance.attendance_form');
            }
        } else {
            $results = ApiHttpClient::request('post', 'attendance/end-class', [
                'trainees' => $request->attendance,
                'schedule_detail_id' => $id,
            ])->json();

            if (isset($results['success'])) {
                if ($results['success'] == true) {
                    session()->flash('type', 'Success');
                    session()->flash('message', $results['message'] ?? 'Something went wrong');
                    return redirect()->back();
                } else {
                    session()->flash('type', 'Success');
                    session()->flash('message', $results['message'] ?? 'Something went wrong');
                    return redirect()->back();
                }

                session()->flash('type', 'Success');
                session()->flash('message', $results['message'] ?? 'Something went wrong');
                return redirect()->back();
            }
        }
    }
}
