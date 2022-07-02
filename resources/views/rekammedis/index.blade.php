<x-app-layout title="Kotak Rekam Medis">
    <div class="card">
        <div class="card-body bg-white shadow-sm">
            <table id="example" class="table bg-white" style="width:100%">
                <h5>Rekam Medis Pasien</h5>
                <hr>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Nama KK</th>
                        <th>Jumlah Kunjungan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekammedis as $key => $value)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $value[0]->nama }}
                            </td>
                            <td>
                                {!! $value[0]->nama_kk !!}
                            </td>
                            <td>
                                {!! $value->count() !!}
                            </td>
                            <td>
                                <a href="{{ route('rekammedis.detail', $value[0]->id) }}"
                                    class="btn btn-info btn-sm text-white">Detail</a>
                            </td>
                    @endforeach
                    </tr>

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
