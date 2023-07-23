<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .center-tb {
        margin: auto;
    }

    td {
        text-align: center
    }
</style>

<body>

    <table class="center-tb" border="1" width="100%">
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jenis Biaya</th>
            <th>Jumlah</th>
            <th>ID Transaksi</th>
            <th>Status Pembayaran</th>

        </tr>
        @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->siswa->nis }}</td>
                <td>{{ $dt->siswa->nama }}</td>
                <td>{{ $dt->jenis_biaya }}</td>
                <td>@currency($dt->jumlah)</td>
                <td>{{ $dt->id_transaksi }}</td>
                <td class=""><label class="badge badge-danger">{{ $dt->status }}</label>
                </td>
            </tr>
        @endforeach

    </table>
    <h3 style="float: right;">Total : {{ $total }}</h3>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.print();
        });
    </script>
</body>

</html>
