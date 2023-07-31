<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Siswa';
        $data = Siswa::all();

        return view('pages.siswa.index', ['title' => $title, 'data' => $data]);
    }

    public function printSiswa()
    {
        $title =  'Daftar Siswa';
        $data = Siswa::all();

        return view('pages.siswa.print', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Tambah Siswa';
        $kelas = Kelas::all();

        return view('pages.siswa.tambah', ['title' => $title, 'kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaRequest $request)
    {
        $username =  User::where('username', $request->nis)->count();
        if ($username == 0) {
            $user = new User();
            $user->nama    = $request->nama;
            $user->username = $request->nis;
            $user->email   = $request->email;
            $user->password = bcrypt($request->nis);
            $user->save();


            $siswa = new Siswa();
            $siswa->nis         = $request->nis;
            $siswa->nama        = $request->nama;
            $siswa->email       = $request->email;
            $siswa->jenis_kelas = $request->jenis_kelas;
            $siswa->tingkat_kelas = $request->kelas;
            $siswa->no_hp       = $request->no_hp;
            $siswa->user_id     = $user->id;
            $siswa->periode     = $request->periode;
            $siswa->save();

            return redirect('/daftar-siswa')->with('success', 'Siswa Berhasil ditambah...!');
        } else {
            return redirect('/daftar-siswa')->with('failed', 'Siswa Gagal ditambah...!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::where('user_id', $id)->first();
        $title = 'Profile ' . $data->nama;

        return view('pages.siswa.detail', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Siswa';
        $siswa = Siswa::where('id', $id)->first();
        $kelas = Kelas::all();

        return view('pages.siswa.edit', ['title' => $title, 'siswa' => $siswa, 'kelas' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        $username =  User::where('username', $request->nis)->count();
        // dd($username);
        if ($request->nis == $siswa->nis || $username == 0) {
            $siswa->nis         = $request->nis;
            $siswa->nama        = $request->nama;
            $siswa->email       = $request->email;
            $siswa->jenis_kelas = $request->jenis_kelas;
            $siswa->tingkat_kelas = $request->kelas;
            $siswa->no_hp       = $request->no_hp;
            $siswa->periode     = $request->periode;
            $siswa->update();

            $user = User::where('id', $siswa->user_id)->first();
            $user->nama        = $request->nama;
            $user->username    = $request->nis;
            $user->email       = $request->email;
            $user->password    = bcrypt($request->nis);
            $user->update();

            return redirect('/daftar-siswa')->with('success', 'Siswa berhasil diupdate...!');
        } else {
            return redirect('/daftar-siswa')->with('failed', 'Siswa Gagal diupdate (NIS Sudah terdaftar)');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::where('id', $id)->first();

        $user = User::where('id', $siswa->user_id)->first();
        $siswa->delete();
        $user->delete();

        return redirect('/daftar-siswa')->with('success', 'Siswa Berhasil dihapus..!');
    }
}
