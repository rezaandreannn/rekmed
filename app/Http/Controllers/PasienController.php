<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use App\Models\Kunjungan;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $status = $request->input('status');

        if ($status) {
            $pasiens = Pasien::latest()
                ->where('status', $status)
                ->get();
        } else {
            $pasiens = Pasien::latest()->get();
        }
        // dd($status);

        return view('pendaftaran.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hubungan = Pasien::HUBUNGAN;
        return view('pendaftaran.create', compact('hubungan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePasienRequest $request)
    {
        // cek umur
        if ($request->tgl_lahir) {
            $tgl_lahir = Carbon::parse($request->tgl_lahir);
            $age = $tgl_lahir->age;
        }

        // // cek status 
        // if ($request->status == 'umum') {
        //     $pasien = Pasien::create($request->validated() + [
        //         "umur" => $age,  $request->request->set('no_bpjs', null)
        //     ]);
        // } else {
        //     $pasien = Pasien::create($request->validated() + [
        //         "umur" => $age,
        //         $request->request->set('no_bpjs', $request->no_bpjs)
        //     ]);
        // }
        Pasien::create($request->validated() + [
            "umur" => $age,
        ]);

        // dd($pasien);


        return redirect()->route('pendaftaran.index')->with('message', 'Berhasil menambahkan data pasien');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(Pasien $pasien, $id)
    {
        $pasien = Pasien::find($id);
        return view('pendaftaran.cetak', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasien $pasien, $id)
    {
        $pasien = Pasien::find($id);
        $hubungan = Pasien::HUBUNGAN;
        return view('pendaftaran.edit', compact('pasien', 'hubungan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePasienRequest $request, Pasien $pasien, $id)
    {

        if ($request->tgl_lahir) {
            $tgl_lahir = Carbon::parse($request->tgl_lahir);
            $age = $tgl_lahir->age;
        }
        $pasien = Pasien::find($id);
        $pasien->update($request->validated() + ['umur' => $age]);

        return redirect()->route('pendaftaran.index')->with('message', 'data berhasi diganti ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien, $id)
    {
        $pasien = Pasien::find($id);

        $pasien->delete();
        return redirect()->route('pendaftaran.index')->with('message', 'data berhasi dihapus ');
    }

    public function periksa($id)
    {

        // ambil data kunjungan yg id pasien nya sama dengn pasien id
        $kunjungans = Kunjungan::with('pasien')
            ->where('pasien_id', $id)
            // ->where('status_kunjungan', 'antri')
            ->whereDate('created_at', '=', today())
            ->get();

        foreach ($kunjungans as $kunjungan) {
            // cek apakah pasien bpjs dan sudah berobah hari ini
            if ($kunjungan->pasien->status === 'bpjs') {
                return redirect()->route('pendaftaran.index')->with('failed', 'Pasien telah berkunjung hari ini');
            }
        }

        // masukan ke dalam antrian 
        Kunjungan::create([
            'pasien_id' => $id,
            'status_kunjungan' => 'antri',
        ]);

        return redirect()->route('pendaftaran.index')->with('message', 'berhasil menambahkan data ke antrian ');
    }
}
