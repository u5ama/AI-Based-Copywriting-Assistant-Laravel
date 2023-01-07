<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class userheader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $isLoggedIn;
    public $user;
    public function __construct($isLoggedIn,$user)
    {
        $this->isLoggedIn = $isLoggedIn;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.userheader');
    }
}
