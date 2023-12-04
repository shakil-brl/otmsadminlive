<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    // show ui for all provider item
    public function index()
    {
        return view('providers.index');
    }

    // show ui for induvisual provider item
    public function show($id)
    {
        return view('providers.show', compact('id'));
    }

    public function allTrainer()
    {
        return 0;
    }
}
