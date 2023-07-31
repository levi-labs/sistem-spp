<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Bendahara;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $datenow = time();
        $monthId = Carbon::now()->isoFormat('MMMM');
        $month  = date('F', $datenow);
        $date = date('j',$datenow);
        $now = Carbon::now()->isoFormat('YYYY-MM-DD');
    

        if ($date == 4) {
                $siswa = Siswa::all();
                  $query = Transaksi::where('tanggal', $now)->count();
                //  dd($query, $now);
                  if ($query == 0 ) {
                    
                    for ($i=0 ;$i < count($siswa) ; $i++) {
                         $ceksiswa = Transaksi::where('siswa_id', $siswa[$i]['id'] )->count();
                        // if ($ceksiswa == 0) {
                        //     # code...
                        // }
                      $kelas= Kelas::where('nama_kelas',$siswa[$i]['jenis_kelas'])->first();
                      $transaksi = new Transaksi();
                       
                            
                            Transaksi::create([
                                'siswa_id' =>$siswa[$i]['id'],
                                'id_transaksi' => $transaksi->idTransaksi(),
                                'jenis_biaya' => 'SPP- '.$kelas->nama_kelas,
                                'jumlah' => $kelas->harga,
                                'tanggal' => $now,
                                'status' => 'UNPAID'
                            ]);
         
                    }     
                  }  
           
        }
    }

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
        
        if (auth()->user()->akses_user == 'bendahara') {
            $kelas = Transaksi::where('status' , 'PAID')->count();
            $users = Transaksi::where('status' , 'UNPAID')->count();

            $data = DB::table('transaksi')
                    ->join('siswa', 'transaksi.siswa_id', '=', 'siswa.id')
                   
                    ->where('status', 'UNPAID' , DB::raw('count(*) as total'))
                    ->select('transaksi.status')
                    ->get();
                    // dd($data);
            $datas = DB::table('transaksi')
                    ->join('siswa', 'transaksi.siswa_id', '=', 'siswa.id')
                   
                    ->select('transaksi.status', DB::raw('count(*) as total'))
                    ->groupBy('status')
                    ->get();
            $paid = [];
            $unpaid = [];

            $countpaid = Transaksi::where('status', 'PAID')
                                    ->where('jenis_biaya', 'SPP- Full Days')
                                    ->count();
            $countunpaid = Transaksi::where('status', 'UNPAID')
                                    ->where('jenis_biaya', 'SPP- Full Days')
                                    ->count();
            $countBukuPaid = Transaksi::where('status', 'PAID')
                                    ->where('jenis_biaya', 'Uang Buku')
                                    ->count();
            $countBukuUnpaid = Transaksi::where('status', 'UNPAID')
                                    ->where('jenis_biaya', 'Uang Buku')
                                    ->count();
            $countSeragamPaid = Transaksi::where('status', 'PAID')
                                    ->where('jenis_biaya', 'Uang Buku')
                                    ->count();
            $countSeragamUnpaid = Transaksi::where('status', 'UNPAID')
                                    ->where('jenis_biaya', 'Seragam')
                                    ->count();
            $countKegiatanPaid = Transaksi::where('status', 'PAID')
                                    ->where('jenis_biaya', 'Dana Kegiatan Sekolah')
                                    ->count();
            $countKegiatanUnpaid = Transaksi::where('status', 'UNPAID')
                                    ->where('jenis_biaya', 'Dana Kegiatan Sekolah')
                                    ->count();
            foreach ($data as $value) {
                $unpaid[] = $value->status;
               
            }
     
            foreach ($datas as $values) {
                $paid[] = $values->status;  
            }
            return view('pages.dashboard.index', ['title'          => $title, 
                                                            'siswa'         => $siswa, 
                                                            'bendahara'     => $bendahara,
                                                             'kelas'        => $kelas, 
                                                             'users'        => $users, 
                                                             'data'         => $unpaid, 
                                                             'paid'         => $paid,
                                                             'cpaid'        =>$countpaid,
                                                             'cunpaid'      => $countunpaid,
                                                             'bukuPaid'     => $countBukuPaid,
                                                             'bukuUnpaid'   => $countBukuUnpaid,
                                                             'seragamPaid'  => $countSeragamPaid,
                                                             'seragamUnpaid' => $countSeragamUnpaid,
                                                             'kegiatanPaid' => $countKegiatanPaid,
                                                             'kegiatanUnpaid' => $countKegiatanUnpaid

                                                             ]);
        }elseif(auth()->user()->akses_user == 'siswa'){
             $kelas = Transaksi::where('status' , 'PAID')->where('siswa_id', auth()->user()->siswas->id)->count();
            $users = Transaksi::where('status' , 'UNPAID')->where('siswa_id', auth()->user()->siswas->id)->count();
         return view('pages.dashboard.index', ['title'          => $title, 
                                                            'siswa'         => $siswa, 
                                                            'bendahara'     => $bendahara,
                                                             'kelas'        => $kelas, 
                                                             'users'        => $users, 
                                                           

                                                             ]);
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
        //
    }
}
