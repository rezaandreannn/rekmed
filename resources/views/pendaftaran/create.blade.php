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
                        <x-input field="no_rm" label="No RM" value="{{ old('no_rm') }}" placeholder="001" />
                        <x-input field="nama" label="Nama Pasien" value="{{ old('nama') }}" placeholder="tukiyem" />
                        <x-input field="nama_kk" label="Nama KK" value="{{ old('nama_kk') }}"
                            placeholder="kholes adja" />
                        <x-select field="jenis_kelamin" label="Jenis Kelamin">
                            <option value="" selected>Pilih jenis kelamin</option>
                            <option value="laki-laki">Laki laki</option>
                            <option value="perempuan">Perempuan</option>
                        </x-select>
                        <x-select field="hubungan" label="hubungan">
                            <option value="" selected>Pilih Hubungan</option>
                            @foreach ($hubungan as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </x-select>

                    </div>
                    <div class="col-md-6">
                        <x-select field="status" label="status">
                            <option value="" selected>Pilih status pasien</option>
                            <option value="umum">Umum </option>
                            <option value="bpjs">Bpjs</option>
                        </x-select>
                        <x-input field="no_bpjs" type="text" value="{{ old('no_bpjs') }}"
                            label="No Bpjs /kosongkan jika pasien umum" />
                        <x-input field="tgl_lahir" label="Tanggal Lahir" type="date" />

                        <div class="form-floating">
                            <textarea class="form-control  @error('alamat') is-invalid @enderror" name="alamat" id="alamat" style="height: 100px">{{ old('alamat') }}</textarea>
                            <label for="alamat">Alamat</label>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
