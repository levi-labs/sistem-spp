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
                @if (auth()->user()->akses_user == 'master')
                    <a href="{{ url('/tambah-bendahara') }}" class="btn btn-primary btn-sm ">
                        <span class="mdi mdi-plus-thick"></span>&nbsp;Tambah</a>
                @endif

                <button onclick="window.print()" class="btn btn-secondary btn-sm d-print-none"><span
                        class="mdi mdi-printer-outline "></span>&nbsp;Print</button>
                <div class="d-print-table table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama</th>

                                <th class="text-center">Jabatan</th>
                                <th class="text-center">No HP</th>
                                <th class="text-center">Email</th>
                                @if (auth()->user()->akses_user == 'master')
                                    <th class="text-center">Option</th>
                                @endif


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                                <tr>
                                    <td class="text-center">{{ $dt->nip }}</td>
                                    <td class="text-center">{{ $dt->nama }}</td>

                                    <td class="text-center">{{ $dt->jabatan }}</td>
                                    <td class="text-center">{{ $dt->no_hp }}</td>
                                    <td class="text-center">{{ $dt->email }}</td>
                                    <td class="text-center">
                                        {{-- <a class="btn btn-success btn-sm"
                                            href="{{ url('/detail-bendahara/' . $dt->id) }}"><span
                                                class="mdi mdi-pencil"></span>&nbsp;detail</a> --}}
                                        @if (auth()->user()->akses_user == 'master')
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('/edit-bendahara/' . $dt->id) }}"><span
                                                    class="mdi mdi-pencil"></span>&nbsp;Edit</a>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('/delete-bendahara/' . $dt->id) }}"
                                                onClick="return confirm('yakin ingin menghapus ini?')"><span
                                                    class="mdi mdi-delete-empty"></span>&nbsp;Hapus</a>
                                        @endif

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
