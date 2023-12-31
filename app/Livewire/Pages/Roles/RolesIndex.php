<?php

namespace App\Livewire\Pages\Roles;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\Roles\RolesForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Layout('livewire.layouts.app')]
#[Title('Role')]
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

    public $checked_permissions = [], $custom_permissions = [], $checkedAll = false;

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
        \DB::statement("SET SQL_MODE=''");
        $role_permission = Permission::select('name', 'id')->groupBy('name')->get();
        foreach ($role_permission as $per) {
            $key = substr($per->name, 0, strpos($per->name, "."));
            if (str_starts_with($per->name, $key)) {
                $this->custom_permissions[$key][] = $per;
            }
        }
        if ($id != 0 && ($mode == "update" || $mode == "show")) {
            $role = Role::find($id);
            $this->checked_permissions = $role->getPermissionNames()->toArray();
            $this->checkedAll = count($this->checked_permissions) == count($role_permission);
            $this->form->id = $role->id;
            $this->form->name = $role->name;
        }
        if ($mode != "show") {
            $this->dispatch("choices");
        }
    }

    public function resetForm()
    {
        $this->form->id = "";
        $this->form->name = "";
        $this->custom_permissions = [];
        $this->checked_permissions = [];
        $this->checkedAll = false;
    }

    public function store()
    {
        $this->validate();
        $role = Role::create((array)$this->form);
        $role->syncPermissions($this->checked_permissions);
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
        $role->syncPermissions($this->checked_permissions);

        $toastify = GlobalHelpers::toastifySuccess("Role Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function render()
    {
        $datas = Role::query();

        if ($this->search) {
            $datas = $datas->where('name', 'LIKE', '%' . $this->search . '%');
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

    public function updatedCheckedAll($value)
    {
        \DB::statement("SET SQL_MODE=''");
        if ($value) {
            $this->checked_permissions = Permission::pluck("name")->toArray();
        } else {
            $this->checked_permissions = [];
        }
        // dd($this);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
