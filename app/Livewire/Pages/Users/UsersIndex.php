<?php

namespace App\Livewire\Pages\Users;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.layouts.app')]
class UsersIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.users.users-index');
    }
}
