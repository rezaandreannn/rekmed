<x-app-layout>
    <div class="card">
        <div class="card-body">
            <div class="text-uppercase text-center">
                <h4>Rekam medis</h4>
                <h5>puskesmas bumi emas </h5>
                <p>kecamatan batanghari kab. lampung timur</p>
            </div>
            <div class="row d-flex justify-content-end me-5">
                <span class="border text-center fw-bold" style="max-width: 80px">{{ $pasien->status }}</span>
                @if ($pasien->no_bpjs)
                    <span class="border text-center fw-bold"
                        style="max-width: min-content">{{ $pasien->no_bpjs }}</span>
                @endif

            </div>
            <div class="row mt-4">
                <div class="col-md-6 ">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">No RM</div>
                        <div class="col-md-8">: {{ $pasien->no_rm }}</div>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">Nama Pasien</div>
                        <div class="col-md-8">: {{ $pasien->nama }}</div>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">Nama KK</div>
                        <div class="col-md-8">: {{ $pasien->nama_kk }}</div>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">Hubungan</div>
                        <div class="col-md-8">: {{ $pasien->hubungan }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">Alamat</div>
                        <div class="col-md-8">: {{ $pasien->alamat }}</div>
                    </div>
                </div>
            </div>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Keluhan</th>
                        <th scope="col">Diagnosa</th>
                        <th scope="col">Terapi & KIE</th>
                        <th scope="col">paraf</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key)
                        <tr>
                            <th>
                                @if ($key->tgl_kunjungan)
                                    {{ date('d-M-y', strtotime($key->tgl_kunjungan)) }}
                                @endif
                            </th>
                            <td>{{ $key->keluhan }}</td>
                            <td>{{ $key->diagnosa }}</td>
                            <td>{!! $key->terapi_kie !!}</td>
                            <td>{{ $key->paraf }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="mt-2 d-flex justify-content-end">
                {{ $datas->links() }}
            </div>
        </div>
    </div>
    <a href="{{ route('rekammedis.index') }}" class="btn btn-danger mt-2" style="float: right">Kembali</a>
</x-app-layout>
