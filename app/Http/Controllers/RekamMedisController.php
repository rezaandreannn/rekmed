<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

        return view('rekammedis.detail-pasien', compact('pasien', 'datas'));
    }

    public function registrasi()
    {
        $registrasis = Kunjungan::with('pasien')
            ->where('status_kunjungan', '=', 'sukses')
            ->where('rujukan_ke', '=', null)
            ->get();

        return view('rekammedis.registrasi', compact('registrasis'));
    }

    public function diagnosa(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        if (!$bulan && !$tahun) {
            $month = date('m');
            $year = date('Y');
        } elseif ($bulan) {
            $month = $bulan;
            $year = date('Y');
        } elseif ($bulan && $tahun) {
            $month = $bulan;
            $year = $tahun;
        } else {
            $this->validate($request, [
                'bulan' => 'required',
            ]);
        }

        $diagnosa = DB::table('kunjungans')
            ->leftJoin('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
            ->select([
                DB::raw('diagnosa as nama_diagnosa'),
                DB::raw('GROUP_CONCAT(pasiens.nama) as nama'),
                DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                DB::raw('count(diagnosa) as jumlah')
            ])
            ->groupBy('nama_diagnosa')
            ->whereMonth('tgl_kunjungan', $month)
            ->whereYear('tgl_kunjungan', $year)
            ->orderBy('jumlah', 'desc')
            ->where('status_kunjungan', '=', 'sukses')
            ->limit(10)
            ->get();

        return view('rekammedis.penyakit-terbesar', compact('diagnosa'));
    }

    public function lb_1(Request $request)
    {

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        if (!$bulan && !$tahun) {
            $month = date('m');
            $year = date('Y');
        } elseif ($bulan) {
            $month = $bulan;
            $year = date('Y');
        } elseif ($bulan && $tahun) {
            $month = $bulan;
            $year = $tahun;
        } else {
            $this->validate($request, [
                'bulan' => 'required',
            ]);
        }

        $diagnosa = DB::table('kunjungans')
            ->join('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
            ->select([
                'diagnosa', 'umur',
                // DB::raw('pasiens.jenis_kelamin as jk'),
                // DB::raw('concat(10*floor(umur/10), \'-\', 10*floor(umur/10) + 9 as `range`)'),
                // DB::raw('GROUP_CONCAT(pasiens.umur) as umur'),
                // DB::raw('pasiens.umur as umur'),
                DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                DB::raw('count(diagnosa) as jumlah')
                // DB::raw('count(jumlah) as total')
            ])

            ->groupBy(['diagnosa', 'umur'])
            ->whereMonth('tgl_kunjungan', $month)
            ->whereYear('tgl_kunjungan', $year)
            // ->orderBy('diagnosa', 'desc')
            ->orderBy('umur', 'asc')
            ->where('status_kunjungan', '=', 'sukses')
            ->get();

        // dd($diagnosa);

        $reports = [];
        $diagnosa->each(function ($item) use (&$reports) {
            $reports[$item->diagnosa][$item->umur] = [
                // 'nama_diagnosa' => $item->nama_diagnosa,
                // 'u' => $item->umur,
                'l' => $item->l_count,
                'p' => $item->p_count,
                'jumlah' => $item->jumlah
            ];
        });

        // dd($reports);

        // dd($diagnosas);
        $diagnosas = $diagnosa->pluck('umur')->sortBy('umur')->unique();
        // $jumlah = $diagnosa->pluck('jumlah')->groupBy('umur');

        // dd($diagnosas);

        return view('rekammedis.lb-1', compact('reports', 'diagnosas'));
    }
}
