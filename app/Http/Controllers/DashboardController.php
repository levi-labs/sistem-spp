<?php

namespace App\Http\Controllers;

use App\Models\Bendahara;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // public function __construct()
    // {
    //     $datenow = time();
    //     $monthId = Carbon::now()->isoFormat('MMMM');
    //     $month  = date('F', $datenow);
    //     $date = date('j',$datenow);
    //     $now = Carbon::now()->isoFormat('D MMMM Y');

    //     if ($date == 4) {
    //             $siswa = Siswa::all();
    //             foreach ($siswa as $key => $value) {
    //                 $query = Transaksi::where('tanggal', $now)->count();
    //                 $ceksiswa = Transaksi::where('siswa_id', $value->id )->count();
    //                 // dd($ceksiswa);
    //                      if ($query == 0 || $ceksiswa == 0  ) {
    //                          if ($kelas= Kelas::where('nama_kelas',$value->jenis_kelas)->first() ) {
    //                             $transaksi = new Transaksi();
    //                             $transaksi->siswa_id = $value->id;
    //                             $transaksi->id_transaksi = $transaksi->idTransaksi();
    //                             $transaksi->jenis_biaya = 'SPP- '.$kelas->nama_kelas;
    //                             $transaksi->jumlah      = $kelas->harga;
    //                             $transaksi->tanggal     = $now;
    //                             $transaksi->status      = 'UNPAID';
    //                             $transaksi->save();
    //                             continue;
    //                         }
                           
    //                     }
         
    //              }       
           
    //     }
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dashboard';
        $siswa = Siswa::count();
        $bendahara = Bendahara::count();
        $kelas = Kelas::count();
        $users = User::count();

        return view('pages.dashboard.index', ['title' => $title, 'siswa'=> $siswa, 'bendahara' => $bendahara, 'kelas'=> $kelas, 'users' => $users]);
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
        //
    }
}
