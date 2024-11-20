<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class CookieComponent extends Component
{
    public $ShowBar = True;

    public function render()
    {
        $this->is_acceptCookie();
        return view('livewire.cookie-component');
    }

    public function is_acceptCookie()
    {
        if (Cookie::has('AcceptCookie')) {
            $this->ShowBar = False;
        }
    }

    public function AcceptCookie()
    {
        Cookie::queue('AcceptCookie', 'Aceptada');
        $this->ShowBar = False;
    }
}
