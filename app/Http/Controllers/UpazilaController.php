<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UpazilaController extends Controller
{
    // show ui for all upazila item
    public function index()
    {
        return view('upazilas.index');
    }

    // show ui for induvisual upazila item
    public function show($id)
    {
        return view('upazilas.show', compact('id'));
    }
}
