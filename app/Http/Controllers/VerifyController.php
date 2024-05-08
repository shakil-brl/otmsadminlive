<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    function verify()
    {
        $data['table'] = 'member';
        $data['placeholder'] = 'Enter Certificate Number';
        return view('verify.verify', $data);
    }

    function search()
    {
        $data['id'] = request()->id;

        $data['member'] = [];
        $view = 'member';
        if ($data['member'] == null) {
            $view = 'warning';
            $data['url'] = 'verify';
        }
        return view("verify.$view", $data);
    }
}
