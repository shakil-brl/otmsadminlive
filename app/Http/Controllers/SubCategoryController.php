<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    // show ui for all sub category item
    public function index()
    {
        return view('subcategories.index');
    }

    // show ui for induvisual sub category item
    public function show($id)
    {
        return view('subcategories.show', compact('id'));
    }
}
