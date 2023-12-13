<?php

namespace App\Http\Livewire;

use App\Http\Clients\ApiHttpClient;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TrainerProfileTable extends Component
{
    public $search = '';
    public $dateFilter = '';
    public $data = [];

    public function render()
    {
        $response = ApiHttpClient::request('get', 'trainerslist', [
            'search' => $this->search,
            'date_filter' => $this->dateFilter,
        ]);
        $this->data = $response->json()['items'];
        return view('livewire.trainer-profile-table');
    }
}
