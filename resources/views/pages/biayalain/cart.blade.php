@extends('layout.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">

                    </p>
                    <form class="forms-sample" action="{{ url('/store-biaya-siswa/' . $biaya->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Nama Biaya</label>
                            <input type="text" class="form-control" id="namakelas" placeholder="Nama Biaya"
                                name="nama_biaya" disabled value="{{ old('nama_biaya') ?? $biaya->nama_biaya }}">
                            @error('nama_biaya')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="siswa-id">Nama Siswa</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="siswa_id">
                                <option selected>Pilih Siswa</option>
                                @foreach ($siswa as $sw)
                                    <option value="{{ $sw->id }}">{{ $sw->nama }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/daftar-biaya-lain') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
