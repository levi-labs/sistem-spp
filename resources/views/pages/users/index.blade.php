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
                {{-- 
                <a href="{{ url('/tambah-siswa') }}" class="btn btn-primary btn-sm ">
                    <span class="mdi mdi-plus-thick"></span>&nbsp;Tambah</a> --}}
                {{-- <a href="{{ url('/print-siswa') }}" target="_blank" class="btn btn-secondary btn-sm"><span
                        class="mdi mdi-printer-outline"></span>&nbsp;Print</a> --}}
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Username</th>
                                <th class="text-center">Nama</th>

                                <th class="text-center">Akses User</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Option</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dt)
                                <tr>

                                    <td class="text-center">{{ $dt->username }}</td>
                                    <td class="text-center">{{ $dt->nama }}</td>

                                    <td class="text-center">{{ $dt->akses_user }}</td>
                                    <td class="text-center">{{ $dt->email }}</td>
                                    <td class="text-center">
                                        {{-- <a class="btn btn-success btn-sm" href="{{ url('/profile/' . $dt->user_id) }}"><span
                                                class="mdi mdi-pencil"></span>&nbsp;detail</a> --}}
                                        {{-- <a class="btn btn-warning btn-sm" href="{{ url('/edit-siswa/' . $dt->id) }}"><span
                                                class="mdi mdi-pencil"></span>&nbsp;Edit</a> --}}
                                        <a class="btn btn-success btn-sm"
                                            href="{{ url('/reset-password-user/' . $dt->id) }}"
                                            onClick="return confirm('yakin ingin mereset user ini?')"><span
                                                class="mdi mdi-refresh"></span>&nbsp;Reset Password</a>
                                        <a class="btn btn-danger btn-sm" href="{{ url('/delete-siswa/' . $dt->id) }}"
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
