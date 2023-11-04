<?php

namespace App\Livewire\Pages\Auth;

use App\Helpers\Toastify;
use App\Livewire\Forms\Auth\LoginForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.layouts.app-auth')]
class LoginIndex extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['username' => $this->form->username, 'password' => $this->form->password])) {
            $this->dispatch('toastify', $this->options("Login Berhasil"));
            $this->redirect("/");
        } else {
            $this->dispatch('toastify', $this->options("Login Gagal"));
        }
    }

    public function render(): View
    {
        return view('livewire.pages.auth.login-index');
    }
}
