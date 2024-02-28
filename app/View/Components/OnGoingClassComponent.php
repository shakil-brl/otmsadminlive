<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OnGoingClassComponent extends Component
{
    public $classes;
    public $from;
    public function __construct($classes, $from)
    {
        $this->classes = $classes;
        $this->from = $from;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.on-going-class-component', [
            'classes' => $this->classes,
            'from' => $this->from,
        ]);
    }
}
