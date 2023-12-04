<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('users.index');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function profile()
    {
        return view('profiles.index');
    }

    public function show($userId)
    {
        // dd($userId);
        return view('users.show', compact('userId'));
    }
}
