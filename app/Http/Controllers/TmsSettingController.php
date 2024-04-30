<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class TmsSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = ApiHttpClient::request('get', 'tms-settings', [
            'page' => $request->page ?? 1,
            'search' => $request->search,
        ])->json();
        // dd($results);
        if ($results['success'] == true) {
            $paginator = $this->customPaginate($results, $request, route('tms-settings.index'));
            // dd($results);
            return view('tms-setting.index', ['results' => $results['data'], 'paginator' => $paginator]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tms-setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commonValidationRules = [
            'key' => 'required',
            'type' => 'required',
        ];

        $fileValidationRules = [
            'file' => 'required|mimes:jpg,jpeg,png,gif,svg|max:5120',
        ];

        $textValidationRules = [
            'text' => 'required'
        ];

        if ($request->has('type') && $request->input('type') === 'file') {
            $request->validate(array_merge($commonValidationRules, $fileValidationRules));
            $document = $request->except('file', 'type', 'text');
        } else {
            $request->validate(array_merge($commonValidationRules, $textValidationRules));
            $document = $request->except('file');
        }

        if ($request->hasFile('file') && $request->input('type') === 'file') {
            $file = $request->file('file');
            $document['type'] = image_type_to_mime_type(exif_imagetype($file->path()));
            $document['value'] = $this->fileUpload($file);

            if (strlen($document['value']) > 100) {
                $this->removeFile(storage_path('app/public/' . $document['value']));
                return redirect()->back()->withInput()->with('type', 'danger')->with('message', 'File name is too long.');
            }
        } else {
            $value = $document['text'];
            $document = $request->except('file', 'text');
            $document['value'] = $value;
        }

        $data = ApiHttpClient::request('post', 'tms-settings', $document)->json();

        if (!$data['success']) {
            if ($request->hasFile('file') && $request->input('type') === 'file') {
                $this->removeFile(storage_path('app/public/' . $document['value']));
            }
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $data['message'])->with('type', 'danger')->withInput();
        } else {
            return redirect()->route('tms-settings.index')->with('message', $data['message'] ?? 'Created successfully')->with('type', 'success');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = ApiHttpClient::request('get', "tms-settings/$id")->json();

        if ($results['success'] == true) {
            $data = $results['data'];

            return view('tms-setting.edit', ['setting' => $data]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Fetch existing data for the resource
        $results = ApiHttpClient::request('get', "tms-settings/$id")->json();
        $results = ApiHttpClient::request('get', "tms-settings/$id")->json();

        if ($results['success'] == true) {
            $data = $results['data'];
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
        // Common validation rules
        $commonValidationRules = [
            'key' => 'required',
            'type' => 'required',
        ];

        // File validation rules
        $fileValidationRules = [
            'file' => 'required|mimes:jpg,jpeg,png,gif,svg|max:5120',
        ];

        $textValidationRules = [
            'text' => 'required'
        ];

        // Validate input based on 'type' field
        if ($request->has('type') && $request->input('type') === 'file') {
            if ($data['type'] !== 'text') {
                $request->validate($commonValidationRules);
            } else {
                $request->validate(array_merge($commonValidationRules, $fileValidationRules));
            }

            $document = $request->except('file', 'type', 'text');
        } else {
            $request->validate(array_merge($commonValidationRules, $textValidationRules));
            $document = $request->except('file');
        }

        // Handle file upload/update
        if ($request->hasFile('file') && $request->input('type') === 'file') {
            $file = $request->file('file');
            $document['type'] = image_type_to_mime_type(exif_imagetype($file->path()));
            $document['value'] = $this->fileUpload($file);

            // Validate file name length
            if (strlen($document['value']) > 100) {
                $this->removeFile(storage_path('app/public/' . $document['value']));
                return redirect()->back()->withInput()->with('type', 'danger')->with('message', 'File name is too long.');
            }
        } else if ($request->input('type') === 'text') {
            // If 'text' type, update the 'value' field with the new text value
            // dd(1);
            $value = $document['text'] ?? '';
            $document = $request->except('file', 'text');
            $document['value'] = $value;
        } else {
            $document = $request->except('text', 'type');
            $document['type'] = $data['type'];
            $document['value'] = $data['value'];
        }
        // dd($document);
        // Send update request to API
        $updateData = ApiHttpClient::request('put', "tms-settings/$id", $document)->json();

        // Handle API response
        if (!$updateData['success']) {
            if ($request->hasFile('file') && $request->input('type') === 'file') {
                $this->removeFile(storage_path('app/public/' . $document['value']));
            }
            session()->flash('type', 'danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $updateData['message'])->with('type', 'danger')->withInput();
        } else {
            // Delete existing file if it exists
            if (isset($document['type'])) {
                if ($data['type'] !== 'text' && $request->hasFile('file') && $request->input('type') === 'file') {
                    $this->removeFile(storage_path('app/public/' . $data['value']));
                } elseif ($data['type'] !== 'text') {
                    $this->removeFile(storage_path('app/public/' . $data['value']));
                }
            }
            return redirect()->route('tms-settings.index')->with('message', $updateData['message'] ?? 'Updated successfully')->with('type', 'success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = ApiHttpClient::request('get', "tms-settings/$id")->json();
        $results = ApiHttpClient::request('delete', "tms-settings/$id")->json();

        if ($results['success'] == true && $file['success'] == true) {
            $filePath = storage_path('app/public/' . $file['data']['value']);
            $this->removeFile($filePath);

            session()->flash('type', 'Success');
            session()->flash('message', $results['message'] ?? 'Deleted successfully');
            return redirect()->back();
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return redirect()->back();
        }
    }
}
