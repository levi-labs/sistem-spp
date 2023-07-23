@extends('layout.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    @php
                        $id = auth()->user()->id;
                    @endphp
                    @if (auth()->user()->akses_user == 'siswa')
                        <form class="forms-sample" method="POST" action="{{ url('/update-profile-siswa/' . $id) }}"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">

                                <label for="exampleInputUsername1">NIS</label>
                                <input type="text" class="form-control" id="exampleInputUsername1"
                                    placeholder="No Induk Siswa" name="nis" value="{{ old('nis') ?? $data->nis }}"
                                    disabled>
                                @error('nis')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">

                                <label for="exampleInputUsername1">Jenis Kelas</label>
                                <input type="text" class="form-control" id="exampleInputUsername1"
                                    placeholder="No Induk Siswa" name="jenis_kelas"
                                    value="{{ old('jenis_kelas') ?? $data->jenis_kelas }}" disabled>
                                @error('jenis_kelas')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">

                                <label for="exampleInputUsername1">Periode</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="periode"
                                    name="periode" value="{{ old('periode') ?? $data->periode }}" disabled>
                                @error('periode')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Nama Lengkap" name="nama" value="{{ old('nama') ?? $data->nama }}">
                                @error('nama')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Handphone</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="0812345992"
                                    name="no_hp" value="{{ old('no_hp') ?? $data->no_hp }}">
                                @error('no_hp')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="example@gmail.com" name="email"
                                    value="{{ old('email') ?? $data->email }}">
                                @error('email')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="jakarta"
                                    name="tempat_lahir" value="{{ old('tempat_lahir') ?? $data->tempat_lahir }}">
                                @error('tempat_lahir')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') ?? $data->tanggal_lahir }}">
                                @error('tanggal_lahir')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" placeholder="Sutrisno"
                                    name="nama_ayah" value="{{ old('nama_ayah') ?? $data->nama_ayah }}">
                                @error('tempat_lahir')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu"
                                    placeholder="example@gmail.com" name="nama_ibu"
                                    value="{{ old('nama_ibu') ?? $data->nama_ibu }}">
                                @error('nama_ibu')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Alamat</label>
                                <textarea class="form-control h-25" id="exampleFormControlTextarea1" rows="10" name="alamat">{{ $data->alamat }}</textarea>
                                @error('alamat')
                                    <div class="error">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="form-label">Foto</label>
                                <input class="form-control" type="file" name="foto" value="Upload Publication">
                                <span class="text-sm">{{ $data->avatar }}</span>>
                            </div>
                        @elseif(auth()->user()->akses_user == 'bendahara')
                            <form class="forms-sample" method="POST"
                                action="{{ url('/update-profile-bendahara/' . $id) }}" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="form-group">

                                    <label for="exampleInputUsername1">NIP</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="No Induk Siswa" name="nip"
                                        value="{{ old('nip') ?? $data->nip }}" disabled>
                                    @error('nip')
                                        <div class="error">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Nama Lengkap" name="nama"
                                        value="{{ old('nama') ?? $data->nama }}">
                                    @error('nama')
                                        <div class="error">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No Handphone</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="0812345992" name="no_hp"
                                        value="{{ old('no_hp') ?? $data->no_hp }}">
                                    @error('no_hp')
                                        <div class="error">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="example@gmail.com" name="email"
                                        value="{{ old('email') ?? $data->email }}">
                                    @error('email')
                                        <div class="error">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jabatan</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="jabatan" name="jabatan"
                                        value="{{ old('jabatan') ?? $data->jabatan }}">
                                    @error('jabatan')
                                        <div class="error">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto</label>
                                    <input class="form-control" type="file" name="foto"
                                        value="Upload Publication"> <span class="text-sm">{{ $data->avatar }}</span>>
                                </div>
                    @endif


                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('/profile') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
