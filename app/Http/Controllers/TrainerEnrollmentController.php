<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TrainerEnrollmentController extends Controller
{
    // show ui for all selected trainers enrollemnt to batch
    public function index()
    {
        return view('trainersenroll.index');
    }

    // show ui for induvisual selected trainees enrollemnt to batch
    public function show($userId)
    {
        return view('trainersenroll.show', compact('userId'));
    }
}
