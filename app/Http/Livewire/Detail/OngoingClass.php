<?php

namespace App\Http\Livewire\Detail;

use App\Http\Clients\ApiHttpClient;
use Livewire\Component;
use App\Http\Controllers\Controller;
use Livewire\WithPagination;

class OngoingClass extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $divisions = [];
    public $division_code;
    public $disticts = [];
    public $distict_code;
    public $upazilas = [];
    public $upazila_code;
    public $training_titles = [];
    public $training_title;
    public $providers = [];
    public $provider_id;
    public function updated()
    {
        $this->gotoPage(1);
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

    }
    public function render()
    {

        $classes = ApiHttpClient::request(
            'get',
            'detail/class-running',
            [
                'page' => $this->page,
                'per_page' => 3,
                'search' => $this->search,
                'provider_id' => $this->provider_id,
            ]
        )->json();

        $this->districts = ApiHttpClient::request(
            'get',
            'detail/district',
            [
                'data_type' => 'get',
                'division_code' => $this->division_code,
            ]
        )->json()['data'];

        $this->upazilas = ApiHttpClient::request(
            'get',
            'detail/upazila',
            [
                'data_type' => 'get',
                'district_code' => $this->distict_code ? $this->distict_code : 'aa',
            ]
        )->json()['data'];



        $paginator = Controller::livewirePaginate($classes, $this->page, route('dashboard_details.ongoing_classes'));
        return view('livewire.detail.ongoing-class', [
            'classes' => $classes['data']['data'],
            'from' => $classes['data']['from'],
            'paginator' => $paginator,
        ]);
    }
}
