<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DynamicSearchForm extends Component
{
    public $selectForms;

    public function __construct($selectForms)
    {
        $this->selectForms = $selectForms;
    }

    public function render()
    {
        return view('components.dynamic-search-form');
    }
}
