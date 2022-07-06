<x-app-layout title="LB 1">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
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
                <div class="col-md-3">
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
                <div class="col-md-3">
                    <x-select field="diagnosa" label="Pilih Diagnosa">
                        <option value="">Pilih</option>
                        @foreach (App\Models\Kunjungan::DIAGNOSA as $key => $value)
                            @if ($value == request('diagnosa'))
                                <option value="{{ $value }}" selected>{{ $value }}</option>
                            @else
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endif
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px">Submit</button>
                </div>
                </form>
            </div>

            <form action="{{ route('test_lb_report') }}" method="get">
                <input type="hidden" name="bulan" value="{{ request('bulan') ?? date('m') }}">
                <input type="hidden" name="tahun" value="{{ request('tahun') ?? date('Y') }}">
                <input type="hidden" name="diagnosa" value="{{ request('diagnosa') ?? null }}">
                <button class="btn btn-success my-3" type="submit">EXPORT EXCEL</button>
            </form>

            <div class="card">
                <h5 class="text-center mt-2">Laporan Bulanan Puskesmas Bumiemas</h5>
                <p class="text-center text-muted">Bulan {{ request('bulan') ?? date('M') }}
                    <br>
                    Tahun {{ request('tahun') ?? date('Y') }}
                </p>
                <p class="text-end me-3">
                    @if (request('diagnosa'))
                        Total penyakit <span class="fw-bold"> {{ request('diagnosa') }}</span> :
                        {{ $diagnosa->total() }}
                    @else
                        Total : {{ $diagnosa->total() }}
                    @endif
                </p>
                <div class="card-body bg-white shadow-sm">
                    <table class="table table-bordered">
                        <thead class="fw-bold">
                            <tr>
                                <td rowspan="2">jenis penyakit</td>
                                <td rowspan="2">umur</td>
                                <td colspan="2">jenis kelamin</td>
                                <td rowspan="2">jumlah</td>
                            </tr>
                            <tr>
                                <td>L</td>
                                <td>P</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnosa as $diagnosas => $values)
                                <tr>
                                    <td>{{ $values->diagnosa }}</td>
                                    <td>{{ $values->umur }}</td>
                                    <td>{{ $values->l_count }}</td>
                                    <td>{{ $values->p_count }}</td>
                                    <td>{{ $values->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $diagnosa->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
