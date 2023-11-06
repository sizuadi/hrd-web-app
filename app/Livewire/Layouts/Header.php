<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $user = Auth::user();
        return view('livewire.layouts.header')->with([
            'user' => $user
        ]);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        $this->redirect("/login");
    }
}
