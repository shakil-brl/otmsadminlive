<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AttendanceRepoController extends Controller
{
    public function showAttendanceSheet()
    {
        // Sample data (replace this with your actual data)
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

        return View::make('attendance.attendance', compact('students', 'attendanceData'));
    }
}
