<x-app-layout title='Home'>
    <div class="container">
        {{-- card --}}
        <div class="row">
            @if (auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'pendaftaran')
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Jumlah Pasien</h6>
                            <h2 class="text-right"><span>{{ $pendaftaran->count() ?? '0' }}</span>
                            </h2>
                            <p class="m-b-0">Pasien baru hari ini<span
                                    class="f-right">{{ $pendaftaranHariIni->count() ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Pasien BPJS</h6>
                            <h2 class="text-right"><span>{{ $bpjs->count() ?? '0' }}</span>
                            </h2>
                            <p class="m-b-0">Pasien baru hari ini<span
                                    class="f-right">{{ $bpjsHariIni->count() ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Pasien Umum</h6>
                            <h2 class="text-right"><span>{{ $umum->count() ?? '0' }}</span>
                            </h2>
                            <p class="m-b-0">Pasien baru hari ini<span
                                    class="f-right">{{ $umumHariIni->count() ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->role->name == 'admin')
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Rekam Medis</h6>
                            <h2 class="text-right"><span>{{ $registrasis->count() }}</span></h2>
                            <p class="m-b-0">Hari ini<span class="f-right">{{ $registrasisHariIni->count() }}</span>
                            </p>
                        </div>
                    </div>
                </div>
        </div>
        @endif

        @if (auth()->user()->role->name == 'poli')
            <div class="row">
                <div class="col">
                    <div class="alert alert-warning ml-5" role="alert">
                        Note: <span class="fw-bold">Antrian</span> dan <span class="fw-bold">pasien selesai
                            berobat</span> menampilkan pada
                        hari ini. Tgl <span class="fw-bold">{{ date('d-m-Y') }}</span>
                        <br>
                        Note: <span class="fw-bold">10 Penyakit Terbesar</span> menampilkan data pada
                        <span class="fw-bold">bulan {{ date('F') }}.</span>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Antrian </h6>
                            <h2 class="text-right"><span>{{ $antrians->count() }}</span></h2>
                            @if ($antrians->count() != 0)
                                <a href="{{ route('kunjungan.index') }}" class="m-b-0 text-decoration-none"><span
                                        class="f-right fw-bold text-capitalize text-white">Lihat</span></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Selesai berobat</h6>
                            <h2 class="text-right"><span>{{ $kunjungans->count() }}</span></h2>
                            @if ($kunjungans->count() != 0)
                                <a href="{{ route('kunjungan.index') }}" class="m-b-0 text-decoration-none"><span
                                        class="f-right fw-bold text-capitalize text-white">Lihat</span></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Rekam Medis</h6>
                            <h2 class="text-right"><span>{{ $registrasis->count() }}</span></h2>
                            <p class="m-b-0">Hari ini<span class="f-right">{{ $registrasisHariIni->count() }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        @if (auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'poli')
            {{-- chart js row --}}
            <div class="row mt-2">
                <div class="col">
                    <div class="card">
                        <canvas id="myChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        @endif

        @push('scripts')
            <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach ($diagnosa as $label)
                                '{{ $label->nama_diagnosa }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: '10 penyakit Terbesar',
                            data: [
                                @foreach ($diagnosa as $label)
                                    '{{ $label->jumlah }}',
                                @endforeach
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endpush
</x-app-layout>
