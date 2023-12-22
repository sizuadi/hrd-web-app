<?php

namespace App\Exports\WorkReports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class WorkReportDetailExport implements WithTitle, FromView, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    private $datas;

    public function __construct($data)
    {
        $this->datas = $data;
    }

    public function view(): View
    {
        return view(
            'exports.work-reports.work-report-detail',
            [
                'datas' => $this->datas
            ]
        );
    }

    public function styles(Worksheet $sheet)
    {
        $border = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' =>
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        $aligntment = array(
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            )
        );
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:$lastColumn$lastRow")->applyFromArray($border);
        $sheet->getStyle("A1:$lastColumn" . "1")->applyFromArray($aligntment);
        // $sheet->getStyle("C1:C" . $lastRow)->getNumberFormat()->setFormatCode('@');
        return [];
    }

    public function columnFormats(): array
    {
        $array_format = [];
        return $array_format;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Work Report Detail';
    }
}
