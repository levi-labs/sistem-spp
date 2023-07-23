<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
            // $datenow = time();
            // $monthId = Carbon::now()->isoFormat('MMMM');
            // $month  = date('F', $datenow);
            // $date = date('j',$datenow);
            // $now = Carbon::now()->isoFormat('D MMMM Y');

            // if ($date == 4) {
            //         $siswa = Siswa::all();
            //         foreach ($siswa as $key => $value) {
            //             $query = Transaksi::where('tanggal', $now)->count();
            //             $ceksiswa = Transaksi::where('siswa_id', $value->id )->count();
                    
            //                  if ($query == 0 || $ceksiswa == 0  ) {
            //                      if ($kelas= Kelas::where('nama_kelas',$value->jenis_kelas)->first() ) {
            //                         $transaksi = new Transaksi();
            //                         $transaksi->siswa_id = $value->id;
            //                         $transaksi->id_transaksi = $transaksi->idTransaksi();
            //                         $transaksi->jenis_biaya = 'SPP- '.$kelas->nama_kelas;
            //                         $transaksi->jumlah      = $kelas->harga;
            //                         $transaksi->tanggal     = $now;
            //                         $transaksi->status      = 'UNPAID';
            //                         $transaksi->save();
            //                         continue;
            //                     }  
            //                 }
            //          }  
            // }
    }
}
