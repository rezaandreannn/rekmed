<x-app-layout title="Registrasi rawat jalan">
    <div class="card">
        <div class="card-body bg-white shadow-sm">
            <table id="example" class="table bg-white" style="width:100%">
                <h5>Registrasi Rawat Jalan</h5>
                <hr>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Nama KK</th>
                        <th>Alamat</th>
                        <th>jenis <br>Kelamin</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Terapi & kie</th>
                        {{-- <th>Opsi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registrasis as $registrasi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $registrasi->pasien->nama }}</td>
                            <td>{{ $registrasi->pasien->nama_kk }}</td>
                            <td>{{ $registrasi->pasien->alamat }}</td>
                            <td>{{ $registrasi->pasien->jenis_kelamin }}</td>
                            <td>{!! $registrasi->keluhan !!}</td>
                            <td>{{ $registrasi->diagnosa }}</td>
                            <td>{!! $registrasi->terapi_kie !!}</td>
                            {{-- <td></td> --}}
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



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
