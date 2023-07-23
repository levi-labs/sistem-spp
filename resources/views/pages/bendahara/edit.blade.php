@extends('layout.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>

                    <form class="forms-sample" action="{{ url('/update-siswa/' . $siswa->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">NIS</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" name="nis"
                                placeholder="No Induk Siswa" value="{{ old('nis') ?? $siswa->nis }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap"
                                name="nama" value="{{ old('nama') ?? $siswa->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelas</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                name="jenis_kelas">
                                <option selected>Pilih Kelas</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->nama_kelas }}"
                                        {{ $kls->nama_kelas == $siswa->jenis_kelas ? 'selected' : '' }}>
                                        {{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">No Handphone</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="0812345992"
                                name="no_hp" value="{{ old('no_hp') ?? $siswa->no_hp }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                placeholder="example@gmail.com" value="{{ old('email') ?? $siswa->email }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" placeholder="19/03/1980"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir') ?? $siswa->tanggal_lahir }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Periode</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="2015"
                                name="periode" value="{{ old('periode') ?? $siswa->periode }}">
                        </div>
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
                        <a href="{{ url('/daftar-siswa') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
