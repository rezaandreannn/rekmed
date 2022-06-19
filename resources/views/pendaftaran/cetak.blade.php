<!DOCTYPE html>
<html>

<head>
    <style>
        #cetak {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 500px;
            margin: 50px auto;
            background-color: #f2f2f2;
        }

        #cetak td,
        #cetak th {
            /* border: 1px solid #ddd; */
            padding: 6px 5px 5px 5px;
        }

        /* #cetak tr:nth-child(even){background-color: #f2f2f2;} */

        /* #cetak tr:hover {background-color: #ddd;} */

        #cetak th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>


    <table id="cetak">
        <tr>
            <th colspan="2">Kartu Berobat</th>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">No RM : {{ $pasien->no_rm }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>{{ $pasien->nama }} </td>
        </tr>
        <tr>
            <td>Nama KK</td>
            <td>{{ $pasien->nama_kk }} </td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>{{ $pasien->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>{{ $pasien->umur }} tahun</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                @if ($pasien->status == 'bpjs')
                    {{ $pasien->status }} / {{ $pasien->no_bpjs }}
                @else
                    {{ $pasien->status }}
                @endif

            </td>
        </tr>
        <tr>
            <th colspan="2" style="text-align: left;">Kartu Harap Dibawa Jika Berobat. </th>

        </tr>
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
