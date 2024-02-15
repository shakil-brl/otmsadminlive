<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use PDF;

class AttendanceRepoController extends Controller
{
    public function showAttendanceSheet(Request $request)
    {
        $data = $request->all();
        if (!empty($data)) {
            $results = ApiHttpClient::request('get', 'monthly-attendance-report/', [
                'batchCode' => $request->batchCode,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
            ])->json();
            //dd($results);
            $data = $results['data'];
            $schedule = $results['schedule'];
            $students = $results['students'];
            $month = $results['month'];

            return View::make('attendance.attendance', compact('students', 'schedule','data','month'));
        } else {
            // Sample data (replace this with your actual data)
            return View::make('attendance.attendance');
        }
    }

    public function generateAttendancePdf()
    {
        $students = [];
        $attendanceData = [];

        for ($i = 1; $i <= 30; $i++) {
            $students[] = ['id' => $i, 'name' => 'Student ' . $i];
        }

        for ($day = 1; $day <= 20; $day++) {
            for ($studentId = 1; $studentId <= 30; $studentId++) {
                $attendanceData[$studentId][$day] = rand(0, 1) == 1; // 1 for present, 0 for absent
            }
        }
        $data = compact('students', 'attendanceData');
        $pdf = PDF::loadView('attendance.attendance_pdf', $data);
        return $pdf->stream('document.pdf');
    }

    public function monthlyAttendanceReport(Request $request)
    {

        $monthly_results = ApiHttpClient::request('get', 'monthly-attendance-report/', [
            'batchCode' => $request->batchCode,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ])->json();
        
        //dd($monthly_results);
        if ($provider_results['items'] == true) {
            $data['providers'] = $provider_results['items']['data'];
            $data['page_from'] = $provider_results['items']['from'];
            $data['paginator'] = $this->customPaginate2($provider_results, $request, route('batch.report'));
            return view('batch-report.index', $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

}
