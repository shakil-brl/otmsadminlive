<?php

namespace App\Http\Livewire;

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
        //dd($this->dateFilter);
        $app_url = Str::finish(config('app.api_url'), '/');
        $response = Http::withHeaders([
            'Authorization' => Session::get('tokenType') . ' ' . Session::get('accessToken'),
        ])->get($app_url . 'inspection', [
            'search' => $this->search,
            'date_filter' => $this->dateFilter,
        ]);
        $this->data = $response->json()['items'];
        return view('livewire.inspection');
    }
}
