<?php

namespace App\View\Components;

use Illuminate\View\Component;


class Radio extends Component
{

    public $name;
    public $value;
    public $checked;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $value, $checked)
    {
        $this->name = $name;
        $this->value = $value;
        $this->checked = ($checked) ? 'checked' : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.radio');
    }
}
