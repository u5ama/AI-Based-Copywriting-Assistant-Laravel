<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class admin_sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public $adscounter;
    public function __construct($user,$adscounter)
    {
      $this->user = $user;
      $this->adscounter = $adscounter;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return void
     */
    public function render()
    {
        //
    }
}
