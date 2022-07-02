<x-app-layout title="Periksa">
    <div class="row d-flex justify-content-end">
        <div class="col-md-2">
            <div class="card">
                <span class="text-center">
                    Tgl. {{ date('d M, Y') }}

                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Antrian Pasien({{ $antrians->total() }})
                </div>
                <div class="card-body">
                    <ul class="list-group ">
                        @forelse ($antrians as $index => $antri)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $antrians->firstItem() + $index }}.
                                {{ $antri->pasien->nama }}/{{ $antri->pasien->no_rm }}
                                <div class="d-flex">
                                    <a href="{{ route('kunjungan.edit', $antri->id) }}"
                                        class="badge bg-primary me-1 text-decoration-none">Cek
                                        Pasien</a>
                                    <a href="#" class="badge bg-danger text-white text-decoration-none"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteAntri{{ $antri->id }}">Hapus</a>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item d-flex justify-content-center">
                                <span>Tidak ada pasien hari ini.</span>
                            </li>
                        @endforelse
                        <div class="mt-2 d-flex justify-content-end">
                            {{ $antrians->links() }}
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Pasien Sudah berobat({{ $kunjungans->total() }})
                </div>
                <div class="card-body">
                    <ul class="list-group ">
                        @forelse ($kunjungans as $index => $kunjungan)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $kunjungans->firstItem() + $index }}.
                                {{ $kunjungan->pasien->nama }}/{{ $kunjungan->pasien->no_rm }}
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target="#kunjunganDetail{{ $kunjungan->id }}">Detail</a>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item d-flex justify-content-center">
                                <span>daftar pasien masih kosong.</span>
                            </li>
                        @endforelse
                        <div class="mt-2 d-flex justify-content-end">
                            {{ $kunjungans->links() }}
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- modal hapus antrian --}}
    @foreach ($antrians as $index => $antri)
        <div class="modal fade" id="deleteAntri{{ $antri->id }}" tabindex="-1" aria-labelledby="deleteAntriLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAntriLabel">Hapus antrian pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Yakin menghapus Pasien "{{ $antri->pasien->nama }}" ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('kunjungan.destroy', $antri->id) }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- detail pasien sudah berobat today() --}}
    @foreach ($kunjungans as $index => $kunjungan)
        <div class="modal fade" id="kunjunganDetail{{ $kunjungan->id }}" tabindex="-1"
            aria-labelledby="kunjunganDetailLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kunjunganDetailLabel">Detail pasien sudah berobat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                Nama
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-8">
                                {{ $kunjungan->pasien->nama }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                No RM
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-8">
                                {{ $kunjungan->pasien->no_rm }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                Keluhan
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-8">
                                {!! $kunjungan->keluhan !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                Diagnosa
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-8">
                                {!! $kunjungan->diagnosa !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                Terapi & KIE
                            </div>
                            <div class="col-md-1">
                                :
                            </div>
                            <div class="col-md-8">
                                {!! $kunjungan->terapi_kie !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @push('scripts')

        {{-- sukses --}}
        @if (session('message'))
            <script>
                toastr.success("{{ session('message') }}");
            </script>
        @endif

    @endpush

</x-app-layout>
