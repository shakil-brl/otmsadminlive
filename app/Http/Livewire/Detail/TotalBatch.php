<?php

namespace App\Http\Livewire\Detail;

use App\Http\Clients\ApiHttpClient;
use Carbon\Carbon;
use Livewire\Component;
use App\Http\Controllers\Controller;
use Livewire\WithPagination;

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

        $this->batch_status = request()->batch_status;
    }
    public function render()
    {

        $total_batches = ApiHttpClient::request(
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
                'schedule_status' => $this->schedule_status,
                'trainer_count' => $this->trainer_count,
            ]
        )->json();
        //dd($classes);
        $paginator = Controller::livewirePaginate($total_batches, $this->page, route('dashboard_details.total_batches'));
        return view('livewire.detail.total-batch', [
            'total_batches' => $total_batches['data']['data'],
            'from' => $total_batches['data']['from'],
            'total_count' => $total_batches['data']['total'],
            'paginator' => $paginator,
        ]);
    }
}

