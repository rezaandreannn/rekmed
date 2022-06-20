<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class RekamMedisController extends Controller
{
    public function index()
    {

        $rekammedis = DB::table('pasiens')
            ->join('kunjungans', 'kunjungans.pasien_id', '=', 'pasiens.id')
            ->select('kunjungans.*', 'pasiens.*')
            ->where('status_kunjungan', '=', 'sukses')
            ->get()
            ->groupBy('nama');

        // $rekammedis = Kunjungan::with('pasien')
        //     ->where('status_kunjungan', 'sukses')
        //     ->get()
        //     ->groupBy('diagnosa');

        // dd($kunjungans);
        // $datas = [];
        // foreach ($rekammedis as $rekam) {
        //     $datas = $rekam;
        // }

        // return $datas[0]->diagnosa;
        return view('rekammedis.index', compact('rekammedis'));
    }

    public function rekamMedisDetail($id)
    {

        $rekammedis = DB::table('pasiens')
            ->join('kunjungans', 'kunjungans.pasien_id', '=', 'pasiens.id')
            ->select('kunjungans.*', 'pasiens.*')
            ->where('status_kunjungan', '=', 'sukses')
            ->where('pasiens.id', '=', $id)
            ->orderBy('tgl_kunjungan', 'desc')
            ->get()
            ->groupBy('pasiens.id');

        $datas = [];
        $pasien = [];
        foreach ($rekammedis as $key => $value) {
            $datas = (new Collection($value))->paginate(5);
            $pasien = $value[0];
        }

        // return $datas;

        return view('rekammedis.detail-pasien', compact('pasien', 'datas'));
    }
}
