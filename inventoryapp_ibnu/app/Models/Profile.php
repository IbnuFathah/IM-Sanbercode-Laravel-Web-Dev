<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //Memilih table profile dari database yang digunakan
    protected $table = 'profile';

    //Daftar kolom yang bisa diakses untuk diisi
    protected $fillable = ['age','bio','user_id'];
    
    public function user()
    {
        //Relasi One-to-One, Profile memiliki satu user
        return $this->belongsTo(User::class, 'user_id');
    } 
}
