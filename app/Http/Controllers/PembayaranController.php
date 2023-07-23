<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Daftar Belum Terbayar Siswa';


        // if (auth()->user()->akses_user == 'siswa') {

        //     $id    = auth()->user()->siswas->id;
        //     $search =  $request->search;
        //     if ($request->has('search')) {
        //         $data = Transaksi::where('nis')
        //     }else{
        //          $data = Transaksi::where('siswa_id', $id)->where('status', 'UNPAID')->get();
        //     }

        // }

        switch (auth()->user()->akses_user) {
            case 'siswa':
                $id    = auth()->user()->siswas->id;
                $data = Transaksi::where('siswa_id', $id)->where('status', 'UNPAID')->get();


                return view('pages.pembayaran.index', ['title' => $title, 'data' => $data]);
                break;

            case 'bendahara':
                //  $data = Transaksi::where('user_id', $id)->where('jabatan', 'siswa')->get();

                $data = Transaksi::where('status', 'unpaid')->get();
                return view('pages.pembayaran.index', ['title' => $title, 'data' => $data]);
                break;
        }
    }

    public function index2()
    {
        $title = 'Daftar Sudah Terbayar Siswa';

        switch (auth()->user()->akses_user) {
            case 'siswa':
                $id    = auth()->user()->siswas->id;
                $data = CheckOut::where('siswa_id', $id)->where('status', 'PAID')->get();

                return view('pages.pembayaran.index2', ['title' => $title, 'data' => $data]);
                break;

            case 'bendahara':
                // $data = Transaksi::where('user_id', $id)->get();
                $data = CheckOut::where('status', 'paid')->get();
                return view('pages.pembayaran.index2', ['title' => $title, 'data' => $data]);
                break;
        }
    }

    public function pageInvoice($invoice)
    {
        $title = 'Halaman Print Invoice';
        $data = CheckOut::where('invoice', $invoice)->get();
        return view('pages.printInvoice', ['title' => $title, 'data' => $data]);
    }

    public function cekInvoice(Request $request)
    {

        $title = 'Halaman Cek Invoice';
        $invoice = $request->invoice;




        // $data =  DB::table('checkout')
        //     ->join('transaksi', 'checkout.id_transaksi AS', '=', 'transaksi.id')
        //     ->join('siswa', 'checkout.siswa_id', '=', 'siswa.id')
        //     ->select('siswa.nama', 'checkout.invoice', 'transaksi.id_transaksi', 'checkout.status', 'transaksi.jumlah', 'checkout.status')
        //     ->where('invoice', 'like', '%' . $invoice . '%')
        //     ->orWhere('id_transaksi', 'like', '%' . $invoice . '%')
        //     ->get();

        $data = CheckOut::where('invoice', 'like', '%' . $invoice . '%')->get();
        if ($data->count() > 0) {
            $result = 'Data ditemukan';
            return view('pages.cekinvoice', ['title' => $title, 'data' => $data, 'invoice' => $invoice, 'result' => $result]);
        } else {
            $result = 'Data Tidak Ditemukan';
            return view('pages.cekinvoice', ['title' => $title, 'invoice' => $invoice, 'data' => $data, 'result' => $result]);
        }

        return view('pages.cekinvoice', ['title' => $title, 'invoice' => $invoice]);

        //     $book = Book::latest() 
        // ->leftjoin('subjects', 'books.id', '=', 'subjects.book_id') 
        // ->select('books.*', 'subjects.subject')
        // ->where('subject', 'like', '%' .$search. '%')
        // ->paginate(20);
    }


    public function cartPembayaran()
    {
        $id =  auth()->user()->siswas->id;

        $counttotal = CheckOut::where('siswa_id', $id)->where('status', 'unpaid')->get();
        $result = CheckOut::where('siswa_id', $id)->where('status', 'unpaid')->first();

        $data = CheckOut::where('siswa_id', $id)->where('status', 'unpaid')->get();
        $total = 0;
        foreach ($counttotal as $value) {
            $checkTransaksi = Transaksi::where('id', $value->id_transaksi)->first();
            $total += $checkTransaksi->jumlah;
            continue;
        }
        // dd($total);
        $datenow = time();
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = false;


        $params = array(
            'transaction_details' => array(
                'order_id' =>  $result->invoice,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $result->siswas->nama,

                'email' => $result->siswas->email,
                'phone' => $result->siswas->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);


        return view('pages.pembayaran.cart', ['data' => $data, 'result' => $result, 'snapToken' => $snapToken]);
    }
    public function tambahPembayaran(Request $request, $id)
    {
        try {
            $check = CheckOut::where('id_transaksi', $id)->get();


            $res = Transaksi::where('id', $id)->where('status', 'unpaid')->get();
            //    dd($res);
            foreach ($res as $c) {
                $siswa_id =  $c->siswa_id;
            }

            $total = 0;
            $datenow = date('dmYhi');
            // dd($datenow);
            if ($check->count() == 0) {
                // dd($check);
                $invoice = 'INV-' . '62' . $siswa_id . '-' . $datenow;
                $coupdate =  CheckOut::where('siswa_id', $siswa_id)->where('status', 'unpaid')->get();
                // dd($coupdate);
                $co = new CheckOut();
                $co->invoice = $invoice;
                $co->tanggal = Carbon::now()->isoFormat('D MMMM Y');
                $co->status = 'UNPAID';
                $co->siswa_id = $siswa_id;
                $co->id_transaksi = $id;
                $co->save();

                if ($coupdate->count() > 0) {
                    foreach ($coupdate as $value) {
                        $value->invoice = $invoice;
                        $value->update();
                        continue;
                    }
                }
            }
            return back()->with('success', 'Berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    public function detailPembayaran($siswa_id)
    {
        $res = Transaksi::where('siswa_id', $siswa_id)->where('status', 'unpaid')->get();
        $singlerow = Transaksi::where('siswa_id', $siswa_id)->where('status', 'UNPAID')->first();

        $total = 0;
        $datenow = time();
        //   dd($data);
        foreach ($res as $key => $value) {
            $co_count =  CheckOut::where('id_transaksi', $value->id)->count();
            $invoice = '62' . $siswa_id . '-' . $datenow;
            $total += $value->jumlah;
            if ($co_count == 0) {
                $co = new CheckOut();
                $co->invoice = $invoice;
                $co->tanggal =  $now = Carbon::now()->isoFormat('D MMMM Y');
                $co->status = 'UNPAID';
                $co->siswa_id = $siswa_id;
                $co->id_transaksi = $value->id;
                $co->save();
                continue;
            }
        }
        $result = CheckOut::where('siswa_id', $siswa_id)->where('status', 'UNPAID')->first();
        $result2 = CheckOut::where('siswa_id', $siswa_id)->where('status', 'UNPAID')->count();

        $data = CheckOut::where('siswa_id', $siswa_id)->where('status', 'UNPAID')->get();

        if ($result2 > 0) {

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = false;


            $params = array(
                'transaction_details' => array(
                    'order_id' =>  $result->invoice,
                    'gross_amount' => $total,
                ),
                'customer_details' => array(
                    'first_name' => $singlerow->siswa->nama,

                    'email' => $singlerow->siswa->email,
                    'phone' => $singlerow->siswa->no_hp,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return $snapToken;

            // return view('pages.pembayaran.detail',['data'=>$data, 'result'=>$result, 'singlerow' => $singlerow, 'snapToken' => $snapToken]);
        }
        // }else{
        //         $data = Transaksi::where('siswa_id', $siswa_id)->where('status', 'PAID')->get();
        //     $result = CheckOut::where('siswa_id', $siswa_id)->where('status', 'PAID')->first();
        //         $singlerow = Transaksi::where('siswa_id', $siswa_id)->where('status','PAID')->first();
        //     return view('pages.pembayaran.detail',['data'=>$data, 'result'=>$result, 'singlerow' => $singlerow, 'snapToken' => '']);
        // }
        // Set your Merchant Server Key
    }
    public function sudahDibayar($siswa_id, $invoice)
    {
        $title = "Sudah di Bayar";
        $result = CheckOut::where('siswa_id', $siswa_id)->where('status', 'PAID')->first();
        $data = CheckOut::where('siswa_id', $siswa_id)->where('invoice', $invoice)->where('status', 'PAID')->get();
        $singlerow = Transaksi::where('siswa_id', $siswa_id)->where('status', 'PAID')->first();
        // foreach ($result2 as $value) {
        //     $data = CheckOut::where('invoice', $value->invoice)->get();
        //     dd($data);
        // }
        return view('pages.pembayaran.detail2', ['data' => $data, 'result' => $result, 'singlerow' => $singlerow, 'snapToken' => '']);
    }

    public function callbackCheckout(Request $request)
    {
        $json = json_decode($request);
        try {
            $serverKey = config('midtrans.server_key');
            $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
            // dd($hashed );

            if ($hashed == $request->signature_key) {

                if ($request->transaction_status == 'settlement') {
                    $co = CheckOut::where('invoice', $request->order_id)->where('status', 'unpaid')->get();

                    // dd($co);
                    foreach ($co as $value) {
                        $value->status = "PAID";
                        // $value->metode_pembayaran =  $request->payment_type .'-'. $json->va_numbers->bank;
                        $value->update();

                        $trans = Transaksi::where('siswa_id', $value->siswa_id)->where('id', $value->id_transaksi)->where('status', 'UNPAID')->get();
                        foreach ($trans as $value2) {
                            $value2->status = 'PAID';
                            $value2->update();
                            continue;
                        }
                        continue;
                    }
                }
            }
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }
    public function printCart($invoice)
    {
        $result = CheckOut::where('siswa_id', auth()->user()->siswas->id)->where('status', 'UNPAID')->first();
        $data = CheckOut::where('invoice', $invoice)->get();
        return view('pages.pembayaran.printcart', ['data' => $data, 'result' => $result]);
    }

    public function printUnpaid()
    {
        $title = 'Daftar Belum Terbayar Siswa';

        // $products = Transaksi::whereHas('siswa', function ($query) use($nis) {
        // $query->where('nis', $nis);
        // })->get();  

        switch (auth()->user()->akses_user) {
            case 'siswa':
                $id    = auth()->user()->siswas->id;

                $data = Transaksi::where('siswa_id', $id)->where('status', 'UNPAID')->get();
                $total = Transaksi::where('status', 'unpaid')->where('siswa_id', $id)->sum('jumlah');
                return view('pages.pembayaran.indexprint', ['title' => $title, 'data' => $data, 'total' => $total]);
                break;

            case 'bendahara':
                //  $data = Transaksi::where('user_id', $id)->where('jabatan', 'siswa')->get();
                $id    = auth()->user()->bendaharas->id;
                $data = Transaksi::where('status', 'unpaid')->get();
                $total = Transaksi::where('status', 'unpaid')->sum('jumlah');
                return view('pages.pembayaran.indexprint', ['title' => $title, 'data' => $data, 'total' => $total]);
                break;
        }
    }

    public function printPaid()
    {
        $title = 'Daftar Sudah Terbayar Siswa';



        switch (auth()->user()->akses_user) {
            case 'siswa':
                $id    = auth()->user()->siswas->id;
                $data = Transaksi::where('siswa_id', $id)->where('status', 'PAID')->get();
                $total = Transaksi::where('status', 'paid')->where('siswa_id', $id)->sum('jumlah');

                return view('pages.pembayaran.index2print', ['title' => $title, 'data' => $data, 'total' => $total]);
                break;

            case 'bendahara':
                //  $data = Transaksi::where('user_id', $id)->where('jabatan', 'siswa')->get();
                $id    = auth()->user()->bendaharas->id;
                $data = Transaksi::where('status', 'paid')->get();
                $total = Transaksi::where('status', 'paid')->sum('jumlah');
                return view('pages.pembayaran.index2print', ['title' => $title, 'data' => $data, 'total' => $total]);
                break;
        }
    }




    public function deleteCheckout($id)
    {
        $siswa_id = auth()->user()->siswas->id;
        // $data =  CheckOut::where('id',$id)->first();
        $co = CheckOut::where('siswa_id', $siswa_id)->where('status', 'UNPAID')->get();
        // dd($siswa_id);

        if ($co->count() > 1) {
            CheckOut::where('id', $id)->delete();
            return back();
        } else {
            CheckOut::where('id', $id)->delete();
            return redirect('/daftar-belum-dibayar');
        }
    }

    public function detailInvoice($invoice)
    {
        $data = CheckOut::where('invoice', $invoice)->get();


        return view('pages.pembayaran.codetail', ['data' => $data]);
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
