<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
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
        $id = request()->id;
        // dd($id);
        $data['id'] = $id;

        $results = ApiHttpClient::request('get', "certificates/$id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $data['member'] = $results['data'];
            dd($data);
            $view = 'member';
            if ($data['member'] == null) {
                $view = 'warning';
                $data['url'] = 'verify';
            }
            return view("verify.$view", $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }


    }
}
