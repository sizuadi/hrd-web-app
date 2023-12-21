<?php

namespace App\Livewire\Pages\WorkReports;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\WorkReports\WorkReportsForm;
use App\Models\Company;
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
class WorkReportsDetail extends Component
{
    // for create
    public WorkReportsForm $form;

    public $work_report;
    public $work_report_details = [];

    public function mount($id)
    {
        $this->work_report = DB::table("work_reports")->selectRaw("work_reports.*,
        projects.name as project_name, companies.name as company_name, users.full_name as user_name, work_report_statuses.name as status_name")
        ->join("projects", "work_reports.project_id", "projects.id")
        ->join("companies", "work_reports.company_id", "companies.id")
        ->join("users", "work_reports.user_id", "users.id")
        ->join("work_report_statuses", "work_reports.status_id", "work_report_statuses.id")
        ->where("work_reports.id", $id)
        ->first();
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

    public function render()
    {

        return view('livewire.pages.work-reports.work-reports-detail');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
