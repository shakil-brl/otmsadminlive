<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CommitteeController extends Controller
{
    // show ui for all committee name
    public function index()
    {
        return view('committees.index');
    }

    // show ui for induvisual committee 
    public function show($id)
    {
        return view('committees.show', compact('id'));
    }
}
