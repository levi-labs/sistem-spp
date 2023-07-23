<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        $title  = 'Halaman Report';
        $dari   = $request->dari;
        $sampai = $request->sampai;
        try {
            if (isset($dari) && isset($sampai)) {
                // $data =  DB::table('checkout')
                //     ->join('transaksi', 'checkout.id_transaksi', '=', 'transaksi.id')
                //     ->join('siswa', 'checkout.siswa_id', '=', 'siswa.id')
                //     ->select('siswa.nama', 'checkout.invoice', 'transaksi.id_transaksi', 'checkout.status', 'transaksi.jumlah', 'checkout.status', 'checkout.created_at')
                //     ->where('created_at', '>=', $dari)
                //     ->where('created_at', '<=', $sampai)
                //     ->get();

                $data = CheckOut::where('created_at', '>=', $dari)
                    ->where('created_at', '<=', $sampai)
                    ->get();

                if ($data->count() > 0) {
                    $result = 'Data ditemukan';
                    return view('pages.report', ['title' => $title, 'data' => $data, 'result' => $result]);
                } else {
                    $result = 'Data Tidak Ditemukan';
                    return view('pages.report', ['title' => $title, 'data' => $data, 'result' => $result]);
                }
            }


            return view('pages.report', ['title' => $title],);
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }
}
