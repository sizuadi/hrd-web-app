<?php

namespace App\Livewire\Pages\Roles;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\Roles\RolesStoreForm;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('livewire.layouts.app')]
class RolesIndex extends Component
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
    public RolesStoreForm $form;

    public $status_id, $status_name, $role;

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
        if ($id != 0 && ($mode == "update" || $mode == "show")) {
            $role = Role::find($id);
            $this->form->id = $role->id;
            $this->form->full_name = $role->full_name;
            $this->form->rolename = $role->rolename;
            $this->form->email = $role->email;
            $this->form->rate_per_hour = $role->rate_per_hour;
            $this->form->role = $role->roles()->first()->name;
        }
        if ($mode != "show") {
            $this->dispatch("choices");
        }
    }

    public function resetForm()
    {
        $this->form->full_name = "";
        $this->form->rolename = "";
        $this->form->password = "";
        $this->form->password_confirmation = "";
        $this->form->email = "";
        $this->form->rate_per_hour = "";
    }

    public function store()
    {
        $this->validate();

        $this->form->password = Hash::make($this->form->password);;
        $role = Role::create((array)$this->form);
        $role->assignRole($this->form->role);

        $toastify = GlobalHelpers::toastifySuccess("Role Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {
        $this->validate([
            'form.password' => "nullable|confirmed",
            'form.password_confirmation' => "nullable",
        ]);

        $role = Role::find($this->form->id);
        if ($this->form->password != "") {
            $role->password = Hash::make($this->form->password);
        }
        $role->update((array)$this->form);
        $role->assignRole($this->form->role);

        $toastify = GlobalHelpers::toastifySuccess("Role Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function updateStatus()
    {
        $role = Role::find($this->role->id);
        $role->update([
            'status_id' => $this->status_id
        ]);
        $toastify = GlobalHelpers::toastifySuccess("Status Role Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->role = Role::find($id);
        $this->status_id = $status_id;
        $this->status_name = $status_name;
    }

    public function render()
    {
        $datas = Role::query();

        if ($this->search) {
            $datas = $datas->where('full_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->orWhere('rolename', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $roles = Role::orderBy("id", "desc")->get();
        $statuses = RoleStatus::orderBy("id", "desc")->get();

        return view('livewire.pages.roles.roles-index', [
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
