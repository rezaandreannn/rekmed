<x-app-layout>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
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
                <h5 class="text-center mt-2">10 Data Penyakit Terbesar</h5>
                <p class="text-center text-muted">{{ request('bulan') ?? date('M') }},
                    {{ request('tahun') ?? date('Y') }}</p>
                <div class="card-body bg-white shadow-sm">
                    <table class="table table-bordered">
                        <thead class="fw-bold">
                            <tr class="text-center">
                                <th scope="col" rowspan="2" class="">No</th>
                                <th scope="col" rowspan="2">Jenis Penyakit</th>
                                {{-- <th scope="col" colspan="2">Kasus Lama</th>
                                <th scope="col" colspan="2">Kasus Baru</th> --}}
                                <th scope="col" colspan="3">Total</th>
                                {{-- <th scope="col" colspan="2">jumlah</th> --}}
                            </tr>
                            <tr class="text-center">
                                <th scope="row">L</th>
                                {{-- <td>P</td>
                                <td>L</td>
                                <td>P</td>
                                <td>L</td> --}}
                                <td>P</td>
                                <td>jumlah</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnosa as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_diagnosa }}</td>
                                    {{-- <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td></td> --}}

                                    <td class="text-center">{{ $item->l_count }}</td>
                                    <td class="text-center">{{ $item->p_count }}</td>
                                    <td class="text-center">{{ $item->jumlah }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <ol class="list-group list-group-numbered">
                        @forelse ($diagnosa as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ $item->nama_diagnosa }}</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{ $item->jumlah }}</span>
                            </li>
                        @empty
                            <div class="alert alert-primary d-flex align-items-center justify-content-center"
                                role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                    viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <div>
                                    Data Penyakit Terbesar Kosong
                                </div>
                            </div>
                        @endforelse
                    </ol> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
