<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    // all roles view
    public function index()
    {
        return view('role_permissions.index');
    }

    // edit a perticuler role with permissions
    public function edit($id)
    {
        return view('role_permissions.edit', compact('id'));
    }
}
