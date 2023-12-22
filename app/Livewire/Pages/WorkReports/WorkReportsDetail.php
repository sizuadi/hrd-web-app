<?php

namespace App\Livewire\Pages\WorkReports;

use App\Helpers\GlobalHelpers;
use App\Livewire\Forms\Pages\WorkReports\WorkReportsForm;
use App\Models\WorkReport;
use App\Models\WorkReportDetail;
use App\Models\WorkType;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.app')]
#[Title('Work Report')]
class WorkReportsDetail extends Component
{
    // for create
    public $work_report;
    public $work_types;
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

        $this->work_report_details = WorkReportDetail::where("work_report_id", $this->work_report->id)->get()->toArray();
        foreach ($this->work_report_details as $key => $detail) {
            $module = json_decode($detail['module']);
            $this->work_report_details[$key]['module'] = $module->module;
            $this->work_report_details[$key]['link'] = $module->link;
            $this->work_report_details[$key]['description'] = $module->description;
        }

        $this->work_types = WorkType::where("status_id", 1)->get();
    }

    public function addWorkReportDetail()
    {
        $this->work_report_details[] = [];
    }

    public function removeWorkReportDetail($index)
    {
        unset($this->work_report_details[$index]);
        $this->work_report_details = array_values($this->work_report_details);
    }

    public function store()
    {
        WorkReportDetail::create((array)$this->form);

        $toastify = GlobalHelpers::toastifySuccess("Data Berhasil Dibuat");
        $this->dispatch(...$toastify);
    }

    public function update()
    {
        WorkReportDetail::where("work_report_id", $this->work_report->id)->delete();
        foreach ($this->work_report_details as $detail) {
            $module = [
                'module' => isset($detail['module']) ? $detail['module'] : "",
                'link' => isset($detail['link']) ? $detail['link'] : "",
                'description' => isset($detail['description']) ? $detail['description'] : "",
            ];
            $module = json_encode($module);
            $day = isset($detail['day']) && $detail['day'] != "" ? $detail['day'] : 0;
            $hour = isset($detail['hour']) && $detail['hour'] != "" ? $detail['hour'] : 0;
            $total_hour = (24 * $day) + $hour;
            WorkReportDetail::create(
                [
                    'work_report_id' => $this->work_report->id,
                    'work_type_id' => $detail['work_type_id'],
                    'module' => $module,
                    'day' => $day,
                    'hour' => $hour,
                    'total_hour' => $total_hour
                ]
            );
        }

        $toastify = GlobalHelpers::toastifySuccess("Data Berhasil Diupdate");
        $this->dispatch(...$toastify);
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
