<?php

namespace App\Http\Livewire\List;

use App\Exports\CommonExcelExport;
use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceReport extends Component
{
    public $batch;
    public $batch_code;
    public $from_date;
    public $to_date;
    public $class_attendances = [];
    public $with_date = 1;

    public function search()
    {
        $class_attendances = ApiHttpClient::request('get', 'report/attendance/date-range', [
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'batch_id' => $this->batch['id'],
        ])->json()['data'] ?? [];
        $data = [];
        foreach ($class_attendances as $key => $class_attendance) {
            $data[] = [
                'profile_id' => $class_attendance['profile']['id'] ?? '',
                'student_name' => $class_attendance['profile']['KnownAs'] ?? '',
                'student_name_bn' => $class_attendance['profile']['KnownAsBangla'] ?? '',
                'class_date' => $class_attendance['schedule_detail']['date'] ?? '',
                'is_present' => $class_attendance['is_present'] ?? 0,
            ];
        }
        $data =  collect($data)->sortBy('class_date');
        $this->class_attendances = $data;
        return $data;
    }

    public function export()
    {
        $data['class_attendances'] = $this->search();
        $data['from_date'] = $this->from_date;
        $data['to_date'] = $this->to_date;
        $data['batch'] = $this->batch;
        $data['with_date'] = $this->with_date;

        return Excel::download(new CommonExcelExport('livewire.list.att-report-excel', $data), 'Attendance Report (' . Carbon::now()->format('d-m-Y h.i.s A') . ').xlsx');
    }

    public function mount($batch)
    {
        $this->batch = $batch;
        $this->batch_code = $batch['batch_code'] ?? null;
        $this->search();
    }

    public function render()
    {
        return view('livewire.list.attendance-report');
    }
}
