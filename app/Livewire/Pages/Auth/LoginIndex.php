<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\Auth\LoginForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('livewire.layouts.app-auth')]
class LoginIndex extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['username' => $this->form->username, 'password' => $this->form->password])) {
            Toaster::success('Login berhasil');
            return redirect()->route('dashboard');
        } else {
            Toaster::warning('Username atau Password Anda salah');
        }
    }

    public function render(): View
    {
        return view('livewire.pages.auth.login-index');
    }
}
