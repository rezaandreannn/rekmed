<x-app-layout title="LB 1">
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

            <form action="{{ route('lb_report') }}" method="get">
                <input type="hidden" name="bulan" value="{{ request('bulan') ?? date('m') }}">
                <input type="hidden" name="tahun" value="{{ request('tahun') ?? date('Y') }}">
                <button class="btn btn-success my-3" type="submit">EXPORT EXCEL</button>
            </form>

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
                                    <th scope="col" colspan="2">{{ $umur }} Thn</th>
                                @endforeach
                                <th scope="col" rowspan="2">Total</th>
                            </tr>
                            <tr class="text-center">
                                @foreach ($diagnosas as $key => $item)
                                    <th scope="row">L</th>
                                    <th scope="row">P</th>
                                @endforeach
                            </tr>

                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($reports as $diagnosa => $values)
                                <tr>
                                    <td>{{ $diagnosa }}</td>
                                    @foreach ($diagnosas as $umur)
                                        <td>
                                            {{ $reports[$diagnosa][$umur]['l'] ?? '0' }}
                                        </td>
                                        <td>{{ $reports[$diagnosa][$umur]['p'] ?? '0' }}
                                            {{-- <td>{{ $reports[$diagnosa][$umur]['jumlah'] ?? '0' }} --}}
                                            <?php
                                            
                                            // $total += $reports[$diagnosa][$umur]['jumlah'] ?? 0;
                                            // var_dump($total);
                                            // ambil data
                                            // $laki = $reports[$diagnosa][$umur]['l'] ?? 0;
                                            // $perempuan = $reports[$diagnosa][$umur]['l'] ?? 0;
                                            // // ubah menjadi int
                                            // $l = (int) $laki;
                                            // $p = (int) $perempuan;
                                            // $total = $l + $p;
                                            ?>
                                    @endforeach
                                    {{-- @foreach ($values as $item) --}}
                                    {{-- data jumlah dapet, namun implementasi blm run --}}
                                    <?php
                                    // $total = $item['jumlah'];
                                    // var_dump($total);
                                    // $l = (int) $item['l'];
                                    // $p = (int) $item['p'];
                                    // $total = $l + $p;
                                    // var_dump($total);
                                    // $total += $item['jumlah'];
                                    ?>
                                    {{-- data jumlah dapet, namun implementasi blm run --}}
                                    {{-- @endforeach --}}
                                    {{-- test --}}
                                    <?php
                                    ?>
                                    {{-- test --}}
                                    {{-- hitung berdasarkan jumlah belum array multidimensi --}}
                                    {{-- <td>{{ count($values) }}</td> --}}
                                    {{-- hitung berdasarkan jumlah belum array multidimensi --}}
                                    <td>
                                        {{ $total }}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
