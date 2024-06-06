<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Error extends Component
{

    public $name;
    public function __construct($name = null)
    {
        $this->name = $name;
    }


    public function render()
    {
        return view('components.error');
    }
}
