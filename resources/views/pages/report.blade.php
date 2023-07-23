@extends('layout.master')
@section('content')
    @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif
    <style>
        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .report-print {
                display: block !important;
            }

            table {
                display: block !important;
                width: 50% !important;
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
                        <a href="#" onclick="window.location.reload()" class="btn btn-light">Cancel</a>
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
                        <h4 class="card-title d-print-none">{{ $result }}</h4>


                        <div class="table">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Invoice</th>

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
                                            <td>{{ $dt->siswas->nama }}</td>
                                            <td>{{ $dt->invoice }}</td>

                                            {{-- <td>{{ $dt->pembayarans->id_transaksi }}</td> --}}
                                            <td>@currency($dt->pembayarans->jumlah)</td>
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
    @endif




@endsection
