@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    @php
                        // $invoice = '';
                        // foreach ($result as $value) {
                        //     $invoice = $value->invoice;
                        // }
                    @endphp
                    <div class="col-md-1">
                        <img src="{{ asset('/assets/images/logo-sekolah.svg') }}" alt=""
                            style="width:80px; height: 80px;">

                    </div>
                    <div class="col-xl-9">
                        <h5>INSAN MUTTAQIN ISLAMIC SCHOOL</h5>
                        <p style="color: #7e8d9f;font-size: 10px;">Invoice >> <strong>{{ $result->invoice }}</strong></p>
                    </div>
                    <div class="col-xl-2 float-end">
                        <button onclick="window.print()" class="btn btn-light text-capitalize border-0 d-print-none"
                            data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</button>
                        {{-- <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                                class="far fa-file-pdf text-danger"></i> Export</a> --}}
                    </div>
                    <hr>
                </div>

                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                            <p class="pt-0">INSAN MUTTAQIN ISLAMIC SCHOOL</p>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">To: <span
                                        style="color:#5d9fc5 ;">{{ $singlerow->siswa->nama }}</span></li>
                                <li class="text-muted"> Street :&nbsp;
                                    {{ $singlerow->siswa->alamat != null ? $singlerow->siswa->alamat : '' }}</li>
                                <li class="text-muted">Indonesia</li>
                                <li class="text-muted"><i class="fas fa-phone"></i>
                                    {{ $singlerow->siswa->no_hp != null ? $singlerow->siswa->no_hp : '' }}</li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">ID:</span>{{ $result->invoice }}</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">Creation Date:
                                    </span>{{ Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
                                </li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="me-1 fw-bold">Status:</span><span
                                        class="badge bg-warning text-black fw-bold">
                                        {{ $singlerow->status }}</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Transaksi</th>

                                    <th scope="col">Jenis Biaya</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Status</th>
                                    @if ($singlerow->status == 'UNPAID')
                                        <th scope="col">Delete</th>
                                    @else
                                        <th scope="col"></th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    
                                    // $tax = 0.11 * $total;
                                    
                                @endphp
                                @foreach ($data as $dt)
                                    @php
                                        
                                        $total += $dt->pembayarans->jumlah;
                                        
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $dt->pembayarans->id_transaksi }}</td>
                                        <td>{{ $dt->pembayarans->jenis_biaya }}</td>
                                        <td>@currency($dt->pembayarans->jumlah)</td>
                                        <td>{{ $dt->status }}</td>
                                        @if ($singlerow->status == 'UNPAID')
                                            <td><a href="{{ url('/delete-checkout' . $dt->id) }}"
                                                    class="btn btn-danger btn-sm">
                                                    Hapus</a></td>
                                        @else
                                            <th scope="col"></th>
                                        @endif

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        {{-- <div class="col-xl-8">
                            <p class="ms-3">Add additional notes and payment information</p>

                        </div> --}}
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                {{-- <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>@currency($total)
                                </li> --}}
                                @php
                                    $tax = 0.11 * $total;
                                    $final = $tax + $total;
                                @endphp
                                {{-- <li class="text-muted ms-3 mt-2"><span
                                        class="text-black me-4">Tax(11%)</span>@currency($tax)</li> --}}
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> Total Biaya</span><span
                                    style="font-size: 20px;">@currency($total)</span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-10">
                            <p>Terimakasih</p>
                        </div>
                        <div class="col-xl-2">
                            @if ($singlerow->status == 'UNPAID')
                                <button id="pay-button" class="btn btn-primary text-capitalize"
                                    style="background-color:#60bdf3 ;">Bayar</button>
                            @else
                                <button id="pay-button" class="btn btn-secondary text-capitalize" disabled>Sudah di
                                    Bayar</button>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
