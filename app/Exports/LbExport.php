<?php

namespace App\Exports;

use App\Models\Kunjungan;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LbExport implements FromCollection, WithHeadings
{

    use Exportable;

    public function __construct($diagnosa, $reports)
    {
        $this->diagnosa = $diagnosa;
        $this->data = $reports;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return $this->diagnosa;
    }

    public function headings(): array
    {
        return ["diagnosa", "umur", "L", "P", "Jumlah"];
    }
    // public function array(): array
    // {

    //     // dd($this->diagnosa);
    //     return [
    //         $this->diagnosa
    //     ];
    // }
}
