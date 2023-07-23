<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['siswa_id','id_transaksi', 'jenis_biaya', 'jumlah','tanggal','status'];

    // protected $with = ['siswas'];

    public function idTransaksi(){
        
        $date = Carbon::now()->format('dmY');
        $transaksi = Transaksi::count();

        if ($transaksi == 0) {
            $antrian = 00001;
            $nomor = 'TR-' . $date . '-' . sprintf('%05s', $antrian);
        } else {
            $last = Transaksi::all()->last();
            $urut = (int)substr($last->id_transaksi, -5) + 1;

            $nomor = 'TR-' . $date . '-' . sprintf('%05s', $urut);
        }

        return $nomor;
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class, 'siswa_id','id');
    }

    public function pembayarans(){
        return $this->belongsTo(Transaksi::class , 'id_transaksi', 'id');
    }
}
