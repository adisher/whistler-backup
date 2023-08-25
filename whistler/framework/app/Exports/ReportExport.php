<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;


use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Illuminate\Support\Facades\Log;


class ReportExport implements FromArray, WithStyles
{
    private $reportData;

    public function __construct($reportData)
    {
        $this->reportData = $reportData;
    }

    public function array(): array
    {
        Log::info('Report Data:', $this->reportData);
        return $this->reportData;
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold styling to the header row (main headers)
        $sheet->getStyle('1:1')->applyFromArray([
            'font' => ['bold' => true],
        ]);

        // Apply bold styling to the subheader row (if exists)
        $sheet->getStyle('2:2')->applyFromArray([
            'font' => ['bold' => true],
        ]);

        // Merge specific cells as required
        $sheet->mergeCells('C1:D1'); // Merge C1 and D1
    }
}

