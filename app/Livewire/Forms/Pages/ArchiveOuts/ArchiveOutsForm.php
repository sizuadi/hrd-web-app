<?php

namespace App\Livewire\Forms\Pages\ArchiveOuts;

use Livewire\Attributes\Rule;
use Livewire\Form;

class ArchiveOutsForm extends Form
{
    #[Rule('nullable')]
    public $id = '';

    #[Rule('required|exists:App\Models\ArchiveCategory,id')]
    public int $archive_category_id;

    #[Rule('required|date')]
    public $date = '';

    #[Rule('required')]
    public $archive_number = "";

    #[Rule('required')]
    public $addressed_to = "";

    #[Rule('required')]
    public $subject = "";

    #[Rule('file')]
    public $archive_file;

    #[Rule('required')]
    public $description = "";
}
