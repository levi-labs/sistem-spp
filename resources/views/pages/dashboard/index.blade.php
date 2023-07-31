@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                {{-- <div class="d-sm-flex align-items-center justify-content-between border-bottom">

                    <div>
                        <div class="btn-wrapper">
                            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i>
                                Share</a>
                            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i>
                                Export</a>
                        </div>
                    </div>
                </div> --}}
                <hr>
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                        <div class="row justify-content-center">
                            <div class="col-sm-12 text-center stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="statistics-details d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="statistics-title">SISWA/SISWI</p>
                                                <h3 class="rate-percentage">{{ $siswa }}</h3>
                                                {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span>
                                            </p> --}}
                                            </div>
                                            <div>
                                                <p class="statistics-title">BENDAHARA/ADMIN</p>
                                                <h3 class="rate-percentage">{{ $bendahara }}</h3>
                                                {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p> --}}
                                            </div>
                                            <div>
                                                <p class="statistics-title">Transaksi Sudah Bayar</p>
                                                <h3 class="rate-percentage">{{ $kelas }}</h3>
                                                {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> --}}
                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Transaksi Belum Bayar</p>
                                                <h3 class="rate-percentage">{{ $users }}</h3>
                                                {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span>
                                            </p> --}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->akses_user == 'siswa')
                            <div class="row mt-2">
                                <div class="col-lg-12 d-flex flex-column">

                                    <div class="row flex-grow">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 align-middle">

                                                            <h2>Cara Pembayaran</h2>
                                                            <button id="btn-bayar"
                                                                class="btn btn-primary btn-lg my-auto text-white"
                                                                onclick="fnBayar()">Cara
                                                                Pembayaran</button>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="{{ asset('/assets/steppayment/intro.svg') }}"
                                                                alt="" style="width: 50%;">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section id="cara-bayar">
                                <div class="row mt-2">
                                    <div class="col-lg-12 d-flex flex-column">

                                        <div class="row flex-grow">
                                            <div class="col-md-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('/assets/steppayment/step 1.png') }}"
                                                                    alt=""
                                                                    style="width: 500px;  max-height: 220px;">
                                                                <hr>
                                                                <h5>STEP 1</h5>
                                                                <ul>
                                                                    <li>Pilih Menu Pembayaran</li>
                                                                    <li>Pilih Daftar Belum di Bayar</li>
                                                                    <li>Pilih Transaksi yang ingin dibayar dengan Klik
                                                                        Tombol
                                                                        <button class="btn btn-info btn-sm">Add</button>
                                                                        Pada
                                                                        Menu Option
                                                                    </li>
                                                                    <li>Pada Menu Option Pilih Tombol Add</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('/assets/steppayment/step 2.png') }}"
                                                                    alt=""
                                                                    style="width: 500px;  max-height: 220px;">
                                                                <hr>
                                                                <h5>STEP 2</h5>
                                                                <ul>
                                                                    <li>Jika Sudah Berhasil di tambah kan tombol <button
                                                                            class="btn btn-secondary btn-sm"
                                                                            disabled>Add</button>
                                                                        Akan
                                                                        Berwarna Abu-abu</li>
                                                                    <li>Jika Sudah Maka Klik Tombol <button
                                                                            class="btn btn-success btn-sm text-white "
                                                                            style="background-color:#14a13e ;">Cek Daftar
                                                                            Bayar</button></li>
                                                                    {{-- <li></li>
                                                            <li></li> --}}
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('/assets/steppayment/step 3.png') }}"
                                                                    alt="" style="width: 500px; max-height: 220px;">
                                                                <hr>
                                                                <h5>STEP 3</h5>
                                                                <ul>
                                                                    <li>Pilih Tombol <button
                                                                            class="btn btn-info btn-sm">Bayar</button></li>
                                                                    <li>Akan Tampil Menu Pembayaran Seperti pada gambar Step
                                                                        4
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('/assets/steppayment/step 4.png') }}"
                                                                    alt=""
                                                                    style="width: 500px;  max-height: 220px;">
                                                                <hr>
                                                                <h5>STEP 4</h5>
                                                                <ul>
                                                                    <li>Pilih Salah Satu Menu Pembayaran Bank Transfer /
                                                                        QRIS
                                                                    </li>
                                                                    <li>Jika Sudah Maka Akan Tampil Nomor Virtual Account /
                                                                        Barcode
                                                                    </li>
                                                                    <li>Lakukan Transfer sesuai dengan metode pembayaran
                                                                        masing-masing</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('/assets/steppayment/step 5.png') }}"
                                                                    alt="" style="width: 500px; max-height: 220px;">
                                                                <hr>
                                                                <h5>STEP 5</h5>
                                                                <ul>
                                                                    <li>Ketika Pembayaran Berhasil dilakukan akan tampil
                                                                        seperti
                                                                        gambar pada Step 5</li>
                                                                    <li>Maka klik tombol Oke</li>
                                                                    <li>User akan dialihkan kehalaman Daftar Sudah di Bayar
                                                                        seperti
                                                                        pada gambar Step 6</li>

                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('/assets/steppayment/step 6.png') }}"
                                                                    alt=""
                                                                    style="width: 500px;  max-height: 220px; min-height: 220px;">
                                                                <hr>
                                                                <h5>STEP 6</h5>
                                                                <ul>
                                                                    <li>Pembayaran yang berhasil akan otomatis terupdate
                                                                        statusnya
                                                                        menjadi <span
                                                                            class="badge badge-success">PAID</span>
                                                                        seperti pada gambar Step 6</li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="text-center">
                                                                <button id="btn-kembali" onclick="fnBack()"
                                                                    class="btn btn-dark text-white">Kembali</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </section>
                        @elseif(auth()->user()->akses_user == 'bendahara')
                            <style>
                                .chart-wrapper {
                                    width: 400px !important;
                                }
                            </style>
                            <div class="row  mt-4">

                                <div class="col-md-6  text-center">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Diagram Pembayaran SPP</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-wrapper">
                                                <canvas id="myChart"></canvas>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6  text-center">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Diagram Uang Buku</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-wrapper">
                                                <canvas id="bukuChart"></canvas>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row  mt-4">

                                <div class="col-md-6  text-center">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Diagram Biaya Seragam</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-wrapper">
                                                <canvas id="seragamChart"></canvas>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6  text-center">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Diagram Biaya Dana Kegiatan</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-wrapper">
                                                <canvas id="kegiatanChart"></canvas>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->akses_user == 'siswa')
        <script>
            // alert(btnBayar);
            function fnBayar() {
                // btnBayar = document.getElementById('btn-bayar');

                var scrollDiv = document.getElementById("cara-bayar").offsetTop;

                window.scrollTo({
                    top: scrollDiv - 80,
                    behavior: 'smooth'
                });
            }

            function fnBack() {
                var scrollDiv = document.getElementById("top-top").offsetTop;

                window.scrollTo({
                    top: scrollDiv - 80,
                    behavior: 'smooth'
                });
            }
        </script>
    @elseif(auth()->user()->akses_user == 'bendahara')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');
            const ctb = document.getElementById('bukuChart');
            const ctc = document.getElementById('seragamChart');
            const ctd = document.getElementById('kegiatanChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($paid) !!},
                    datasets: [{
                        label: 'jumlah',
                        data: [{!! json_encode($cpaid) !!}, {!! json_encode($cunpaid) !!}],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.9)',
                            'rgba(255, 99, 132, 0.9)',

                        ],

                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            new Chart(ctb, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($paid) !!},
                    datasets: [{
                        label: 'jumlah',
                        data: [{!! json_encode($bukuPaid) !!}, {!! json_encode($bukuUnpaid) !!}],
                        borderWidth: 1,
                        backgroundColor: [

                            'rgba(54, 162, 235, 0.9)',
                            'rgba(255, 99, 132, 0.9)',

                        ],

                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            new Chart(ctc, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($paid) !!},
                    datasets: [{
                        label: 'jumlah',
                        data: [{!! json_encode($seragamPaid) !!}, {!! json_encode($seragamUnpaid) !!}],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.9)',
                            'rgba(255, 99, 132, 0.9)',
                        ],

                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            new Chart(ctd, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($paid) !!},
                    datasets: [{
                        label: 'jumlah',
                        data: [{!! json_encode($kegiatanPaid) !!}, {!! json_encode($kegiatanUnpaid) !!}],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.9)',
                            'rgba(255, 99, 132, 0.9)',
                        ],

                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endif
@endsection
