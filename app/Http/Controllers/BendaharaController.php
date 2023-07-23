<?php

namespace App\Http\Controllers;

use App\Http\Requests\BendaharaRequest;
use App\Models\Bendahara;
use App\Models\User;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Bendahara';
        $data  = Bendahara::all();
        return view('pages.bendahara.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Bendahara';

        return view('pages.bendahara.tambah', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BendaharaRequest $request)
    {
        try {
            $user           = new User();
            $user->nama     = $request->nama;
            $user->email    = $request->email;
            $user->username = $request->nip;
            $user->password = bcrypt($request->nip);
            $user->akses_user  =   'bendahara';
            $user->save();

            $data           =  new Bendahara();
            $data->nip      = $request->nip;
            $data->nama     = $request->nama;
            $data->user_id  = $user->id;
            $data->jabatan  = $request->jabatan;
            $data->email    = $request->email;
            $data->no_hp    = $request->no_hp;
            $data->save();

            return redirect('/daftar-bendahara')->with('success', 'Bendahara Berhasil ditambahkan...!');
        } catch (\Exception $e) {
            
            return redirect('/daftar-bendahara')->with('failed', $e->getMessage());
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
        $title = 'Edit Bendahara';
        $data = Bendahara::where('id', $id)->first();

        return view('pages.bendahara.edit', ['title' => $title, 'data' => $data]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BendaharaRequest $request, $id)
    {
        try {

            $data = Bendahara::where('id', $id)->first();
            $data->nama     =   $request->nama;
            $data->nip      =   $request->nip;
            $data->jabatan  =   $request->jabatan;
            $data->email    =   $request->email;
            $data->no_hp    =   $request->no_hp;
            $data->save();

            $user           =   User::where('id', $data->user_id)->first();
            $user->nama     =   $request->nama;
            $user->email    =   $request->email;
            $user->akses_user  =   'bendahara';
            $user->save();
            
            return redirect('/daftar-bendahara')->with('success', 'Bendahara berhasil diupdate..!');
        } catch (\Exception $e) {
            
            return redirect('/daftar-bendahara')->with('failed', $e->getMessage());
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
        $bendahara = Bendahara::where('id', $id)->first();
        $user = User::where('id', $bendahara->user_id)->first();
        $bendahara->delete();
        $user->delete();

        return back()->with('success', 'Bendahara berhasil dihapus...!');
    }
}
