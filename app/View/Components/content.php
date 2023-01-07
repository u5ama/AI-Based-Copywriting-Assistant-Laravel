<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class content extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $contents;

    public function __construct($contents)
    {
       $this->contents = $contents;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.content');
    }
}
