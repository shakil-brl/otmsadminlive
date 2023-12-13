<?php

namespace App\Http\Livewire;

use App\Http\Clients\ApiHttpClient;
use Livewire\Component;
use Http;
use Session;
use Illuminate\Support\Str;

class Inspection extends Component
{
    public $search = '';
    public $dateFilter = '';
    public $data = [];
    public function render()
    {
        $response = ApiHttpClient::request('get', 'inspection', [
            'search' => $this->search,
            'date_filter' => $this->dateFilter,
        ]);
        $this->data = $response->json()['data'];
        return view('livewire.inspection');
    }
}
