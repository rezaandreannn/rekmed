<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

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
            ->whereMonth('tgl_kunjungan', date('m'))
            ->whereYear('tgl_kunjungan', date('Y'))
            ->orderBy('jumlah', 'desc')
            ->where('status_kunjungan', '=', 'sukses')
            ->limit(10)
            ->get();

        $pendaftaranHariIni = Pasien::whereDate('created_at', '=', today())->get();
        $pendaftaran = Pasien::all();

        $bpjsHariIni = Pasien::whereDate('created_at', today())
            ->where('status', 'bpjs')
            ->get();

        $bpjs = Pasien::where('status', 'bpjs')
            ->get();

        $umumHariIni = Pasien::whereDate('created_at', today())
            ->where('status', 'umum')
            ->get();

        $umum = Pasien::where('status', 'umum')
            ->get();

        $antrians = Kunjungan::with('pasien')
            ->where('status_kunjungan', 'antri')
            ->whereDate('created_at', today())
            ->get();

        $kunjungans = Kunjungan::with('pasien')
            ->where('status_kunjungan', 'sukses')
            ->whereDate('created_at', today())
            ->get();

        $registrasis = Kunjungan::with('pasien')
            ->where('status_kunjungan', '=', 'sukses')
            ->where('rujukan_ke', '=', null)
            ->get();

        $registrasisHariIni = Kunjungan::with('pasien')
            ->where('status_kunjungan', '=', 'sukses')
            ->where('rujukan_ke', '=', null)
            ->whereDate('created_at', today())
            ->get();


        return view('home', compact('diagnosa', 'pendaftaranHariIni', 'pendaftaran', 'registrasis', 'registrasisHariIni', 'bpjsHariIni', 'bpjs', 'umum', 'umumHariIni', 'antrians', 'kunjungans'));
    }
}
