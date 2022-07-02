<?php

namespace App\Exports;

use App\Models\Kunjungan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenyakitExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($diagnosa)
    {
        $this->data = $diagnosa;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return $this->data;
    }
    public function headings(): array
    {
        return ["diagnosa", "L", "P", "Jumlah"];
    }
}
