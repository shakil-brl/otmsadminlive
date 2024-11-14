<?php

namespace App\Http\Controllers;

use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class AttendanceReportController extends Controller
{
    public function create($batch_id)
    {
        $batch = ApiHttpClient::request('get', "batches/details/$batch_id")->json();

        $batch = $batch['data'] ?? [];

        return view('report.attendance.create', compact('batch'));
    }
}
