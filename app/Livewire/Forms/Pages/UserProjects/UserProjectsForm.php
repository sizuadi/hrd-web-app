<?php

namespace App\Livewire\Forms\Pages\UserProjects;

use Livewire\Attributes\Rule;
use Livewire\Form;

class UserProjectsForm extends Form
{
    #[Rule('nullable')]
    public $id = '';

    #[Rule('required|exists:App\Models\Company,id')]
    public int $company_id;

    #[Rule('required')]
    public $company_name = "";

    #[Rule('required|exists:App\Models\Project,id')]
    public int $project_id;

    #[Rule('required|exists:App\Models\User,id')]
    public int $user_id;

    #[Rule('required|date')]
    public $start_date = '';

    #[Rule('required|date|after:start_date')]
    public $end_date = '';
}
