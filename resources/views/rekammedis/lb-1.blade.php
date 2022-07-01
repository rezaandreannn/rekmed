<x-app-layout>
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <form action="" method="get">
                        <x-select field="bulan" label="Pilih Bulan">
                            <option value="">Pilih</option>
                            @foreach (App\Models\Kunjungan::BULAN as $key => $value)
                                @if ($key == request('bulan'))
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </x-select>
                </div>
                <div class="col-md-5">
                    <x-select field="tahun" label="Pilih Tahun">
                        <option value="">Pilih</option>
                        @foreach (App\Models\Kunjungan::TAHUN as $key => $value)
                            @if ($key == request('tahun'))
                                <option value="{{ $key }}" selected>{{ $value }}</option>
                            @else
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endif
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px">Submit</button>
                </div>
                </form>
            </div>

            <div class="card">
                <h5 class="text-center mt-2">Laporan Bulanan Puskesmas Bumiemas</h5>
                <p class="text-center text-muted">{{ request('bulan') ?? date('M') }},
                    {{ request('tahun') ?? date('Y') }}</p>
                <div class="card-body bg-white shadow-sm">
                    <table class="table table-bordered">
                        <thead class="fw-bold">
                            <tr class="text-center">

                                <th scope="col" rowspan="2">Jenis Penyakit</th>
                                @foreach ($diagnosas as $key => $umur)
                                    <th scope="col" colspan="2">{{ $umur }}</th>
                                @endforeach
                                {{-- <th scope="col" rowspan="2">Total</th> --}}
                            </tr>
                            <tr class="text-center">
                                @foreach ($diagnosas as $key => $item)
                                    <th scope="row">L</th>
                                    <th scope="row">P</th>
                                @endforeach
                                {{-- <th scope="row"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $diagnosa => $values)
                                <tr>
                                    <td>{{ $diagnosa }}</td>
                                    {{-- @foreach ($values as $item => $a) --}}
                                    @foreach ($diagnosas as $job_comp_code)
                                        <td>
                                            {{ $reports[$diagnosa][$job_comp_code]['l'] ?? '0' }}
                                        </td>
                                        <td>{{ $reports[$diagnosa][$job_comp_code]['p'] ?? '0' }}</td>
                                    @endforeach



                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
