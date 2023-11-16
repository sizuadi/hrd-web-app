<?php

namespace App\Livewire\Forms\Pages\WorkTypes;

use Livewire\Attributes\Rule;
use Livewire\Form;

class WorkTypesForm extends Form
{
    #[Rule('nullable')]
    public $id = '';

    #[Rule('required')]
    public $name = '';
}
