<?php

namespace App\Livewire\Pages\WorkReports;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\WorkReports\WorkReportsForm;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;
use App\Models\WorkReport;
use App\Models\WorkReportstatus;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('livewire.layouts.app')]
#[Title('Work Report')]
class WorkReportsIndex extends Component
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
    public WorkReportsForm $form;

    public $status_id, $status_name, $work_report;

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
        $user = User::find(auth()->user()->id);
        $this->form->user_id = $user->id;
        $this->form->user_name = $user->full_name;
        if ($id != 0 && ($mode == "update" || $mode == "show")) {
            $work_report = WorkReport::find($id);
            $this->form->id = $work_report->id;
            $this->form->company_id = $work_report->company_id;
            $this->form->company_name = $work_report->company->name;
            $this->form->project_id = $work_report->project_id;
            $this->form->start_date = $work_report->start_date;
            $this->form->end_date = $work_report->end_date;
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
        $this->form->user_id = 0;
        $this->form->user_name = "";
        $this->form->project_id = 0;
        $this->form->user_id = 0;
        $this->form->start_date = "";
        $this->form->end_date = "";
    }

    public function store()
    {
        $this->validate();
        WorkReport::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Data Berhasil Dibuat");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();
        $work_report = WorkReport::find($this->form->id);
        $work_report->update((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Data Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
        $this->resetForm();
    }

    public function updateStatus()
    {
        $work_report = WorkReport::find($this->work_report->id);
        $work_report->update([
            'status_id' => $this->status_id
        ]);
        $toastify = GlobalHelpers::toastifySuccess("Status Berhasil Diupdate");
        $this->dispatch(...$toastify);
        $this->dispatch("closeModal");
    }

    public function modalStatus(int $id, int $status_id, string $status_name)
    {
        $this->work_report = WorkReport::find($id);
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
        $datas = DB::table("work_reports")->selectRaw("work_reports.*,
        projects.name as project_name, companies.name as company_name, users.full_name as user_name, work_report_statuses.name as status_name")
            ->join("projects", "work_reports.project_id", "projects.id")
            ->join("companies", "work_reports.company_id", "companies.id")
            ->join("users", "work_reports.user_id", "users.id")
            ->join("work_report_statuses", "work_reports.status_id", "work_report_statuses.id");

        if ($this->search) {
            $datas = $datas->where('project_name', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->status != "") {
            $datas = $datas->where('status_id', $this->status);
        }

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->paginate($this->paginate);
        $statuses = WorkReportstatus::orderBy("id", "desc")->get();
        $projects = DB::table("user_projects")->selectRaw(
            "user_projects.*, projects.name as project_name"
        )
            ->join("projects", "user_projects.project_id", "projects.id")
            ->where("user_id", auth()->user()->id)
            ->get();
        return view('livewire.pages.work-reports.work-reports-index', [
            'datas' => $datas,
            'statuses' => $statuses,
            'projects' => $projects,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
