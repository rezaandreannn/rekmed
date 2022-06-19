<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const HUBUNGAN = [
        'P' => 'Peserta ',
        'SI' => 'Suami/Istri',
        'A1' => 'Anak pertama',
        'A2' => 'Anak kedua',
        'A3' => 'Anak ketiga'
    ];

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
