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
        $data['placeholder'] = 'Enter Certificate ID';
        return view('verify.verify', $data);
    }
    public function getCerNo(Request $request)
    {
        $request->validate([
            'certificate_no' => 'required',
        ]);
        return redirect()->route('search', $request->certificate_no);

    }
    function search(Request $request, $id)
    {
        $certificate_id = (int) substr($id, 3);

        $data['id'] = $id;

        $results = ApiHttpClient::request('get', "certificates/$certificate_id")->json();
        if ($results['success'] == true) {
            $data['member'] = $results['data'];
            // dd($data);
            $view = 'success';
            if ($data['member'] == null) {
                $view = 'warning';
                $data['url'] = 'verify';
            }
            // dd(1);
            return view("verify.$view", $data);
        } elseif ($results['success'] == false && $results['message'] == "Data not found") {
            $view = 'warning';
            $data['url'] = 'verify';
            return view("verify.$view", $data);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }


    }
}
