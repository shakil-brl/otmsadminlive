<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // show ui for all category item
    public function index()
    {
        return view('categories.index');
    }

    // show ui for induvisual category item
    public function show($userId)
    {
        return view('categories.show', compact('userId'));
    }
}
