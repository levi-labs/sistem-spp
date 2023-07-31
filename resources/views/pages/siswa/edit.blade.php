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
                            @error('nis')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap"
                                name="nama" value="{{ old('nama') ?? $siswa->nama }}">
                            @error('nama')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
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
                            @error('jenis_kelas')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kelas</label>
                            <select class="form-select form-select-sm" aria-label="form-select-sm example" name="kelas">
                                <option selected disabled>Pilih</option>

                                <option {{ $siswa->tingkat_kelas == 1 ? 'selected' : '' }}>1</option>
                                <option {{ $siswa->tingkat_kelas == 2 ? 'selected' : '' }}>2</option>
                                <option {{ $siswa->tingkat_kelas == 3 ? 'selected' : '' }}>3</option>

                            </select>
                            @error('kelas')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">No Handphone</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="0812345992"
                                name="no_hp" value="{{ old('no_hp') ?? $siswa->no_hp }}">
                            @error('no_hp')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                placeholder="example@gmail.com" value="{{ old('email') ?? $siswa->email }}">
                            @error('email')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" placeholder="19/03/1980"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir') ?? $siswa->tanggal_lahir }}">
                            @error('tanggal_lahir')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Periode</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="2015"
                                name="periode" value="{{ old('periode') ?? $siswa->periode }}">
                            @error('periode')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/daftar-siswa') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
