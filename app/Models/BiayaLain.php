<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaLain extends Model
{
    use HasFactory;

    protected $table = 'biayalain';
    protected $fillable = ['nama_biaya','harga'];
}
