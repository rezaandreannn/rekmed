<?php

namespace App\Models;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kunjungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function pasien()
    {
        return  $this->belongsTo(Pasien::class);
    }
}
