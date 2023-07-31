@extends('layout.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>

                <a href="{{ url('/print-index-paid') }}" target="_blank" class="btn btn-secondary btn-sm"><span
                        class="mdi mdi-printer-outline"></span>&nbsp;Print</a>
                <div class="table-responsive mt-3">
                    <table class="table table-hover text-sm">
                        <thead>
                            <tr>
                                <th>NIS </th>
                                <th>Nama</th>
                                <th>Jenis Biaya</th>
                                <th>Jumlah</th>

                                <th>Status Pembayaran</th>
                                {{-- <th>detail</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                                <tr>
                                    <td>{{ $dt->siswas->nis }}</td>
                                    <td><a
                                            href="{{ url('/detail-sudah-dibayar/' . $dt->siswa_id) . '/' . $dt->invoice }}">{{ $dt->siswas->nama }}</a>
                                    </td>
                                    <td>{{ $dt->pembayarans->jenis_biaya }}</td>
                                    <td>@currency($dt->pembayarans->jumlah)</td>
                                    {{-- <td>{{ $dt->invoice }}</td> --}}
                                    <td class="text-center"><label class="badge badge-success">{{ $dt->status }}</label>
                                    </td>
                                    {{-- <td><button class="btn btn-info btn-sm">detail</button></td> --}}
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
