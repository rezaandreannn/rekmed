<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pasien;
use App\Exports\LbExport;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Exports\LbExportTest;
use App\Exports\PenyakitExport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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

        // dd($diagnosa);

        return view('rekammedis.penyakit-terbesar', compact('diagnosa'));
    }

    public function export_excel(Request $request)
    {

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // dd($bulan);

        $diagnosa = DB::table('kunjungans')
            ->leftJoin('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
            ->select([
                DB::raw('diagnosa as nama_diagnosa'),
                // DB::raw('GROUP_CONCAT(pasiens.nama) as nama'),
                DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                DB::raw('count(diagnosa) as jumlah')
            ])
            ->groupBy('nama_diagnosa')
            ->whereMonth('tgl_kunjungan', $bulan)
            ->whereYear('tgl_kunjungan', $tahun)
            ->orderBy('jumlah', 'desc')
            ->where('status_kunjungan', '=', 'sukses')
            ->limit(10)
            ->get();

        return Excel::download(new PenyakitExport($diagnosa), '10_penyakit_terbesar.xlsx');
        // return (new PenyakitExport($diagnosa))->download('penyakit.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }



    public function lb_1(Request $request)
    {

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // cek $request
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
            //     CASE
            //     WHEN umur < 20 THEN '... - 20'
            //     WHEN umur BETWEEN 20 and 24 THEN '20 - 24'
            //     WHEN umur BETWEEN 25 and 29 THEN '25 - 29'
            //     WHEN umur >= 30 THEN '30 - ...'
            //     WHEN umur IS NULL THEN '(NULL)'
            // END as range_umur,
            ->join('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
            ->select([
                'diagnosa', 'umur',
                // DB::raw('GROUP_CONCAT(pasiens.umur) as umur'),
                DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                DB::raw('count(diagnosa) as jumlah'),
                // DB::raw('sum(jumlah) as total'),

            ])
            ->groupBy(['diagnosa', 'umur'])
            ->whereMonth('tgl_kunjungan', $month)
            ->whereYear('tgl_kunjungan', $year)
            ->orderBy('umur', 'asc')
            ->where('status_kunjungan', '=', 'sukses')
            ->get();

        // dd($diagnosa);
        $reports = [];

        $diagnosa->each(function ($item) use (&$reports) {
            $reports[$item->diagnosa][$item->umur] = [
                'l' => $item->l_count,
                'p' => $item->p_count,
                'jumlah' => $item->jumlah
            ];
        });
        // dd($reports);

        $diagnosas = $diagnosa->pluck('umur')->sortBy('umur')->unique();
        // $test = $diagnosa->groupBy('diagnosa');

        // dd($test);
        // dd($diagnosa);

        return view('rekammedis.lb-1', compact('reports', 'diagnosas'));
    }

    public function lb_export(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $diagnosa = DB::table('kunjungans')
            ->join('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
            ->select([
                'diagnosa', 'umur',
                DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                DB::raw('count(diagnosa) as jumlah')
            ])
            ->groupBy(['diagnosa', 'umur'])
            ->whereMonth('tgl_kunjungan', $bulan)
            ->whereYear('tgl_kunjungan', $tahun)
            ->orderBy('umur', 'asc')
            ->where('status_kunjungan', '=', 'sukses')
            ->get();

        $reports = [];
        $diagnosa->each(function ($item) use (&$reports) {
            $reports[$item->diagnosa][$item->umur] = [
                'l' => $item->l_count,
                'p' => $item->p_count,
                'jumlah' => $item->jumlah
            ];
        });

        $diagnosas = $diagnosa->pluck('umur')->sortBy('umur')->unique();

        return Excel::download(new LbExport($diagnosas, $reports), 'lb_1.xlsx');
    }


    public function test_lb_1(Request $request)
    {

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $diagnosa = $request->input('diagnosa');

        // cek $request
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

        // cek diagnosa
        if ($diagnosa) {
            $diagnosa = DB::table('kunjungans')
                ->join('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
                ->select([
                    'diagnosa', 'umur',
                    DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                    DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                    DB::raw('count(diagnosa) as jumlah'),
                    DB::raw('count(umur) as jumlah_umur'),
                ])
                ->groupBy('diagnosa', 'umur')
                ->where('diagnosa', $diagnosa)
                ->whereMonth('tgl_kunjungan', $month)
                ->whereYear('tgl_kunjungan', $year)
                ->orderBy('diagnosa', 'asc')
                ->orderBy('umur', 'asc')
                ->where('status_kunjungan', '=', 'sukses')
                ->paginate(10);
        } else {
            $diagnosa = DB::table('kunjungans')
                ->join('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
                ->select([
                    'diagnosa', 'umur',
                    DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                    DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                    DB::raw('count(diagnosa) as jumlah'),
                    DB::raw('count(umur) as jumlah_umur'),
                ])
                ->groupBy('diagnosa', 'umur')
                ->whereMonth('tgl_kunjungan', $month)
                ->whereYear('tgl_kunjungan', $year)
                ->orderBy('diagnosa', 'asc')
                ->orderBy('umur', 'asc')
                ->where('status_kunjungan', '=', 'sukses')
                ->paginate(10);
        }

        return view('rekammedis.test_lb', compact('diagnosa'));
    }

    public function report_lb_test(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $diagnosa = $request->input('diagnosa');

        // cek $request
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

        // cek diagnosa
        if ($diagnosa != null) {
            $diagnosa = DB::table('kunjungans')
                ->join('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
                ->select([
                    'diagnosa', 'umur',
                    DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                    DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                    DB::raw('count(diagnosa) as jumlah'),
                    DB::raw('count(umur) as jumlah_umur'),
                ])
                ->groupBy('diagnosa', 'umur')
                ->where('diagnosa', $diagnosa)
                ->whereMonth('tgl_kunjungan', $month)
                ->whereYear('tgl_kunjungan', $year)
                ->orderBy('diagnosa', 'asc')
                ->orderBy('umur', 'asc')
                ->where('status_kunjungan', '=', 'sukses')
                ->get();
        } else {
            $diagnosa = DB::table('kunjungans')
                ->join('pasiens', 'pasiens.id', '=', 'kunjungans.pasien_id')
                ->select([
                    'diagnosa', 'umur',
                    DB::raw('sum(jenis_kelamin = "laki-laki") l_count'),
                    DB::raw('sum(jenis_kelamin = "perempuan") p_count'),
                    DB::raw('count(diagnosa) as jumlah'),
                    DB::raw('count(umur) as jumlah_umur'),
                ])
                ->groupBy('diagnosa', 'umur')
                ->whereMonth('tgl_kunjungan', $month)
                ->whereYear('tgl_kunjungan', $year)
                ->orderBy('diagnosa', 'asc')
                ->orderBy('umur', 'asc')
                ->where('status_kunjungan', '=', 'sukses')
                ->get();
        }
        return Excel::download(new LbExportTest($diagnosa), 'lb_1.xlsx');
    }
}
