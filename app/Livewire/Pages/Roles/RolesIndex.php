<?php

namespace App\Livewire\Pages\Roles;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\Roles\RolesForm;
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
    public RolesForm $form;

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
            $this->form->name = $role->name;
        }
        if ($mode != "show") {
            $this->dispatch("choices");
        }
    }

    public function resetForm()
    {
        $this->form->name = "";
    }

    public function store()
    {
        $this->validate();
        Role::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Role Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();

        $role = Role::find($this->form->id);
        $role->update((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Role Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
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

        return view('livewire.pages.roles.roles-index', [
            'datas' => $datas,
            'roles' => $roles,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
