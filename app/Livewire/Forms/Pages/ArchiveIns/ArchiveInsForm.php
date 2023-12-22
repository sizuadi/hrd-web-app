<?php

namespace App\Livewire\Forms\Pages\ArchiveIns;

use Livewire\Attributes\Rule;
use Livewire\Form;

class ArchiveInsForm extends Form
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
    public $source = "";

    #[Rule('required')]
    public $subject = "";

    #[Rule('file')]
    public $archive_file;

    #[Rule('required')]
    public $description = "";
}
