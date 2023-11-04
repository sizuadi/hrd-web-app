<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        return view('livewire.layouts.header');
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect("/login");
    }
}
