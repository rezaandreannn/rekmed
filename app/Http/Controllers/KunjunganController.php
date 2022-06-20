<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateKunjunganRequest;
use DateTime;

class KunjunganController extends Controller
{
    public function index()
    {
        $antrians = Kunjungan::with('pasien')
            ->where('status_kunjungan', 'antri')
            ->whereDate('created_at', today())
            ->paginate(6);

        $kunjungans = Kunjungan::with('pasien')
            ->where('status_kunjungan', 'sukses')
            ->whereDate('created_at', today())
            ->paginate(6);

        return view('kunjungan.index', compact('antrians', 'kunjungans'));
    }

    public function edit($id)
    {
        if ($id) {
            $kunjungan = Kunjungan::with('pasien')->find($id);
            // dd($pasien);
            return view('kunjungan.cek_rekam', compact('kunjungan'));
        }
        return view('kunjungan.cek_rekam');
    }

    public function update(UpdateKunjunganRequest $request, $id)
    {
        $kunjungan = Kunjungan::find($id);

        $kunjungan->update($request->validated() + [
            'status_kunjungan' => 'sukses',
            'paraf' => 'dr.test',
            'tgl_kunjungan' => new \DateTime()
        ]);

        return redirect()->route('kunjungan.index')->with('message', 'Pasien telah selesai diperiksa');
    }

    public function destroy($id)
    {

        $kunjungan = Kunjungan::find($id);

        $kunjungan->delete();
        return redirect()->back()->with('message', 'berhasil menghapus antrian pasien');
    }
}
