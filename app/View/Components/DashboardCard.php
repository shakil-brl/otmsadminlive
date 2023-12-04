<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $totalBatch;
    public $icon;
    public $title;
    public $class;
    public $url;

    public function __construct($url, $totalBatch, $icon, $title, $class)
    {
        $this->url = $url;
        $this->totalBatch = $totalBatch;
        $this->icon = $icon;
        $this->title = $title;
        $this->class = $class;
    }
    public function render()
    {
        return view('components.dashboard-card');
    }
}
