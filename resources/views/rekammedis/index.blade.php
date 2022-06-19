<x-app-layout>
    {{-- optional --}}
    {{-- 2. selecteddeleted all --}}
    {{-- 1. status pasien
    {{-- end optional --}}

    <div class="row ">
        <div class="col-md-3">
            <form action="" method="get">
                {{-- @csrf --}}
                <div class="d-flex justify-content-between">
                    <select name="status" class="form-select mb-1" id="status">

                        @if (request('status') == 'umum')
                            <option value="umum" selected>Umum</option>
                            <option value="bpjs">Bpjs</option>
                            <option value="">Semua</option>
                        @elseif(request('status') == 'bpjs')
                            <option value="bpjs" selected>Bpjs</option>
                            <option value="umum">Umum</option>
                            <option value="">Semua</option>
                        @else
                            <option value="" selected>Semua</option>
                            <option value="umum">Umum</option>
                            <option value="bpjs">Bpjs</option>
                        @endif
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm mb-1">Pilih</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body bg-white shadow-sm">
            <table id="example" class="table bg-white" style="width:100%">
                <h5>Data pasien</h5>
                <hr>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No RM </th>
                        <th>No RM </th>
                        {{-- <th>Nama </th>
                        <th>Nama kk</th>
                       
                        <th>Umur</th>
                        <th>Status</th>
                       
                        <th>opsi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekammedis as $key => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {!! $value->terapi_kie !!}
                            </td>
                            <td>
                                {!! $value->paraf !!}
                            </td>
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
                        </tr>
                    @endforeach
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
