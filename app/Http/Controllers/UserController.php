<?php

namespace App\Http\Controllers;

use App\Models\Bendahara;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'User Management';

        switch (auth()->user()->akses_user) {
            case 'bendahara':
                $data   = User::where('akses_user', 'siswa')->get();
                return view('pages.users.index', ['data' => $data, 'title' => $title])->with('success', 'User Berhasil ditambahkan...!');
                break;
            
            case 'master':
                $data = User::all();
                return view('pages.users.index', ['data' => $data, 'title' => $title])->with('success', 'User Berhasil ditambahkan...!');
                break;
        }

        // return view('')
    }

    public function resetPassword($id){

        try {
            $pass           = User::where('id', $id)->first();
            // dd($pass);
            $pass->password = bcrypt($pass->username);
            $pass->update();

            return redirect('/daftar-users')->with('success' ,'User Password Berhasil direset...!');
        } catch (\Exception $e) {
           return redirect('/daftar-users')->with('failed' ,$e->getMessage());
        }
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
              $user =  User::where('id', $id)->first();
            if ($user->akses_user == 'siswa') {
                $user->delete();
                $siswa = Siswa::where('user_id', $id)->first();
                $siswa->delete();

                return redirect('/daftar-users')->with('success', 'User SISWA berhasil dihapus...!');
            }elseif($user->akses_user == 'bendahara'){
                $user->delete();
                $bendahara = Bendahara::where('user_id', $id)->first();
                $bendahara->delete();

                return redirect('/daftar-users')->with('success', 'User BENDAHARA berhasil dihapus...!');
            }   
        } catch (\Exception $e) {
           return back()->with('failed', $e->getMessage());
        }
      

    }
}
