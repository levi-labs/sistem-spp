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
            <th>Nama</th>
            <th>Invoice</th>
            <th>ID Transaksi</th>
            <th>Jumlah</th>
            <th>Status Pembayaran</th>


        </tr>
        @foreach ($data as $dt)
            <tr>
                <td class="text-center">{{ $dt->siswas->nama }}</td>
                <td class="text-center">{{ $dt->invoice }}</td>

                <td class="text-center">{{ $dt->pembayarans->id_transaksi }}</td>
                <td class="text-center">@currency($dt->pembayarans->jumlah)</td>
                <td class="text-center">{{ $dt->status }}</td>
            </tr>
        @endforeach

    </table>
    {{-- <h3 style="float: right;">Total : {{ $total }}</h3> --}}



    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.print();
        });
    </script>
</body>

</html>
