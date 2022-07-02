<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="table table-bordered">
        <thead class="fw-bold">
            <tr class="text-center">
                <th scope="col" rowspan="2" colspan="2">Jenis Penyakit</th>
                @foreach ($diagnosas as $key => $umur)
                    <th scope="col" colspan="2">{{ $umur }} Thn</th>
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
                    <td colspan="2">{{ $diagnosa }}</td>
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
</body>

</html>
