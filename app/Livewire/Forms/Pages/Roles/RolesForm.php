<?php

namespace App\Livewire\Forms\Pages\Roles;

use Livewire\Attributes\Rule;
use Livewire\Form;

class RolesForm extends Form
{
    #[Rule('nullable')]
    public $id = '';

    #[Rule('required')]
    public $name = '';
}
