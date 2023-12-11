<?php

namespace App\Http\Livewire;

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
        $app_url = Str::finish(config('app.api_url'), '/');
        $response = Http::withHeaders([
            'Authorization' => Session::get('tokenType') . ' ' . Session::get('accessToken'),
        ])->get($app_url . 'trainerslist', [
            'search' => $this->search,
            'date_filter' => $this->dateFilter,
        ]);
        $this->data = $response->json()['items'];
        return view('livewire.trainer-profile-table');
    }
}
