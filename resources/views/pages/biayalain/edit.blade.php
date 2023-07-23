@extends('layout.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">

                    </p>
                    <form class="forms-sample" action="{{ url('/update-biaya-lain/' . $data->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Nama Kelas</label>
                            <input type="text" class="form-control" id="namakelas" placeholder="Nama Kelas"
                                value="{{ old('nama_biaya') ?? $data->nama_biaya }}" name="nama_biaya">
                            @error('nama_biaya')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="number" min='0' class="form-control" id="harga" name="harga"
                                placeholder="1.600.000" value="{{ old('harga') ?? $data->harga }}">
                            @error('harga')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/daftar-kelas') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
