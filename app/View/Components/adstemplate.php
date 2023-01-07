<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class adstemplate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $adsinfo;
    public $adscounter;
    public $user;
    public function __construct($adsinfo, $adscounter, $user)
    {
       $this->adsinfo = $adsinfo;
       $this->adscounter = $adscounter;
       $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.adstemplate');
    }
}
