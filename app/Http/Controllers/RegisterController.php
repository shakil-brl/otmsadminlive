<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.users.signup');
    }
    
}
