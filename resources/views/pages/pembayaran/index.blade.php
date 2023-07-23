@extends('layout.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                @php
                    if (auth()->user()->akses_user == 'siswa') {
                        $compare = \App\Models\CheckOut::where('siswa_id', auth()->user()->siswas->id)
                            ->where('status', 'UNPAID')
                            ->count();
                    }
                    
                    // dd($compare);
                    
                @endphp

                <div class="row">
                    <div class="col-md-8">
                        @if (auth()->user()->akses_user == 'siswa')
                            @if ($compare == 0)
                                <button class="d-print-none btn btn-secondary btn-sm" disabled><span
                                        class="mdi mdi-cart-variant"></span>&nbsp;Cek
                                    Daftar
                                    Bayar</button>
                            @else
                                <a href="{{ url('/cek-pembayaran') }}" class="d-print-none btn btn-success btn-sm"
                                    style="background-color:#14a13e ;"><span class="mdi mdi-cart-variant"></span>&nbsp;Cek
                                    Daftar
                                    Bayar</a>
                            @endif
                        @endif

                        <a href="{{ url('/print-index-unpaid') }}" target="_blank"
                            class="d-print-none btn btn-secondary btn-sm"><span
                                class="mdi mdi-printer-outline"></span>&nbsp;Print</a>
                    </div>
                    {{-- <div class="col-md-4 text-center">
                        <form action="{{ url('/search-belum-bayar') }}" method="GET">
                            <div class="input-group mb-3">

                                <input class="form-control " type="text" placeholder="Nomor Induk Siswa"
                                    aria-label="Disabled input example" name="search">
                                <div class="input-group-prepend mx-2">
                                    <button class="btn btn-outline-secondary btn-sm" type="submit">Button</button>
                                </div>
                            </div>



                        </form>
                    </div> --}}
                </div>


                <div class="d-print-table table-responsive mt-3">
                    <table class="table table-hover text-sm">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jenis Biaya</th>
                                <th>Jumlah</th>
                                <th>ID Transaksi</th>
                                <th>Status Pembayaran</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                                <tr class="text-sm">
                                    <td>{{ $dt->siswa->nis }}</td>
                                    <td>{{ $dt->siswa->nama }}</td>
                                    <td>{{ $dt->jenis_biaya }}</td>
                                    <td>@currency($dt->jumlah)</td>
                                    <td>{{ $dt->id_transaksi }}</td>
                                    <td class="text-center"><label class="badge badge-danger">{{ $dt->status }}</label>
                                    </td>
                                    @php
                                        $cekTransaksi = \App\Models\CheckOut::where('id_transaksi', $dt->id)
                                            ->where('status', 'unpaid')
                                            ->where('siswa_id', $dt->siswa->id)
                                            ->count();
                                        // dd($cekTransaksi);
                                    @endphp
                                    @if ($cekTransaksi > 0)
                                        <td><button class="btn btn-secondary btn-sm" disabled>add</button></td>
                                    @else
                                        <td><a href="{{ url('/tambah-pembayaran/' . $dt->id) }}"
                                                class="btn btn-info btn-sm">add</a></td>
                                    @endif
                                    {{-- <td><a href="{{ url('/tambah-pembayaran/' . $dt->id) }}"
                                            class="btn btn-info btn-sm">add</a></td> --}}
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
