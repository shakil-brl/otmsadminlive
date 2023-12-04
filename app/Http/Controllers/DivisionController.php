<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    // show ui for all division item
    public function index()
    {
        return view('divisions.index');
    }

    // show ui for induvisual division item
    public function show($divisionId)
    {
        return view('divisions.show', compact('divisionId'));
    }
}
