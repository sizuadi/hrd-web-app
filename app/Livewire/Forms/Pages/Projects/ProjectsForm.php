<?php

namespace App\Livewire\Forms\Pages\Projects;

use Livewire\Attributes\Rule;
use Livewire\Form;

class ProjectsForm extends Form
{
    #[Rule('nullable')]
    public $id = '';

    #[Rule('required|exists:App\Models\Company,id')]
    public int $company_id;

    #[Rule('required')]
    public $name = '';

    #[Rule('nullable')]
    public $description = '';

    #[Rule('required|date')]
    public $start_date = '';

    #[Rule('required|date|after:start_date')]
    public $end_date = '';
}
