<x-app-layout>
    {{-- optional --}}
    {{-- 2. selecteddeleted all --}}
    {{-- 1. status pasien
    {{-- end optional --}}


    <div class="card">
        <div class="card-body bg-white shadow-sm">
            <table id="example" class="table bg-white" style="width:100%">
                <h5>Data pasien</h5>
                <hr>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Nama KK</th>
                        <th>Jumlah Kunjungan</th>
                        <th>Opsi</th>
                        {{-- <th>Nama </th>
                        <th>Nama kk</th>
                       
                        <th>Umur</th>
                        <th>Status</th>
                       
                        <th>opsi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($rekammedis as $key => $value) --}}
                    @foreach ($rekammedis as $key => $value)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $key }}
                            </td>
                            <td>
                                {!! $value[0]->nama_kk !!}
                            </td>
                            <td>
                                {!! $value->count() !!}
                            </td>
                            <td>
                                <a href="{{ route('rekammedis.detail', $value[0]->id) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                            </td>
                    @endforeach
                    </tr>
                    {{-- <td>{{ $value->diagnosa }}</td> --}}
                    {{-- <td>
                                {!! $value->terapi_kie !!}
                            </td>
                            <td>
                                {!! $value->paraf !!}
                            </td> --}}
                    {{-- <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->nama_kk }}</td>
                           
                            <td>{{ $pasien->umur }}</td>
                            <td>{{ $pasien->status }}</td> --}}
                    {{-- @if (request('status') == 'bpjs')
                                <td>{{ $pasien->no_bpjs }}</td>
                            @endif --}}
                    {{-- <td>{{ $pasien->alamat }}</td> --}}
                    {{-- <td>
                                <a href="{{ route('pendaftaran.periksa', $pasien->id) }}"
                                    class="btn btn-success btn-sm text-white">Periksa</a>
                                <a href="{{ route('pendaftaran.show', $pasien->id) }}"
                                    class="btn btn-info btn-sm text-white" target="blank">Cetak</a>
                                <a href="{{ route('pendaftaran.edit', $pasien->id) }}"
                                    class="btn btn-warning btn-sm text-white">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal"
                                    data-bs-target="#deletePasien{{ $pasien->id }}">Hapus</a>
                            </td> --}}

                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>


    {{-- @foreach ($pasiens as $pasien)
        <div class="modal fade" id="deletePasien{{ $pasien->id }}" tabindex="-1"
            aria-labelledby="deletePasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePasienLabel">Hapus pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Yakin menghapus Pasien "{{ $pasien->nama }}" ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('pendaftaran.destroy', $pasien->id) }}" method="post"
                            class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}

    @push('scripts')
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    buttons: ['excel', 'pdf', 'colvis'],
                    dom: "<'row'<' col-md-3'l><' col-md-5'B><' col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-md-5'i><'col-md-7'p>>"
                });

                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-5:eq(0)');
            });
        </script>


        {{-- sukses --}}
        @if (session('message'))
            <script>
                toastr.success("{{ session('message') }}");
            </script>
        @endif

        @if (session('failed'))
            <script>
                toastr.error("{{ session('failed') }}");
            </script>
        @endif


    @endpush
</x-app-layout>
