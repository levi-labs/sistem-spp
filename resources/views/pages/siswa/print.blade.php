<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
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
            <th>Kelas</th>
            <th>Periode</th>
            {{-- <th>Option</th> --}}

        </tr>
        @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->nis }}</td>
                <td>{{ $dt->nama }}</td>
                <td>{{ $dt->jenis_kelas }}</td>
                <td>{{ $dt->periode }}</td>
                {{-- <td class=""><label class="badge badge-danger">{{ $dt->status }}</label>
                </td> --}}

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
