<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bendahara extends Model
{
    use HasFactory;

    protected $table = 'bendahara';
    protected $fillable = ['nama', 'nip','no_hp','email','avatar' ,'user_id','jabatan'];

       public function getAvatar()
    {
        return '/storage/' . $this->avatar;
    }
}
