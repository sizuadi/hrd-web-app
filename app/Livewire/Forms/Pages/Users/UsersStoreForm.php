<?php

namespace App\Livewire\Forms\Pages\Users;

use Livewire\Attributes\Rule;
use Livewire\Form;

class UsersStoreForm extends Form
{
    #[Rule('required')]
    public $full_name = '';

    #[Rule('required')]
    public $username = '';

    #[Rule('required|confirmed')]
    public $password = '';

    #[Rule('required')]
    public $password_confirmation = '';

    #[Rule('required|email')]
    public $email = '';

    #[Rule('required')]
    public $rate_per_hour = '';
}
