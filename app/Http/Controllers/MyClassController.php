<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyClassController extends Controller
{
    public function index($scheduleId)
    {
        return view('myClass.index', compact('scheduleId'));
    }

    public function checkAttendance($scheduleId)
    {
        return view('myClass.checkAttendance');
    }
}
