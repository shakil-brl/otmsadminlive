<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassDocumentationController extends Controller
{
    /**
     * Call api for all class documentations data
     * And Display a listing of the class documentations.
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'class-docs', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();

        if ($results['success'] == true) {
            $classDocs = $results['data']['data'];
            $paginator = $this->customPaginate($results, $request, route('class-docs.index'));

            return view('class-docs.index', ['classDocs' => $classDocs, 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    
}
