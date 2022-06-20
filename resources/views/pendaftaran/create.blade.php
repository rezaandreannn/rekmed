<x-app-layout>
    <div class="card">
        <div class="card-header">
            Daftar pasien
        </div>
        <div class="card-body">
            <form action="{{ route('pendaftaran.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <x-input field="no_rm" label="No RM" value="{{ old('no_rm') }}"
                            placeholder="input no rekam medis" required='*' />
                        <x-input field="nama" label="Nama Pasien" value="{{ old('nama') }}"
                            placeholder="input nama pasien" required='*' />
                        <x-input field="nama_kk" label="Nama KK" value="{{ old('nama_kk') }}"
                            placeholder="input nama kk" required='*' />
                        <x-select field="jenis_kelamin" label="Jenis Kelamin" required='*'>
                            <option value="" selected>Pilih jenis kelamin</option>
                            <option value="laki-laki">Laki laki</option>
                            <option value="perempuan">Perempuan</option>
                        </x-select>
                        <x-select field="hubungan" label="hubungan" required='*'>
                            <option value="" selected>Pilih Hubungan</option>
                            @foreach ($hubungan as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </x-select>
                        <x-input field="tgl_lahir" label="Tanggal Lahir" type="date" required='*' />

                    </div>
                    <div class="col-md-6">
                        <x-select field="status" label="status" required='*'>
                            <option value="" selected>Pilih status pasien</option>
                            <option value="umum">Umum </option>
                            <option value="bpjs">Bpjs</option>
                        </x-select>
                        <x-input field="no_bpjs" type="text" value="{{ old('no_bpjs') }}" label="No Bpjs/"
                            required='Kosongkan jika pasien umum' />


                        <div class="form-floating">
                            <textarea class="form-control  @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                                style="height: 100px">{{ old('alamat') }}</textarea>
                            <label for="alamat">Alamat<span class="text-danger">*</span></label>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="riwayat_alergi" class="form-label mb-2">Riwayat alergi</label>
                        <input id="riwayat_alergi" type="hidden" name="riwayat_alergi">
                        <trix-editor input="riwayat_alergi">{!! old('riwayat_alergi') !!}</trix-editor>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
