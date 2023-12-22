<?php

namespace App\Livewire\Pages\UserProjects;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\UserProjects\UserProjectsForm;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use App\Models\UserProjectStatus;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('livewire.layouts.app')]
#[Title('User Project')]
class UserProjectsIndex extends Component
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
    public UserProjectsForm $form;

    public $status_id, $status_name, $user_project;

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
            $user_project = UserProject::find($id);
            $this->form->id = $user_project->id;
            $this->form->company_id = $user_project->company_id;
            $this->form->company_name = $user_project->company->name;
            $this->form->project_id = $user_project->project_id;
            $this->form->user_id = $user_project->user_id;
            $this->form->start_date = $user_project->start_date;
            $this->form->end_date = $user_project->end_date;
        }
        if ($mode != "show") {
            $this->dispatch("choices");
        }
        $this->dispatch("flatpickr");
    }

    public function resetForm()
    {
        $this->form->id = "";
        $this->form->company_id = 0;
        $this->form->company_name = "";
        $this->form->project_id = 0;
        $this->form->user_id = 0;
        $this->form->start_date = "";
        $this->form->end_date = "";
    }

    public function store()
    {
        $this->validate();
        UserProject::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Data Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();
        $user_project = UserProject::find($this->form->id);
        $user_project->update((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Data Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function updateStatus()
    {
        $user_project = UserProject::find($this->user_project->id);
        $user_project->update([
            'status_id' => $this->status_id
        ]);
        $toastify = GlobalHelpers::toastifySuccess("Status Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->user_project = UserProject::find($id);
        $this->status_id = $status_id;
        $this->status_name = $status_name;
    }

    public function updatedFormProjectId($value)
    {
        $company = Company::whereHas('projects', function ($query) use ($value) {
            $query->where('id', $value);
        })->first();
        $this->form->company_id = $company->id;
        $this->form->company_name = $company->name;
    }


    public function updated()
    {
        $this->dispatch("choices");
    }

    public function render()
    {
        $datas = DB::table("user_projects")->selectRaw("user_projects.*,
        projects.name as project_name, companies.name as company_name, users.full_name as user_name, user_project_statuses.name as status_name")
        ->join("projects", "user_projects.project_id", "projects.id")
        ->join("companies", "user_projects.company_id", "companies.id")
        ->join("users", "user_projects.user_id", "users.id")
        ->join("user_project_statuses", "user_projects.status_id", "user_project_statuses.id");

        if ($this->search) {
            $datas = $datas->where('project_name', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $statuses = UserProjectStatus::orderBy("id", "desc")->get();
        $projects = Project::where("status_id", 1)->get();
        $users = User::where("status_id", 1)->get();

        if(count($this->getErrorBag()->all()) > 0){
             $this->dispatch("choices");
        }
        return view('livewire.pages.user-projects.user-projects-index', [
            'datas' => $datas,
            'statuses' => $statuses,
            'projects' => $projects,
            'users' => $users,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
