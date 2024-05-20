<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use PDF;

class CertificateController extends Controller
{
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

}
