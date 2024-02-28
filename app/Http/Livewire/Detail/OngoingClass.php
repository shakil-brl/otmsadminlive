<?php

namespace App\Http\Livewire\Detail;

use App\Exports\OngoingClassExport;
use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Livewire\Component;
use App\Http\Controllers\Controller;
use Livewire\WithPagination;
use Excel;
use Session;

class OngoingClass extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $per_page = 15;
    public $divisions = [];
    public $division_code;
    public $districts = [];
    public $district_code;
    public $upazilas = [];
    public $upazila_code;
    public $training_titles = [];
    public $training_title;
    public $providers = [];
    public $trainings = [];
    public $training_id;
    public $provider_id;
    public $from_date;
    public $to_date;
    public $status;
    public $total;
    // public $current_schedule = 1;
    public $current_schedule = null;
    public function updated($attr)
    {
        $this->gotoPage(1);
        if ($attr == 'division_code') {
            $this->districts = ApiHttpClient::request(
                'get',
                'detail/district',
                [
                    'data_type' => 'get',
                    'division_code' => $this->division_code ? $this->division_code : 'aa',
                ]
            )->json()['data'];
            $this->district_code = null;
            $this->upazila_code = null;
            $this->gotoPage(1);
        }

        if ($attr == 'district_code') {
            $this->upazilas = ApiHttpClient::request(
                'get',
                'detail/upazila',
                [
                    'data_type' => 'get',
                    'district_code' => $this->district_code ? $this->district_code : 'aa',
                ]
            )->json()['data'];
            $this->upazila_code = null;
        }

    }

    public function mount()
    {
        $this->divisions = ApiHttpClient::request(
            'get',
            'detail/division',
            [
                'data_type' => 'get',
            ]
        )->json()['data'];

        $this->providers = ApiHttpClient::request(
            'get',
            'detail/development-partner',
            [
                'data_type' => 'get',
            ]
        )->json()['data'];
        $this->trainings = ApiHttpClient::request(
            'get',
            'detail/training'
        )->json()['data'];
        $this->status = request()->status;
        if ($this->status == 2 || $this->status == null) {
            $this->from_date = Carbon::now()->toDateString();
            $this->to_date = Carbon::now()->toDateString();
        }
        if ($this->status == 3 || $this->status == null) {
            $this->current_schedule = null;
        }
        $this->status = null;
    }
    public function exportData()
    {
        $data = ApiHttpClient::request(
            'get',
            'detail/class-running',
            [
                'page' => $this->page,
                'per_page' => $this->total,
                'search' => $this->search,
                'provider_id' => $this->provider_id,
                'division_code' => $this->division_code,
                'district_code' => $this->district_code,
                'upazila_code' => $this->upazila_code,
                'training_id' => $this->training_id,
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'status' => $this->status,
                'current_schedule' => $this->current_schedule,
            ]
        )->json();

        $classes = $data['data']['data'];
        $from = $data['data']['from'];
        ;

        return Excel::download(new OngoingClassExport($classes, $from), 'Ongoing Class ' . Carbon::now()->format('d-m-Y h:i:s A') . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function render()
    {

        $classes = ApiHttpClient::request(
            'get',
            'detail/class-running',
            [
                'page' => $this->page,
                'per_page' => $this->per_page,
                'search' => $this->search,
                'provider_id' => $this->provider_id,
                'division_code' => $this->division_code,
                'district_code' => $this->district_code,
                'upazila_code' => $this->upazila_code,
                'training_id' => $this->training_id,
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'status' => $this->status,
                'current_schedule' => $this->current_schedule,
            ]
        )->json();
        //dd($classes);

        $paginator = Controller::livewirePaginate($classes, $this->page, route('dashboard_details.ongoing_classes'));
        $this->total = $classes['data']['total'];
        return view('livewire.detail.ongoing-class', [
            'classes' => $classes['data']['data'],
            'from' => $classes['data']['from'],
            'total_count' => $classes['data']['total'],
            'paginator' => $paginator,
        ]);
    }
}
