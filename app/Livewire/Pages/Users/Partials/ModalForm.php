<?php

namespace App\Livewire\Pages\Users\Partials;

use App\Models\User;
use Livewire\Component;

class ModalForm extends Component
{
    public $mode = "create";

    public function mount($mode)
    {
        $this->mode = $mode;
    }

    public function render()
    {
        return view('livewire.pages.users.partials.modal-form');
    }
}
