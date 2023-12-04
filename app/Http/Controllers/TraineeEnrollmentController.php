<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TraineeEnrollmentController extends Controller
{
    // show ui for all selected trainees enrollemnt to batch
    public function index()
    {
        return view('traineesenroll.index');
    }

    // show ui for induvisual selected trainees enrollemnt to batch
    public function show($userId)
    {
        return view('traineesenroll.show', compact('userId'));
    }
}
