@extends('layout.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>

                    <form class="forms-sample" method="POST" action="{{ url('/post-bendahara') }}" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">NIP</label>
                            <input type="text" class="form-control" id="exampleInputUsername1"
                                placeholder="No Induk Pegawai" name="nip">
                            @error('nip')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap"
                                name="nama">
                            @error('nama')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1">No Handphone</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="0812345992"
                                name="no_hp">
                            @error('no_hp')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                placeholder="example@gmail.com" name="email">
                            @error('email')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jabatan</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="jabatan"
                                name="jabatan">
                            @error('jabatan')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" placeholder="19/03/1980"
                                name="tanggal_lahir">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Periode</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" placeholder="2015"
                                name="periode">
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Confirm Password</label>
                            <input type="password" class="form-control" id="exampleInputConfirmPassword1"
                                placeholder="Password">
                        </div> --}}
                        {{-- <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Remember me
                                <i class="input-helper"></i></label>
                        </div> --}}
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/daftar-bendahara') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
