<?php

namespace App\Exports\WorkReports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WorkReportHeaderExport implements WithMultipleSheets
{

    private $datas;

    public function __construct($data)
    {
        $this->datas = $data;
    }

    public function sheets(): array
    {
        $sheet[] = new WorkReportExport($this->datas);
        $sheet[] = new WorkReportDetailExport($this->datas);

        return $sheet;
    }
}
