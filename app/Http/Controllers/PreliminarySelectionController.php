<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreliminarySelectionController extends Controller
{
    public function index()
    {
        return view('preliminarySelected.index');
    }
}
