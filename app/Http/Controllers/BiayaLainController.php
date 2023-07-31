<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\BiayaLain;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Requests\BiayaLainRequest;

class BiayaLainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title ='Daftar Biaya Lain';
        $data = BiayaLain::all();

        return view('pages.biayalain.index', ['title' => $title , 'data' =>$data]);
    }

    public function storeAllSiswa(Request $request,$id){
        try {
            
             $datenow = time();
            $monthId = Carbon::now()->isoFormat('MMMM');
            $month  = date('F', $datenow);
            $date = date('j',$datenow);
            $now = Carbon::parse($request->tanggal)->isoFormat('D MMMM Y');
       
             $siswa = Siswa::all();
                   $biaya= BiayaLain::where('id',$id)->first();
                         $transaksi = new Transaksi();
                for ($i=0; $i < count($siswa) ; $i++) { 
                   
                    $query = Transaksi::where('tanggal', $now)->count();
                  
                               Transaksi::create([
                                'siswa_id' => $siswa[$i]['id'],
                                'id_transaksi' => $transaksi->idTransaksi(),
                                'jenis_biaya' => $biaya->nama_biaya,
                                'jumlah' => $biaya->harga,
                                'tanggal' => $now,
                                'status' => 'UNPAID'
                               ]);
                }
                  
                    //                 // $transaksi = new Transaksi();
                    //                 // $transaksi->siswa_id = $value->id;
                    //                 // $transaksi->id_transaksi = $transaksi->idTransaksi();
                    //                 // $transaksi->jenis_biaya = $biaya->nama_biaya;
                    //                 // $transaksi->jumlah      = $biaya->harga;
                    //                 // $transaksi->tanggal     = $now;
                    //                 // $transaksi->status      = 'UNPAID';
                    //                 // $transaksi->save();
                    //                 // continue;
                                
                    //         }
                    //  }
                     return redirect('daftar-biaya-lain')->with('success','Biaya Lain berhasil ditambahkan ke siswa...!');
                     
        } catch (\Exception $e) {
              return redirect('daftar-biaya-lain')->with('failed',$e->getMessage());
        }
    }

    public function addBiayakeSiswa($id){
        $title = "Tambah Biaya ke Siswa";
        $biaya = BiayaLain::where('id', $id)->first();
        $siswa = Siswa::select('id','nama')->get();

        return view('pages.biayalain.cart', ['title' => $title, 'biaya' => $biaya, 'siswa'=> $siswa]);
    }
    public function getSiswa(Request $request){
        $search = $request->get('query');

      if($search == ''){
         $autocomplate = Siswa::orderby('nama','asc')->select('id','nama')->get();
      }else{
         $autocomplate = Siswa::orderby('nama','asc')->select('id','nama')->where('nama', 'like', '%' .$search . '%')->get();
      }

      $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            foreach($autocomplate as $row)
            {
                $output .= '
                <li><a class="dropdown-item" href="#">'.$row->nama.'</a><input type="hidden" class"d-none" value="'.$row->id.'" name="ids"></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
    }

    public function storeBiayakeSIswa(Request $request, $id){

        $biaya = BiayaLain::where('id',  $id)->first();
        $transaksi = new Transaksi();
        $transaksi->siswa_id        = $request->ids;
        $transaksi->jenis_biaya     = $biaya->nama_biaya;
        $transaksi->jumlah          = $biaya->harga;
        $transaksi->id_transaksi    = $transaksi->idTransaksi();
        $transaksi->tanggal         = Carbon::now()->isoFormat('D MMMM Y');
        $transaksi->status          = 'UNPAID';
        $transaksi->save();

        return redirect('/daftar-biaya-lain')->with('success' ,'Biaya Lain berhasil ditambahkan ke siswa...!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Tambah Biaya Lain';

        return view('pages.biayalain.tambah', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BiayaLainRequest $request)
    {

        $data = new BiayaLain();
        $data->nama_biaya = $request->nama_biaya;
        $data->harga      = $request->harga;
        $data->save();

        return redirect('/daftar-biaya-lain')->with('success', 'Biaya Lain Berhasil ditambah...!');
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
        $title = 'Edit Biaya Lain';
        $data = BiayaLain::where('id', $id)->first();
        

        return view('pages.biayalain.edit', ['title' =>  $title, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BiayaLainRequest $request, $id)
    {
        $data = BiayaLain::where('id', $id)->first();
        $data->nama_biaya = $request->nama_biaya;
        $data->harga      = $request->harga;
        $data->update();

        return redirect('/daftar-biaya-lain')->with('success', 'Biaya Berhasil diupdate...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BiayaLain::where('id', $id)->delete();

        return redirect('/daftar-biaya-lain')->with('success', 'Biaya Berhasil dihapus...!');
    }
}
