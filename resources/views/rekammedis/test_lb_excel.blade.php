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
            <tr>
                <td rowspan="2" colspan="2">jenis penyakit</td>
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
                    <td colspan="2">{{ $values->diagnosa }}</td>
                    <td>{{ $values->umur }}</td>
                    <td>
                        @if ($values->l_count)
                            {{ $values->l_count }}
                        @else
                            {{ 0 }}
                        @endif
                    </td>
                    <td>
                        @if ($values->p_count)
                            {{ $values->p_count }}
                        @else
                            {{ 0 }}
                        @endif
                    </td>
                    <td>{{ $values->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
