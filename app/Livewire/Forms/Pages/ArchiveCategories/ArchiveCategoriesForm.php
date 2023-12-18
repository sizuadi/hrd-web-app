<?php

namespace App\Livewire\Forms\Pages\ArchiveCategories;

use Livewire\Attributes\Rule;
use Livewire\Form;

class ArchiveCategoriesForm extends Form
{
    #[Rule('nullable')]
    public $id = '';

    #[Rule('required')]
    public $name = '';
}
