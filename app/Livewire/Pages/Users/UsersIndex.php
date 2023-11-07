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
    protected $paginationTheme = 'bootstrap';

    public $search = "";
    public $currentPage = 1;
    public $paginate = 5;
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortIcon = "arrow-up";

    public function sorting($columnName = ""){
        if ($this->sortOrder == "asc") {
            $this->sortOrder = "desc";
            $this->sortIcon = "arrow-down";
        }else{
            $this->sortOrder = "asc";
            $this->sortIcon = "arrow-up";
        }

        $this->orderColumn = $columnName;
    }

    public function render()
    {
        $datas =  User::where('full_name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
            ->orWhere('username', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->orderColumn, $this->sortOrder)
            ->paginate($this->paginate);

        return view('livewire.pages.users.users-index', [
            'datas' => $datas
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
