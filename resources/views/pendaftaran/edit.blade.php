<x-app-layout title="Edit Data Pasien">
    <div class="card">
        <div class="card-header">
            edit pasien
        </div>
        <div class="card-body">
            <form action="{{ route('pendaftaran.update', $pasien->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <x-input field="no_rm" label="No RM" value="{{ $pasien->no_rm }}" />
                        <x-input field="nama" label="Nama Pasien" value="{{ $pasien->nama }}" />
                        <x-input field="nama_kk" label="Nama KK" value="{{ $pasien->nama_kk }}" />
                        <x-select field="jenis_kelamin" label="Jenis Kelamin">
                            @if ($pasien->jenis_kelamin == 'laki-laki')
                                <option value="laki-laki" selected>Laki laki</option>
                                <option value="perempuan">Perempuan</option>
                            @elseif($pasien->jenis_kelamin == 'perempuan')
                                <option value="perempuan" selected>Perempuan</option>
                                <option value="laki-laki">Laki laki</option>
                            @else
                                <option value="laki-laki">Laki laki</option>
                                <option value="laki-laki">Perempuan</option>
                            @endif
                        </x-select>

                        <x-select field="hubungan" label="hubungan">
                            @foreach ($hubungan as $key => $value)
                                @if ($key == $pasien->hubungan)
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </x-select>
                        <x-input field="tgl_lahir" label="Tanggal Lahir" type="text"
                            value="{{ $pasien->tgl_lahir }}" />

                    </div>
                    <div class="col-md-6">
                        <x-select field="status" label="Status">
                            @if ($pasien->status === 'umum')
                                <option value="umum" selected>Umum</option>
                                <option value="bpjs">Bpjs</option>
                            @elseif($pasien->status === 'bpjs')
                                <option value="bpjs" selected>Bpjs</option>
                                <option value="umum">Umum</option>
                            @else
                                <option value="umum">Umum</option>
                                <option value="bpjs">Bpjs</option>
                            @endif
                        </x-select>
                        <x-input field="no_bpjs" label="No Bpjs" type="text" value="{{ $pasien->no_bpjs }}" />


                        <div class="form-floating">
                            <textarea class="form-control  @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                                style="height: 100px">{{ $pasien->alamat }}</textarea>
                            <label for="alamat">Alamat</label>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="riwayat_alergi" class="form-label mb-2">Riwayat alergi</label>
                        <input id="riwayat_alergi" type="hidden" name="riwayat_alergi">
                        <trix-editor input="riwayat_alergi">{!! $pasien->riwayat_alergi !!}</trix-editor>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                <a href="{{ route('pendaftaran.index') }}" class="btn btn-danger btn-sm">Kembali</a>
            </form>
        </div>
    </div>
</x-app-layout>
