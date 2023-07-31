<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Bendahara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (auth()->user()->akses_user == 'siswa') {

            $data = Siswa::where('user_id', $id)->first();
            $title = 'Profile ' . $data->nama;

            return view('pages.profile.index', ['title' => $title, 'data' => $data]);
        } elseif (auth()->user()->akses_user == 'bendahara') {

            $data = Bendahara::where('user_id', $id)->first();

            // dd($data);
            $title = 'Profile ' . $data->nama;

            return view('pages.profile.index', ['title' => $title, 'data' => $data]);
        }
    }

    public function getProfileFrom($id)
    {

        $data = Siswa::where('user_id', $id)->first();
        $title = 'Profile ' . $data->nama;

        return view('pages.profile.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title =  'Edit Profile';
        if (auth()->user()->akses_user == 'siswa') {
            $data =  Siswa::where('user_id', $id)->first();
            return view('pages.profile.edit', ['title' => $title, 'data' => $data]);
        } elseif (auth()->user()->akses_user == 'bendahara') {
            $data = Bendahara::where('user_id', $id)->first();
            // dd($data);
            return view('pages.profile.edit', ['title' => $title, 'data' => $data]);
        }


        // if ($data->akses_user == 'siswa') {
        //     # code...
        // }

        // return view('pages.profile.edit', ['title' => $title, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfileSiswa(Request $request, $id)
    {
        try {
            $siswa = Siswa::where('user_id', $id)->first();
            $siswa->nama            = $request->nama;
            $siswa->no_hp           = $request->no_hp;
            $siswa->email           = $request->email;
            $siswa->tempat_lahir    = $request->tempat_lahir;
            $siswa->tanggal_lahir   = $request->tanggal_lahir;
            $siswa->nama_ayah       = $request->nama_ayah;
            $siswa->nama_ibu        = $request->nama_ibu;
            $siswa->alamat          = $request->alamat;

            $imgFoto = $request->file('foto');

            if ($imgFoto) {
                if ($siswa->avatar != null) {
                    \Storage::delete($siswa->avatar);
                }

                $filName = $request->nama . ' ' . $imgFoto->getClientOriginalName();
                $path = $imgFoto->storeAs('images', $filName);
            } else {
                $path = $siswa->avatar;
            }
            $siswa->avatar = $path;
            $siswa->update();

            $user = User::where('id', $id)->first();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->update();
            $siswa->update();

            return redirect('/profile/' . $id)->with('success', 'Profile Berhasil diupdate...!');
        } catch (\Exception $e) {
            return redirect('/profile/' . $id)->with('failed', $e->getMessage());
        }
    }

    public function updateProfileBendahara(Request $request, $id)
    {
        try {
            $bendahara = Bendahara::where('user_id', $id)->first();

            $bendahara->nama            = $request->nama;
            $bendahara->no_hp           = $request->no_hp;
            $bendahara->email           = $request->email;
            $bendahara->jabatan         = $request->jabatan;

            $imgFoto = $request->file('foto');

            if ($imgFoto) {
                if ($bendahara->avatar != null) {
                    \Storage::delete($bendahara->avatar);
                }

                $filName = $request->nama . ' ' . $imgFoto->getClientOriginalName();
                $path = $imgFoto->storeAs('images', $filName);
            } else {
                $path = $bendahara->avatar;
            }
            // if ($imgFoto) {
            // $fileName = $request->nama . '' . $imgFoto->getClientOriginalName();
            // $path = $imgFoto->storeAs('images/', $fileName);
            // } else {
            // $path = null;
            // }
            $bendahara->avatar = $path;



            $user = User::where('id', $id)->first();
            $user->nama     = $request->nama;
            $user->email    = $request->email;
            $user->update();
            $bendahara->update();
            return redirect('/profile/' . $id)->with('success', 'Profile Berhasil diupdate...!');
        } catch (\Exception $e) {
            return redirect('/profile/' . $id)->with('failed', $e->getMessage());
        }
    }

    public function editPassword()
    {
        $title = 'Halaman ubah password';


        return view('pages.profile.changepassword', ['title' => $title]);
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' =>  ['required', 'confirmed']
        ]);

        $currentpass = auth()->user()->password;
        $oldpass = $request->old_password;

        if (Hash::check($oldpass, $currentpass)) {
            $user = User::where('id', $id)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/profile/'.$id)->with('success', 'password berhasil di ubah');
        } else {
            return back()->withErrors(['old_password' => 'Password Sebelumnya Tidak Cocok..!']);
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
        //
    }
}
