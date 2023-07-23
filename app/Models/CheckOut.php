<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $table  = 'checkout';
    protected $fillable = ['invoice', 'id_transaksi','siswa_id', 'status','tanggal'];


    protected $with = ['pembayarans', 'siswas'];

    public function pembayarans(){

        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id');
    }

    public function siswas(){
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
