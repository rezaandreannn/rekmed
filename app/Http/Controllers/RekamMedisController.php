<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {

        $rekammedis = Kunjungan::with('pasien')
            ->where('status_kunjungan', 'sukses')
            ->get();

        return view('rekammedis.index', compact('rekammedis'));
    }
}
