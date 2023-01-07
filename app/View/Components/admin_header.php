<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class admin_header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
      $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.admin_header');
    }
}
