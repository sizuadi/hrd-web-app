<?php

namespace App\Livewire\Pages\Report\WorkReports;

use App\Exports\WorkReports\WorkReportHeaderExport;
use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\WorkReports\WorkReportsForm;
use App\Models\Company;
use App\Models\User;
use App\Models\WorkReport;
use App\Models\WorkReportStatus;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

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
        $statuses = WorkReportStatus::orderBy("id", "desc")->get();
        return view('livewire.pages.report.work-reports.work-reports-index', [
            'datas' => $datas,
            'statuses' => $statuses,
        ]);
    }

    public function exportDatas()
    {
        $datas = DB::table("work_reports")->selectRaw("work_reports.*,
        work_report_details.module, work_report_details.day, work_report_details.hour, work_report_details.total_hour,
        projects.name as project_name, companies.name as company_name, users.full_name as user_name, work_report_statuses.name as status_name")
            ->join("work_report_details", "work_reports.id", "work_report_details.work_report_id")
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

        $datas = $datas->orderBy($this->orderColumn, $this->sortOrder)->get();
        return Excel::download(new WorkReportHeaderExport($datas), 'work-report.xlsx');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
