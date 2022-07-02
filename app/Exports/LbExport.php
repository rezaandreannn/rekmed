<?php

namespace App\Exports;

use App\Models\Kunjungan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;

class LbExport implements FromView
{

    use Exportable;

    public function __construct($diagnosas, $reports)
    {
        $this->diagnosas = $diagnosas;
        $this->reports = $reports;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('rekammedis.lb-export-excel', [
            'diagnosas' => $this->diagnosas,
            'reports' => $this->reports
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->styleCells(
                    'C2:C1000',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                        ],
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ]
                );
            },
        ];
    }

    // public function collection()
    // {

    //     return $this->diagnosa;
    // }

    // public function headings(): array
    // {
    //     return ["diagnosa", "umur", "L", "P", "Jumlah"];
    // }

}
