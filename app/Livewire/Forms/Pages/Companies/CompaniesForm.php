<?php

namespace App\Livewire\Forms\Pages\Companies;

use Livewire\Attributes\Rule;
use Livewire\Form;

class CompaniesForm extends Form
{
    #[Rule('nullable')]
    public $id = '';

    #[Rule('required')]
    public $name = '';
}
