<?php

namespace App\Livewire\Forms\Auth;

use Livewire\Attributes\Rule;
use Livewire\Form;

class LoginForm extends Form
{
    #[Rule('required')]
    public $username = '';

    #[Rule('required')]
    public $password = '';
}
