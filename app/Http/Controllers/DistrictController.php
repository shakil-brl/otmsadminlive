<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    // show ui for all district item
    public function index()
    {
        return view('districts.index');
    }

    // show ui for induvisual district item
    public function show($id)
    {
        return view('districts.show', compact('id'));
    }
}
