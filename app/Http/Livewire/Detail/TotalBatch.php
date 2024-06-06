<?php

namespace App\Http\Livewire\Detail;

use App\Exports\OngoingClassExport;
use App\Exports\TotalBatchExport;
use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Livewire\Component;
use App\Http\Controllers\Controller;
use Livewire\WithPagination;
use Excel;

class TotalBatch extends Component
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
    public $batch_status;
    public $schedule_status;
    public $trainer_count;
    public $phases = [];
    public $phase_id;
    public $phase_status;
    public $total_batches = [];
    public $total_batches_get = [];
    public $from;
    public $total_count = 0;
    public function updated($attr)
    {
        $this->gotoPage(1);
        if ($attr == 'search') {
            $this->search = trim($this->search);
        }

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
    public function export()
    {
        $data = ApiHttpClient::request(
            'get',
            'detail/total-batch',
            [
                'page' => $this->page,
                'per_page' => $this->per_page,
                'search' => $this->search,
                'provider_id' => $this->provider_id,
                'division_code' => $this->division_code,
                'district_code' => $this->district_code,
                'upazila_code' => $this->upazila_code,
                'training_id' => $this->training_id,
                'batch_status' => $this->batch_status,
                'phase_status' => $this->phase_id ? 3 : $this->phase_status,
                'phase_id' => $this->phase_id,
                'schedule_status' => $this->schedule_status,
                'trainer_count' => $this->trainer_count,
                'data_type' => 'get',
            ]
        )->json();

        $total_batches = $data['data'];


        return Excel::download(new TotalBatchExport($total_batches), 'Total Batch Details (' . Carbon::now()->format('d-m-Y h:i:s A') . ').xlsx', \Maatwebsite\Excel\Excel::XLSX);


    }
    public function mount()
    {
        $this->phases = ApiHttpClient::request(
            'get',
            "tms-phases/$this->phase_id",
        )->json()['data'];
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

        $this->phases = ApiHttpClient::request(
            'get',
            'tms-phases'
        )->json()['data'];

        $this->batch_status = request()->batch_status;
        $this->searchFilter();

    }


    public function searchFilter()
    {
        $this->total_batches_get = ApiHttpClient::request(
            'get',
            'detail/total-batch',
            [
                'page' => $this->page,
                'per_page' => $this->per_page,
                'search' => $this->search,
                'provider_id' => $this->provider_id,
                'division_code' => $this->division_code,
                'district_code' => $this->district_code,
                'upazila_code' => $this->upazila_code,
                'training_id' => $this->training_id,
                'batch_status' => $this->batch_status,
                'phase_status' => $this->phase_id ? 3 : $this->phase_status,
                'phase_id' => $this->phase_id,
                'schedule_status' => $this->schedule_status,
                'trainer_count' => $this->trainer_count,
            ]
        )->json();

        $this->total_batches = $this->total_batches_get['data']['data'];
        $this->from = $this->total_batches_get['data']['from'];
        $this->total_count = $this->total_batches_get['data']['total'];
    }
    public function render()
    {
        return view('livewire.detail.total-batch', [
            'paginator' => Controller::livewirePaginate($this->total_batches_get, $this->page ?? 1, route('dashboard_details.total_batches')),
        ]);
    }
}

