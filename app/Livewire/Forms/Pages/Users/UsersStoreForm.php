<?php

namespace App\Livewire\Forms\Pages\Users;

use Livewire\Attributes\Rule;
use Livewire\Form;

class UsersStoreForm extends Form
{
    #[Rule('nullable')]
    public $id = '';

    #[Rule('required')]
    public $full_name = '';

    #[Rule('required')]
    public $username = '';

    #[Rule('required|confirmed', onUpdate: false)]
    public $password = '';

    #[Rule('required', onUpdate: false)]
    public $password_confirmation = '';

    #[Rule('required|email')]
    public $email = '';

    #[Rule('required')]
    public $rate_per_hour = '';

    #[Rule('required')]
    public $role = '';

}
