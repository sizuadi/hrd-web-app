<?php

namespace App\Livewire\Pages\Projects;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\Projects\ProjectsForm;
use App\Models\Company;
use App\Models\Project;
use App\Models\ProjectStatus;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('livewire.layouts.app')]
#[Title('Project')]
class ProjectsIndex extends Component
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
    public ProjectsForm $form;

    public $status_id, $status_name, $project;

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
            $project = Project::find($id);
            $this->form->id = $project->id;
            $this->form->company_id = $project->company_id;
            $this->form->name = $project->name;
            $this->form->description = $project->description;
            $this->form->start_date = $project->start_date;
            $this->form->end_date = $project->end_date;
        }
        $this->dispatch("flatpickr");
    }

    public function resetForm()
    {
        $this->form->id = "";
        $this->form->company_id = 0;
        $this->form->name = "";
        $this->form->description = "";
        $this->form->start_date = "";
        $this->form->end_date = "";
    }

    public function store()
    {
        $this->validate();
        Project::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Proyek Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {

        $project = Project::find($this->form->id);
        $project->update((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Proyek Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function updateStatus()
    {
        $project = Project::find($this->project->id);
        $project->update([
            'status_id' => $this->status_id
        ]);
        $toastify = GlobalHelpers::toastifySuccess("Status Proyek Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->project = Project::find($id);
        $this->status_id = $status_id;
        $this->status_name = $status_name;
    }

    public function render()
    {
        $datas = Project::query();

        if ($this->search) {
            $datas = $datas->where('name', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $statuses = ProjectStatus::orderBy("id", "desc")->get();
        $companies = Company::where("status_id", 1)->get();
        return view('livewire.pages.projects.projects-index', [
            'datas' => $datas,
            'statuses' => $statuses,
            'companies' => $companies,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
