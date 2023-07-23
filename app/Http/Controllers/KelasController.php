<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Kelas';

        $data = Kelas::all();

        return view('pages.kelas.index', ['title' => $title, 'data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Tambah Kelas';

        return view('pages.kelas.tambah', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $request)
    {
        try {
            $data = new Kelas();

            $data->nama_kelas = $request->nama_kelas;
            $data->harga      = $request->harga;
            $data->save();

            return redirect('/daftar-kelas')->with('success' ,'Kelas Berhasil di Tambah..!');
        } catch (\Exception $e) {
            return redirect('/daftar-kelas')->with('failed' ,$e);
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
        $title = 'Edit Kelas';
        $data = Kelas::where('id' ,$id)->first();

        return view('pages.kelas.edit', ['title' => $title, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KelasRequest $request, $id)
    {
        $data =  Kelas::where('id', $id)->first();
        $data->nama_kelas = $request->nama_kelas;
        $data->harga      = $request->harga;
        $data->update();

        return redirect('/daftar-kelas')->with('success', 'Kelas Berhasil di Update..!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::where('id', $id)->delete();

        return redirect('/daftar-kelas')->with('success', 'Kelas Berhasil dihapus...!');
    }
}
