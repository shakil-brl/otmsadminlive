<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InspectionResult extends Component
{

    public $value;
    public $design;
    public $lang;
    public function __construct($value, $design, $lang)
    {
        $this->value = $value;
        $this->design = $design;
        $this->lang = $lang;

    }
    public function render()
    {
        $value = $this->value;
        $design = $this->design;
        $lang = $this->lang;
        return view('components.inspection-result', compact('value', 'design', 'lang'));
    }
}
