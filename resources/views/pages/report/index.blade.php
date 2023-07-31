@extends('layout.master')
@section('content')
    @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif
    <style>
        .my-print {
            display: none;

        }

        @media print {

            html,
            body {
                margin: auto !important;
                display: block !important;
                /* width: 210mm;
                                                                                                                                                                                                                                                                                                        height: 297mm; */
                font-size: 14px !important;
            }

            .the-kop {
                display: block !important;
                margin: auto !important;
                width: 100% !important;
            }

            .my-kop {
                display: block !important;
                margin: auto !important;
                width: 100% !important;
            }

            th,
            td {

                text-align: center
            }



            .my-print {
                display: block !important;
                margin: auto !important;
            }

            .report-print {
                display: none !important;
            }

            .table-print {
                margin: auto !important;
            }

            .table-print table {
                margin: auto !important;
                display: block !important;
                width: 100% !important;
            }
        }
    </style>
    <div class="row justify-content-center d-print-none">
        <div class="col-md-12 grid-margin stretch-card ">
            <div class="card d-print-none">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>

                    <form class="forms-sample" method="POST" action="{{ url('/report-print') }}" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Dari Tanggal</label>
                            <input type="date" class="form-control my-1" id="exampleInputUsername1" placeholder="dari"
                                name="dari" required>
                            <label for="exampleInputUsername1">Sampai Tanggal</label>
                            <input type="date" class="form-control my-1" id="exampleInputUsername1" placeholder="sampai"
                                name="sampai" required>
                            {{-- @error('invoice')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror --}}
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="/report-semua" onclick="window.location.reload()" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @if (isset($data))
        <div class="row justify-content-center report-print">
            <div class="col-md-12 grid-margin stretch-card ">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title d-print-none">{{ $result }}</h4> --}}


                        <div class="table-print">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>

                                        <th>Kelas</th>
                                        <th>Jenis Biaya</th>
                                        {{-- <th>ID Transaksi</th> --}}
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        @php
                                            $invoice = $dt->invoice;
                                        @endphp
                                        <tr>
                                            <td>{{ $dt->siswa->nis }}</td>
                                            <td>{{ $dt->siswa->nama }}</td>
                                            <td>{{ $dt->siswa->tingkat_kelas }}</td>
                                            <td>{{ $dt->jenis_biaya }}</td>

                                            {{-- <td>{{ $dt->pembayarans->id_transaksi }}</td> --}}
                                            <td>@currency($dt->jumlah)</td>
                                            <td>{{ $dt->tanggal }}</td>
                                            <td>{{ $dt->status }}</td>
                                        </tr>
                                    @endforeach
                                    {{-- <a href="{{ url('/print-invoice/' . $invoice) }}" target="_blank"
                                        class="btn btn-secondary btn-sm"><span
                                            class="mdi mdi-printer-outline"></span>&nbsp;Print</a> --}}
                                    <a href="#" onclick="window.print()"
                                        class="btn btn-secondary btn-sm d-print-none"><span
                                            class="mdi mdi-printer-outline "></span>&nbsp;Print</a>
                                </tbody>


                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>




        <div class="row justify-content-center print">

            <div class="my-print">
                <div class="col-md-12 grid-margin stretch-card ">
                    <div class="">
                        <div class="">
                            {{-- <h4 class="card-title d-print-none">{{ $result }}</h4> --}}
                            <center class="the-kop">
                                <table class="my-kop" width="680">
                                    <tr>
                                        <td>
                                            <img width="90" height="90"
                                                src="{{ asset('assets/images/logo-sekolah.png') }}" alt="">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <center>
                                                <font size="3"> <b>SEKOLAH MENENGAH PERTAMA INSAN MUTTAQIN ISLAMIC
                                                        SCHOOL</b></font><br>

                                                <font size="1"><i><b>"Mencetak Generasi Qurani yang Berwawasan
                                                            Global"</b></i>
                                                </font>
                                                <br>
                                                <font size="2"><b>Kp.Lubangbuaya RT 001/001 Desa Lubangbuaya Kecamatan
                                                        Setu Kabupaten Bekasi.<br>17320</b></font>
                                                <br>
                                                <font size="2">
                                                    <b>Tel:081317143803|Email:insanmuttaqinofficial@gmail.com
                                                        <br>|Website:insanmuttaqin.sch.id</b>
                                                </font><br>
                                            </center>

                                        </td>
                                    </tr>


                                </table>
                                <hr style="border-top: 2px solid black;">
                                <hr style="border-top: 2px solid black; margin-top:-7px;">
                                <br>




                            </center>

                            <div class="table-print">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama</th>

                                            <th>Kelas</th>
                                            <th>Jenis Biaya</th>
                                            {{-- <th>ID Transaksi</th> --}}
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $dt)
                                            @php
                                                $invoice = $dt->invoice;
                                            @endphp
                                            <tr>
                                                <td>{{ $dt->siswa->nis }}</td>
                                                <td>{{ $dt->siswa->nama }}</td>
                                                <td>{{ $dt->siswa->tingkat_kelas }}</td>
                                                <td>{{ $dt->jenis_biaya }}</td>

                                                {{-- <td>{{ $dt->pembayarans->id_transaksi }}</td> --}}
                                                <td>@currency($dt->jumlah)</td>
                                                <td>{{ $dt->tanggal }}</td>
                                                <td>{{ $dt->status }}</td>
                                            </tr>
                                        @endforeach
                                        {{-- <a href="{{ url('/print-invoice/' . $invoice) }}" target="_blank"
                                        class="btn btn-secondary btn-sm"><span
                                            class="mdi mdi-printer-outline"></span>&nbsp;Print</a> --}}
                                        <a href="#" onclick="window.print()"
                                            class="btn btn-secondary btn-sm d-print-none"><span
                                                class="mdi mdi-printer-outline "></span>&nbsp;Print</a>
                                    </tbody>


                                </table>
                                <center class="the-kop">
                                    <br>
                                    <br>
                                    <br>
                                    <table width="690">
                                        <tr>
                                            <td width="650"></td>
                                            <td style="text-align: center">
                                                <b>Bekasi,<br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br>
                                                <p>Bendahara</p>,
                                                <br><br> <br><br><br><br>

                                                <br>
                                                <p><b>{{ auth()->user()->bendaharas->nama }}</b></p>
                                                <hr width="100px">
                                            </td>
                                            <td width="80"></td>
                                            <td style="text-align: center">
                                                <b>Bekasi,<br>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</b><br>
                                                <p>Kepala Sekolah</p>,
                                                <br><br> <br><br><br><br>

                                                <br>
                                                <p><b>Suminta S.Si M.M</b></p>
                                                <hr width="100px">
                                            </td>
                                        </tr>
                                    </table>
                                </center>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif




@endsection
