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

class TrainerEvaluation extends Component
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
    public $phases = [];
    public $phase_id;
    public $order_by = 'DESC';
    public $total_evaluations = [];
    public $total_evaluations_get = [];
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

        $this->phases = ApiHttpClient::request(
            'get',
            'tms-phases'
        )->json()['data'];

        $this->searchFilter($this->page);

    }
    public function updatingPage($page)
    {
        $this->searchFilter($page);
    }
    public function searchFilter($page = null)
    {
        $this->searchData($page ?? 1);
    }

    private function searchData($page)
    {

        $this->total_evaluations_get = ApiHttpClient::request(
            'get',
            'detail/evaluation',
            [
                'page' => $page ?? $this->page,
                'type' => 2,
                'per_page' => $this->per_page,
                'search' => $this->search,
                'provider_id' => $this->provider_id,
                'division_code' => $this->division_code,
                'district_code' => $this->district_code,
                'upazila_code' => $this->upazila_code,
                'training_id' => $this->training_id,
                'phase_status' => $this->phase_id ? 3 : null,
                'order_by' => $this->order_by,
                'phase_id' => $this->phase_id,
            ]
        )->json();



        $this->total_evaluations = $this->total_evaluations_get['data']['data'];
        $this->from = $this->total_evaluations_get['data']['from'];
        $this->total_count = $this->total_evaluations_get['data']['total'];
    }

    public function render()
    {
        return view('livewire.detail.trainer-evaluation', [
            'paginator' => Controller::livewirePaginate($this->total_evaluations_get, $this->page ?? 1, route('dashboard_details.total_batches')),
        ]);
    }
}

