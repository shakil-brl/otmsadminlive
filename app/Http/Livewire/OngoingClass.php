<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Clients\ApiHttpClient;
use Illuminate\Http\Request;

class OngoingClass extends Component
{
    public $page = '';
    public $search = '';
    public $provider_id = '';
    public $dateFilter = '';
    public $data = [];

    public function render(Request $request)
    {
        $ongoing_classes = ApiHttpClient::request('get', 'detail/class-running', [
            'page' => $this->page ?? 1,
            'search' => $this->search,
            'provider_id' => $this->provider_id
        ])->json();
        // dump($ongoing_classes);
        if ($ongoing_classes['success'] == true) {
            $batches = $ongoing_classes['data']['data'];
            $paginator = $this->customPaginate($ongoing_classes, $request, route('dashboard_details.ongoing_classes'));
            $from = $ongoing_classes['data']['from'];

            return view('livewire.ongoing-class', ['ongoing_classes' => $batches, 'paginator' => $paginator, 'from' => $from]);
        } else {
            session()->flash('type', 'Danger');
            session()->flash('message', $ongoing_classes['message'] ?? 'Something went wrong');
            return redirect()->back();
        }

        // return view('livewire.ongoing-class');
    }
}
