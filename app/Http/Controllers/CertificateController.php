<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use App\Trait\FileUpload;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use PDF;

class CertificateController extends Controller
{
    use FileUpload;
    public function create($batch_id)
    {
        $batch_id = decrypt($batch_id);
        $results = ApiHttpClient::request('get', "get-batch-show/$batch_id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $batch_data = $results['data'];

            $hasCertificates = false;

            foreach ($batch_data['trainees'] as $trainee) {
                if (isset($trainee['certificate'])) {
                    $hasCertificates = true;
                    break; // Exit the loop as soon as a certificate is found
                }
            }
            // dd($hasCertificates);

            return view('certificate.create', ['batch' => $batch_data, 'has_certificate' => $hasCertificates]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'training_applicant_ids' => 'required|array',
        ]);
        $data = $request->all();
        $data = ApiHttpClient::request('post', 'certificates', $data)->json();
        // dd($data);
        if (isset($data['error'])) {
            $error_message = $data['message'];
            session()->flash('type', 'Danger');
            session()->flash('message', 'Validation failed');
            return redirect()->back()->with('error_message', $error_message)->withInput();
        } else {
            session()->flash('type', 'Success');
            session()->flash('message', $data['message'] ?? 'Distributed successfully');
            return redirect()->back();
        }
    }

    public function eligible($batch_id)
    {
        $batch_id = decrypt($batch_id);
        $results = ApiHttpClient::request('get', "get-batch-show/$batch_id")->json();
        // dd($results);
        if ($results['success'] == true) {
            $batch_data = $results['data'];

            $hasCertificates = false;

            foreach ($batch_data['trainees'] as $trainee) {
                if (isset($trainee['certificate'])) {
                    $hasCertificates = true;
                    break; // Exit the loop as soon as a certificate is found
                }
            }
            // dd($hasCertificates);

            return view('certificate.eligible', ['batch' => $batch_data, 'has_certificate' => $hasCertificates]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function print(Request $request)
    {
        $data = $request->validate([
            'certificate_ids' => ['required', 'array']
        ]);
        $results = ApiHttpClient::request('post', "certificates/print", $data)->json();

        $setting_configs = ApiHttpClient::request('get', "tms-settings", [])->json();
        $data['setting_configs'] = collect($setting_configs['data'])->pluck('value', 'key');


        if ($results['success'] == true) {
            $settings = ApiHttpClient::request('get', "tms-settings")->json();

            if ($settings['success'] == true) {
                $settings_data = $settings['data'];
            } else {
                session()->flash('type', 'Danger');
                session()->flash('message', $settings['message'] ?? 'Something went wrong');
                return back();
            }

            $data['certificates'] = $results['data'];
            $data['settings_data'] = $settings_data;
            $setting_collection = collect($settings_data);
            $data['setting_collection'] = $setting_collection;
            // dd($data['auth_1_stamp']);
            // return view('certificate.certificate', $data);
            $pdf = PDF::loadView('certificate.certificate', $data, [], [
                'format' => 'A4',
                'orientation' => 'L',
                'margin_top' => 0,
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_bottom' => 0,
            ]);

            return $pdf->stream('certificate.pdf');
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $results['message'] ?? 'Something went wrong');
            return back();
        }
    }

    public function certificateConfig(Request $request)
    {
        $results = ApiHttpClient::request('get', "tms-settings", [])->json();
        $data = collect($results['data'])->pluck('value', 'key');
        return view('certificate.config', compact('data'));
    }
    public function certificateConfigStore(Request $request)
    {
        // return $request->all();
        $request->validate([
            'certificate_bg' => 'nullable|mimes:png|max:2000',
            'certificate_title' => 'required|string',
            'description_line_1' => 'required',
            'description_line_2' => 'required',
            'description_line_3' => 'required',
            'sign_description_left' => 'required',
            'certificate_sub_title' => 'required',
            'sign_description_right' => 'required',
            'sign_right' => 'nullable|mimes:png|max:200',
            'sign_left' => 'nullable|mimes:png|max:200',
        ]);
        $request['sign_description_left'] = nl2br(e($request['sign_description_left']));
        $request['sign_description_right'] = nl2br(e($request['sign_description_right']));

        if ($request->hasFile('certificate_bg')) {
            $file_name = 'certificate-bg.png';
            $this->upload($request->file('certificate_bg'), $file_name);
        }

        if ($request->hasFile('sign_left')) {
            $file_name = 'sign1.png';
            $this->upload($request->file('sign_left'), $file_name);
        }
        if ($request->hasFile('sign_right')) {
            $file_name = 'sign2.png';
            $this->upload($request->file('sign_right'), $file_name);
        }

        $keys = [];
        $values = [];
        $al_keys = ['certificate_title', 'description_line_1', 'description_line_2', 'description_line_3', 'sign_description_left', 'sign_description_right', 'certificate_sub_title'];
        foreach ($al_keys as $key) {
            if ($request->{$key}) {
                $keys[$key] = $key;
                $values[$key] = $request->{$key};
            }
        }

        $data = [
            'keys' => $keys,
            'values' => $values,
        ];

        $results = ApiHttpClient::request('post', "tms-settings-multiple-store", $data)->json();

        $alert = [
            'type' => 'Success',
            'message' => 'Updated successfully.',
        ];
        return redirect()->back()->with($alert);

    }
}
