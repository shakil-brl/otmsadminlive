<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{

    public function index()
    {
        return view('auth.users.signin');
    }

    public function dashboard(){        
        return view('auth.users.signin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
  
        return redirect()->back();
    }
}
