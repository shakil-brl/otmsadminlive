<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    // all roles view
    public function index()
    {
        return view('roles.index');
    }

    // edit a perticuler role with permissions
    public function edit($id)
    {
        return view('roles.edit', compact('id'));
    }
}
