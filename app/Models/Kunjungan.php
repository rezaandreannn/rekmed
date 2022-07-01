<?php

namespace App\Models;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kunjungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'tgl_kunjungan' => 'datetime',
    ];

    const BULAN = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'July',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];
    const TAHUN = [
        '2022' => '2022',
        '2023' => '2023',
        '2024' => '2024',
        '2025' => '2025'

    ];

    public function pasien()
    {
        return  $this->belongsTo(Pasien::class);
    }
}
