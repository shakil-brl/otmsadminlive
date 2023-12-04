<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class Dashboard extends Component
{
    public $course_id;
    public $district_id;
    public $division_id;
    public $upazila_id;
    public $batch;
    public function render()
    {
        $app_url = Str::finish(config('app.api_url'), '/');
        $course_id = $this->course_id;
        $district_id = $this->district_id;
        $division_id = $this->division_id;
        $upazila_id = $this->upazila_id;
        $batch = $this->batch;

        return view('livewire.dashboard', [
            'courses' => Http::withHeaders([
                'Authorization' => Session::get('tokenType') .' '. Session::get('accessToken'),
            ])->get($app_url . 'dashboard/courses')->json(),
            'divisions' => Http::withHeaders([
                'Authorization' => Session::get('tokenType') .' '. Session::get('accessToken'),
            ])->get($app_url . 'divisions')->json(),
            'districts' => Http::withHeaders([
                'Authorization' => Session::get('tokenType') .' '. Session::get('accessToken'),
            ])->get($app_url . 'districts')->json(),

            'batches' => Http::withHeaders([
                'Authorization' => Session::get('tokenType') .' '. Session::get('accessToken'),
            ])->get($app_url . 'dashboard/batches', [
                'course_id' => $course_id,
                'batch' => $batch,
                'district_id' => $district_id,
                'division_id' => $division_id,
            ])->json(),

        ]);
    }
}
