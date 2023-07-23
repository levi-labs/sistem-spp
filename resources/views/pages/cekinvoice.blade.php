@extends('layout.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>

                    <form class="forms-sample" method="POST" action="{{ url('/post-invoice') }}" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Nomor invoice</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="invoice"
                                name="invoice">
                            @error('invoice')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="#" onclick="window.location.reload()" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @if (isset($invoice))
        <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card ">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $result }}</h4>


                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Invoice</th>

                                        <th class="text-center">ID Transaksi</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        @php
                                            $invoice = $dt->invoice;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $dt->siswas->nama }}</td>
                                            <td class="text-center">{{ $dt->invoice }}</td>

                                            <td class="text-center">{{ $dt->pembayarans->id_transaksi }}</td>
                                            <td class="text-center">@currency($dt->pembayarans->jumlah)</td>
                                            <td class="text-center">{{ $dt->status }}</td>
                                        </tr>
                                    @endforeach
                                    <a href="{{ url('/print-invoice/' . $invoice) }}" target="_blank"
                                        class="btn btn-secondary btn-sm"><span
                                            class="mdi mdi-printer-outline"></span>&nbsp;Print</a>
                                </tbody>


                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

@endsection
