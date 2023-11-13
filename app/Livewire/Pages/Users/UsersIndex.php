<?php

namespace App\Livewire\Pages\Users;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\Users\UsersStoreForm;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('livewire.layouts.app')]
class UsersIndex extends Component
{

    use WithPagination;

    // init variable
    protected $paginationTheme = 'bootstrap';
    public $search = "";
    public $status = "";
    public $currentPage = 1;
    public $paginate = 5;
    public $orderColumn = "id";
    public $sortOrder = "asc";
    public $sortIcon = "arrow-up";
    public $mode = "";

    // for create
    public UsersStoreForm $form;

    public $status_id, $status_name, $user;

    public function sorting($columnName = "")
    {
        if ($this->sortOrder == "asc") {
            $this->sortOrder = "desc";
            $this->sortIcon = "arrow-down";
        } else {
            $this->sortOrder = "asc";
            $this->sortIcon = "arrow-up";
        }

        $this->orderColumn = $columnName;
    }

    public function changeModalMode($mode = "", $id = 0)
    {
        $this->mode = $mode;
        if ($id != 0 && $mode == "update") {
            $user = User::find($id);
            $this->form->id = $user->id;
            $this->form->full_name = $user->full_name;
            $this->form->username = $user->username;
            $this->form->email = $user->email;
            $this->form->rate_per_hour = $user->rate_per_hour;
        }
        $this->dispatch("choices");
    }

    public function resetForm()
    {
        $this->form->full_name = "";
        $this->form->username = "";
        $this->form->password = "";
        $this->form->password_confirmation = "";
        $this->form->email = "";
        $this->form->rate_per_hour = "";
    }

    public function store()
    {
        $this->validate();

        $this->form->password = Hash::make($this->form->password);;
        $user = User::create((array)$this->form);
        $user->assignRole($this->form->role);

        $toastify = GlobalHelpers::toastifySuccess("User Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->form->id);
        $user->password = Hash::make($this->form->password);
        $user->update((array)$this->form);
        $user->assignRole($this->form->role);

        $toastify = GlobalHelpers::toastifySuccess("User Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->user = User::find($id);
        $this->status_id = $status_id;
        $this->status_name = $status_name;
    }

    public function render()
    {
        $datas = User::query();

        if ($this->search) {
            $datas = $datas->where('full_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->orWhere('username', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $roles = Role::orderBy("id", "desc")->get();
        $statuses = UserStatus::orderBy("id", "desc")->get();

        return view('livewire.pages.users.users-index', [
            'datas' => $datas,
            'roles' => $roles,
            'statuses' => $statuses,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
