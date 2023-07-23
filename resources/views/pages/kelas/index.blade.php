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

                <a href="{{ url('/tambah-kelas') }}" class="btn btn-primary btn-sm ">
                    <span class="mdi mdi-plus-thick"></span>&nbsp;Tambah</a>
                {{-- <button class="btn btn-secondary btn-sm"><span class="mdi mdi-printer-outline"></span>&nbsp;Print</button> --}}
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Kelas</th>
                                <th class="text-center">Harga Kelas</th>
                                <th class="text-center">Option</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $dt)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $dt->nama_kelas }}</td>
                                    <td class="text-center"> @currency($dt->harga)</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm" href="{{ url('/edit-kelas/' . $dt->id) }}"><span
                                                class="mdi mdi-pencil"></span>&nbsp;Edit</a>
                                        <a class="btn btn-danger btn-sm" href="{{ url('/delete-kelas/' . $dt->id) }}"
                                            onClick="return confirm('yakin ingin menghapus ini?')"><span
                                                class="mdi mdi-delete-empty"></span>&nbsp;Hapus</a>
                                    </td>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
