@extends('layout.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
                @php
                    $id = auth()->user()->id;
                @endphp
                @if (auth()->user()->id == $data->user_id)
                    @if (auth()->user()->akses_user == 'siswa' || auth()->user()->akses_user == 'bendahara')
                        <a href="{{ url('/edit-profile/' . $id) }}" class="btn btn-primary btn-sm ">
                            <span class="mdi mdi-plus-thick"></span>&nbsp;Edit Profile</a>
                    @endif

                    <a href="{{ url('/change-password') }}" class="btn btn-secondary btn-sm ">
                        <span class="mdi mdi-lock"></span>&nbsp;Change Password</a>
                @endif


                <div class="row g-0">
                    <div class="col-md-4 gradient-custom text-center text-white"
                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">

                        @if ($data->avatar == null)
                            <img src="{{ auth()->user()->avatar() }}" alt="Avatar" class="img-fluid my-5"
                                style="width: 150px;" />
                        @else
                            <img src="{{ $data->getAvatar() }}" alt="Avatar" class="img-fluid"
                                style="width: 250px;
                                    height: 350;" />
                        @endif

                        {{-- <img src="{{ $data->getAvatar() }}" alt="Avatar" style="width: 150px;" /> --}}
                        {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                            alt="Avatar" class="img-fluid my-5" style="width: 80px;" /> --}}
                        <h5 class="text-dark">{{ $data->nama }}</h5>

                        <p class="text-dark">Periode:&nbsp;{{ $data->periode }}</p>
                        <i class="far fa-edit mb-5"></i>


                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">

                            <h6>Nomor Induk SIswa : {{ $data->nis }}</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-3">
                                    <h6>Email</h6>
                                    <p class="text-muted">{{ $data->email }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6>Phone</h6>
                                    <p class="text-muted">{{ $data->no_hp }}</p>
                                </div>
                            </div>
                            {{-- <h6>Projects</h6> --}}
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-3">
                                    <h6>Kelas</h6>
                                    <p class="text-muted">{{ $data->jenis_kelas }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6>Alamat</h6>
                                    <p class="text-muted">{{ $data->alamat }}</p>
                                </div>
                            </div>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-3">
                                    <h6>Tempat Lahir</h6>
                                    <p class="text-muted">{{ $data->tempat_lahir }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6>Tanggal Lahir</h6>
                                    <p class="text-muted">{{ $data->tanggal_lahir }}</p>
                                </div>
                            </div>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-3">
                                    <h6>Nama Ayah</h6>
                                    <p class="text-muted">{{ $data->nama_ayah }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6>Nama Ibu</h6>
                                    <p class="text-muted">{{ $data->nama_ibu }}</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
