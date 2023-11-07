<?php

namespace App\Livewire\Pages\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('livewire.layouts.app')]
class UsersIndex extends Component
{

    use WithPagination;

    public $query = "";
    public $currentPage = 1;
    public $paginate = 5;

    public function render()
    {
        $datas =  User::where('full_name', 'LIKE', '%' . $this->query . '%')
            ->orWhere('email', 'LIKE', '%' . $this->query . '%')
            ->orWhere('username', 'LIKE', '%' . $this->query . '%')
            ->paginate($this->paginate);

        return view('livewire.pages.users.users-index', [
            'datas' => $datas
        ]);
    }
}
