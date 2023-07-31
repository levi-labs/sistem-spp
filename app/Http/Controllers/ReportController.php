<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        $title  = 'Halaman Report Semua Pembayaran';
        $dari   = $request->dari ;
        $sampai = $request->sampai;

        //    $data = Transaksi::all();
        //    foreach ($data as $value) {
        //     $x = Carbon::parse( $value->tanggal)->isoFormat('Y-MM-DD');
                   
        //    }
       $x =  Carbon::parse( $request->dari)->isoFormat('D MMMM Y');
       $z =  Carbon::parse( $request->sampai)->isoFormat('D MMMM Y');


            if (isset($dari) && isset($sampai)) {
               $data = Transaksi::where('tanggal', '>=', $dari)
                ->where('tanggal', '<=', $sampai)
                ->get();
                // dd($data);
                
             return view('pages.report.index', ['title' => $title, 'data' => $data,]);
              
                
            }else{
                $data = Transaksi::all();
                      return view('pages.report.index', ['title' => $title, 'data' => $data,]);
            }
    }

    public function belumBayar(Request $request){
        $title  = 'Halaman Report Belum Bayar';
        $dari   = $request->dari ;
        $sampai = $request->sampai;
     


            if (isset($dari) && isset($sampai)) {
               $data = Transaksi::where('tanggal', '>=', $dari)
                ->where('tanggal', '<=', $sampai)
                ->where('status', 'UNPAID')
                ->get();
                // dd($data);
                
             return view('pages.report.belumbayar', ['title' => $title, 'data' => $data,]);
              
                
            }else{
                $data = Transaksi::where('status', 'UNPAID  ')->get();
                      return view('pages.report.belumbayar', ['title' => $title, 'data' => $data,]);
            }
    }
    public function sudahDibayar(Request $request){
         $title  = 'Halaman Report Sudah Bayar';
        $dari   = $request->dari ;
        $sampai = $request->sampai;
     


            if (isset($dari) && isset($sampai)) {
               $data = Transaksi::where('tanggal', '>=', $dari)
                ->where('tanggal', '<=', $sampai)
                ->where('status', 'PAID')
                ->get();
                // dd($data);
                
             return view('pages.report.sudahbayar', ['title' => $title, 'data' => $data,]);
              
                
            }else{
                $data = Transaksi::where('status', 'PAID')->get();
                      return view('pages.report.sudahbayar', ['title' => $title, 'data' => $data,]);
            }
    }

    public function historyAll(Request $request){
         $title  = 'Halaman History Semua Pembayaran';
        $dari   = $request->dari ;
        $sampai = $request->sampai;


            if (isset($dari) && isset($sampai)) {
               $data = Transaksi::where('tanggal', '>=', $dari)
                ->where('tanggal', '<=', $sampai)
                ->where('siswa_id', auth()->user()->siswas->id)
                ->get();
                // dd($data);
                
             return view('pages.history.index', ['title' => $title, 'data' => $data,]);
              
                
            }else{
                $data = Transaksi::where('siswa_id', auth()->user()->siswas->id)->get();
                      return view('pages.history.index', ['title' => $title, 'data' => $data,]);
            }
    }
     public function historyBelum(Request $request){
         $title  = 'Halaman History Belum diBayar';
        $dari   = $request->dari ;
        $sampai = $request->sampai;


            if (isset($dari) && isset($sampai)) {
               $data = Transaksi::where('tanggal', '>=', $dari)
                ->where('tanggal', '<=', $sampai)
                ->where('status', 'UNPAID')
                ->where('siswa_id', auth()->user()->siswas->id)
                ->get();
                // dd($data);
                
             return view('pages.history.belumbayar', ['title' => $title, 'data' => $data,]);
              
                
            }else{
                $data = Transaksi::where('siswa_id', auth()->user()->siswas->id)->where('status', 'UNPAID')->get();
                      return view('pages.history.belumbayar', ['title' => $title, 'data' => $data,]);
            }
    }
    public function historySudah(Request $request){
         $title  = 'Halaman History Sudah diBayar';
        $dari   = $request->dari ;
        $sampai = $request->sampai;
            if (isset($dari) && isset($sampai)) {
               $data = Transaksi::where('tanggal', '>=', $dari)
                ->where('tanggal', '<=', $sampai)
                ->where('status', 'PAID')
                ->where('siswa_id', auth()->user()->siswas->id)
                ->get();
                // dd($data);
                
             return view('pages.history.sudahbayar', ['title' => $title, 'data' => $data,]);
              
                
            }else{
                $data = Transaksi::where('siswa_id', auth()->user()->siswas->id)->where('status', 'PAID')->get();
                      return view('pages.history.sudahbayar', ['title' => $title, 'data' => $data,]);
            }
    }
}
