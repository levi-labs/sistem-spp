<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    // protected $with = ['users'];
    public function users(){

        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
       public function getAvatar()
    {
        return '/storage/' . $this->avatar;
    }

}
