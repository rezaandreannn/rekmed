<x-app-layout>
    <div class="d-flex justify-content-center">
        <h5>Rekam Medis Pasien</h5>
    </div>


    @if ($kunjungan)
        <div class="card">
            <div class="card-header d-flex justify-content-end">
                Jenis Pasien : {{ $kunjungan->pasien->status }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="row">
                            <div class="col-sm-4 col-md-3">No RM</div>
                            <div class="col-sm-8 col-md-7">: {{ $kunjungan->pasien->no_rm }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Nama Pasien</div>
                            <div class="col-md-7">: {{ $kunjungan->pasien->nama }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Nomor Kartu</div>
                            <div class="col-md-7">: {{ $kunjungan->pasien->no_rm }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Hubungan</div>
                            <div class="col-md-7">: {{ $kunjungan->pasien->hubungan }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">Nama KK</div>
                            <div class="col-md-7">: {{ $kunjungan->pasien->nama_kk }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Alamat</div>
                            <div class="col-md-7">: {{ $kunjungan->pasien->alamat }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Riwayat alergi</div>
                            <div class="col-md-7">: </div>
                            <div class="ml-2">
                                {!! $kunjungan->pasien->riwayat_alergi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                Tanggal {{ Date('d M, Y') }}
            </div>
            <div class="card-body">
                <form action="{{ route('kunjungan.update', $kunjungan->id) }}" method="post">
                    @method('PUT')
                    @csrf

                    <label for="keluhan" class="form-label">Keluhan<span class="text-danger">*</span></label>
                    @error('keluhan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input id="keluhan" type="hidden" name="keluhan">
                    <trix-editor input="keluhan"></trix-editor>

                    <x-input field="diagnosa" label="Diagnosa" required="*" />


                    <label for="terapi_kie" class="form-label mb-2">Terapi & KIE<span
                            class="text-danger">*</span></label>
                    @error('terapi_kie')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input id="terapi_kie" type="hidden" name="terapi_kie">
                    <trix-editor input="terapi_kie"></trix-editor>

                    <div class="d-flex justify-content-end mt-2">
                        <a href="{{ route('kunjungan.index') }}" class="btn btn-danger me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-dark" role="alert">
            <a href="{{ route('kunjungan.index') }}">Silahkan pilih pasien Terlebih dahulu</a>
        </div>
    @endif

</x-app-layout>
